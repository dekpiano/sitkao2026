<?php

namespace App\Controllers;

use App\Models\AlumniModel;

class Alumni extends BaseController
{
    public function index()
    {
        $model = new AlumniModel();
        $allAlumni = $model->orderBy('alm_id', 'DESC')->findAll();

        // Group alumni by Graduation Year (พ.ศ.) (exclude system admin accounts)
        $batches = [];
        $alumniCount = 0;
        $jwCount = 0;
        $skjCount = 0;

        foreach ($allAlumni as $item) {
            $batchName = trim((string)($item['alm_batch'] ?? ''));
            $gradYear  = trim((string)($item['alm_grad_year'] ?? ''));
            $school    = trim((string)($item['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์'));
            $isJW      = (strpos($school, 'จิรประวัติวิทยาคม') !== false);
            
            // Skip admin-only accounts or 'ผู้ดูแลระบบ'
            if ($batchName === 'ผู้ดูแลระบบ' || $batchName === 'Admin' || $batchName === 'admin' || $batchName === 'Super Admin' || $batchName === 'super_admin' || ($item['alm_role'] ?? '') === 'admin') {
                continue;
            }

            $alumniCount++;
            if ($isJW) {
                $jwCount++;
            } else {
                $skjCount++;
            }

            // Grouping key: Graduation Year (พ.ศ.)
            if (!empty($gradYear)) {
                $groupKey = 'year_' . $gradYear;
                $displayTitle = 'รุ่นจบปี พ.ศ. ' . $gradYear;
                $slug = $gradYear;
            } elseif (!empty($batchName) && $batchName !== 'ไม่ระบุรุ่น') {
                $groupKey = 'batch_' . $batchName;
                $displayTitle = $batchName;
                $slug = $batchName;
            } else {
                $groupKey = 'unspecified';
                $displayTitle = 'ไม่ระบุปี พ.ศ. / รุ่น';
                $slug = 'unspecified';
            }

            if (!isset($batches[$groupKey])) {
                $batches[$groupKey] = [
                    'key'            => $groupKey,
                    'slug'           => $slug,
                    'batch_name'     => $displayTitle,
                    'grad_year'      => $gradYear,
                    'raw_batches'    => [],
                    'school'         => $school,
                    'is_jw'          => $isJW,
                    'total_count'    => 0,
                    'preview_images' => []
                ];
            }

            $batches[$groupKey]['total_count']++;
            if (count($batches[$groupKey]['preview_images']) < 4 && !empty($item['alm_image'])) {
                $batches[$groupKey]['preview_images'][] = $item['alm_image'];
            }
            if (!empty($batchName) && $batchName !== 'ไม่ระบุรุ่น' && !in_array($batchName, $batches[$groupKey]['raw_batches'])) {
                $batches[$groupKey]['raw_batches'][] = $batchName;
            }
        }

        // Sort batches: Years descending, then others at the end
        uasort($batches, function($a, $b) {
            $yearA = is_numeric($a['grad_year']) ? (int)$a['grad_year'] : 0;
            $yearB = is_numeric($b['grad_year']) ? (int)$b['grad_year'] : 0;
            if ($yearA !== $yearB) {
                return $yearB <=> $yearA;
            }
            return strcmp($a['batch_name'], $b['batch_name']);
        });

        $data['batches'] = array_values($batches);
        $data['total_alumni'] = $alumniCount;
        $data['jw_count'] = $jwCount;
        $data['skj_count'] = $skjCount;
        return view('alumni/index', $data);
    }

    public function batch($identifier = null)
    {
        if ($identifier === null || $identifier === '') {
            $identifier = $this->request->getGet('name') ?: ($this->request->getGet('batch') ?: $this->request->getGet('year'));
        }
        
        $identifier = trim(urldecode((string)$identifier));

        $model = new AlumniModel();
        $builder = $model->where('alm_role !=', 'admin');

        $cleanIdentifier = trim($identifier);
        $gradYear = '';
        $displayTitle = '';
        
        // Extract 4-digit year if present (e.g. '2568', 'รุ่นปี 2568', 'ปี พ.ศ. 2568')
        $hasYear = preg_match('/(25\d{2}|24\d{2}|20\d{2})/', $cleanIdentifier, $matches);
        $extractedYear = $hasYear ? $matches[1] : '';

        if ($cleanIdentifier === 'unspecified' || $cleanIdentifier === 'ไม่ระบุรุ่น' || empty($cleanIdentifier)) {
            $displayTitle = 'ศิษย์เก่าไม่ระบุปี พ.ศ. / รุ่น';
            $members = $builder->groupStart()
                               ->where('alm_grad_year', '')
                               ->orWhere('alm_grad_year IS NULL', null, false)
                               ->orWhere('alm_batch', 'ไม่ระบุรุ่น')
                               ->orWhere('alm_batch', '')
                               ->orWhere('alm_batch IS NULL', null, false)
                               ->groupEnd()
                               ->orderBy('alm_id', 'DESC')
                               ->findAll();
        } elseif (!empty($extractedYear)) {
            $gradYear = $extractedYear;
            $displayTitle = 'ทำเนียบรุ่นจบปี พ.ศ. ' . $gradYear;
            // Search either alm_grad_year matching or alm_batch containing year or exact match
            $members = $builder->groupStart()
                               ->where('alm_grad_year', $gradYear)
                               ->orLike('alm_grad_year', $gradYear)
                               ->orLike('alm_batch', $gradYear)
                               ->orLike('alm_batch', $cleanIdentifier)
                               ->groupEnd()
                               ->orderBy('alm_id', 'DESC')
                               ->findAll();
        } else {
            $displayTitle = $cleanIdentifier;
            $members = $builder->groupStart()
                               ->where('alm_batch', $cleanIdentifier)
                               ->orLike('alm_batch', $cleanIdentifier)
                               ->orLike('alm_grad_year', $cleanIdentifier)
                               ->groupEnd()
                               ->orderBy('alm_id', 'DESC')
                               ->findAll();
            if (!empty($members) && !empty($members[0]['alm_grad_year'])) {
                $gradYear = $members[0]['alm_grad_year'];
            }
        }

        $data = [
            'batch_name'  => $displayTitle,
            'grad_year'   => $gradYear,
            'members'     => $members,
            'total_count' => count($members)
        ];

        return view('alumni/batch', $data);
    }

    public function profile($id)
    {
        $model = new AlumniModel();
        $alumni = $model->find($id);

        if (!$alumni) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('ไม่พบข้อมูลศิษย์เก่า');
        }

        $data['alumni'] = $alumni;
        return view('alumni/profile', $data);
    }

    public function myProfile()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('msg', 'กรุณาเข้าสู่ระบบก่อนเข้าดูโปรไฟล์');
        }
        return redirect()->to('/alumni/profile/' . $session->get('id'));
    }

    public function editProfile()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('msg', 'กรุณาเข้าสู่ระบบก่อนแก้ไขข้อมูลโปรไฟล์');
        }

        $model = new AlumniModel();
        $alumni = $model->find($session->get('id'));

        if (!$alumni) {
            $session->destroy();
            return redirect()->to('/login')->with('msg', 'ไม่พบข้อมูลผู้ใช้งาน กรุณาเข้าสู่ระบบใหม่');
        }

        $data['alumni'] = $alumni;
        return view('alumni/edit_profile', $data);
    }

    public function updateProfile()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = $session->get('id');
        $model = new AlumniModel();
        $currentAlumni = $model->find($userId);

        if (!$currentAlumni) {
            return redirect()->to('/login');
        }

        $prefix    = trim((string)$this->request->getVar('prefix'));
        $firstName = trim((string)$this->request->getVar('first_name'));
        $lastName  = trim((string)$this->request->getVar('last_name'));
        $rawName   = trim((string)$this->request->getVar('name'));

        if (!empty($firstName) && !empty($lastName)) {
            $name = trim($prefix ? "{$prefix}{$firstName} {$lastName}" : "{$firstName} {$lastName}");
        } elseif (!empty($rawName)) {
            $name = $rawName;
        } else {
            return redirect()->back()->withInput()->with('error_msg', 'กรุณากรอกชื่อและนามสกุล');
        }
        $phone = trim((string)$this->request->getVar('phone'));

        $processArray = function($inputName) {
            $data = $this->request->getVar($inputName);
            return is_array($data) ? implode(', ', $data) : (string)$data;
        };

        $updateData = [
            'alm_prefix'                   => $prefix,
            'alm_first_name'               => $firstName,
            'alm_last_name'                => $lastName,
            'alm_name'                     => $name,
            'alm_phone'                    => $phone,
            'alm_privacy_phone'            => $this->request->getVar('privacy_phone') ? 1 : 0,
            'alm_privacy_email'            => $this->request->getVar('privacy_email') ? 1 : 0,
            'alm_privacy_address'          => $this->request->getVar('privacy_address') ? 1 : 0,
            'alm_contact_other'            => $this->request->getVar('contact_other'),
            'alm_current_address'          => $this->request->getVar('current_address'),
            'alm_school'                   => $this->request->getVar('school') ? trim((string)$this->request->getVar('school')) : ($currentAlumni['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์'),
            'alm_school_grad_level'        => $this->request->getVar('school_grad_level') ? trim((string)$this->request->getVar('school_grad_level')) : ($currentAlumni['alm_school_grad_level'] ?? 'มัธยมศึกษาปีที่ 6'),
            'alm_batch'                    => $this->request->getVar('batch') ? trim((string)$this->request->getVar('batch')) : ($currentAlumni['alm_batch'] ?? ''),
            'alm_grad_year'                => $this->request->getVar('grad_year') ? trim((string)$this->request->getVar('grad_year')) : ($currentAlumni['alm_grad_year'] ?? ''),
            'alm_grad_level'               => $this->request->getVar('grad_level'),
            'alm_grad_level_other'         => $this->request->getVar('grad_level_other'),
            'alm_grad_major'               => $this->request->getVar('grad_major'),
            'alm_work_experience'          => $this->request->getVar('work_experience'),
            'alm_current_status'           => $this->request->getVar('current_status'),
            'alm_study_place'              => $this->request->getVar('study_place'),
            'alm_unemployed_reasons'       => $processArray('unemployed_reasons'),
            'alm_unemployed_reasons_other' => $this->request->getVar('unemployed_reasons_other'),
            'alm_job_hunt_obstacles'       => $processArray('job_hunt_obstacles'),
            'alm_school_support_needs'     => $processArray('school_support_needs'),
            'alm_suggestions'              => $this->request->getVar('suggestions'),
            'alm_bio'                      => $this->request->getVar('bio')
        ];

        // Status & Job title handling
        $jobTitle = trim((string)$this->request->getVar('job_title'));
        $status = $this->request->getVar('current_status');
        if (!empty($jobTitle)) {
            $updateData['alm_job_title'] = $jobTitle;
        } else {
            if ($status == 'กำลังศึกษาต่อ') $updateData['alm_job_title'] = 'นักศึกษา';
            else if ($status == 'ว่างงาน') $updateData['alm_job_title'] = 'กำลังมองหางาน';
            else $updateData['alm_job_title'] = 'ศิษย์เก่า';
        }

        // Handle Avatar Upload or URL
        $imgFile = $this->request->getFile('avatar_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $newName = $imgFile->getRandomName();
            $imgFile->move($uploadPath, $newName);
            $updateData['alm_image'] = base_url('uploads/avatars/' . $newName);
        } else {
            $imageUrl = trim((string)$this->request->getVar('image_url'));
            if (!empty($imageUrl)) {
                $updateData['alm_image'] = $imageUrl;
            }
        }

        // Handle Password Change if filled
        $newPassword = (string)$this->request->getVar('new_password');
        $passconf = (string)$this->request->getVar('passconf');
        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $newPassword)) {
                return redirect()->back()->withInput()->with('error_msg', 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 8 ตัวอักษร และประกอบด้วย A-Z, a-z และตัวเลข');
            }
            if ($newPassword !== $passconf) {
                return redirect()->back()->withInput()->with('error_msg', 'การยืนยันรหัสผ่านใหม่ไม่ตรงกัน');
            }
            $updateData['alm_password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $model->update($userId, $updateData);

        // Update session name if changed
        $session->set('name', $name);

        return redirect()->to('/alumni/edit-profile')->with('success_msg', 'บันทึกการแก้ไขโปรไฟล์เรียบร้อยแล้ว!');
    }
}

