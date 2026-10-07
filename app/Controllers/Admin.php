<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AlumniModel;
use App\Models\JobModel;
use App\Models\NewsModel;

class Admin extends BaseController
{
    private function checkAdmin()
    {
        $session = session();
        $role = $session->get('role');
        if (!$session->get('isLoggedIn') || !in_array($role, ['admin', 'super_admin'])) {
            return redirect()->to('/admin/login')->with('msg', 'กรุณาเข้าสู่ระบบด้วย Google ผู้ดูแลระบบ (Admin)');
        }
        return null;
    }

    public function login()
    {
        $session = session();
        $role = $session->get('role');
        if ($session->get('isLoggedIn') && in_array($role, ['admin', 'super_admin'])) {
            return redirect()->to('/admin');
        }

        $data = [
            'googleClientId' => trim((string)env('GOOGLE_CLIENT_ID', ''))
        ];
        return view('admin/login', $data);
    }

    public function googleRedirect()
    {
        $config = config('Google');
        $params = [
            'client_id'     => $config->clientId,
            'redirect_uri'  => base_url('admin/googleCallback'),
            'response_type' => 'code',
            'scope'         => 'email profile openid',
            'access_type'   => 'online',
            'prompt'        => 'select_account'
        ];
        return redirect()->to('https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query($params));
    }

    public function googleCallback()
    {
        $session = session();
        $code = $this->request->getVar('code');
        if (!$code) {
            $session->setFlashdata('msg', 'ไม่ได้รับรหัสยืนยันตัวตนจาก Google');
            return redirect()->to('admin/login');
        }

        $config = config('Google');
        $curl = \Config\Services::curlrequest();

        try {
            $response = $curl->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'code'          => $code,
                    'client_id'     => $config->clientId,
                    'client_secret' => $config->clientSecret,
                    'redirect_uri'  => base_url('admin/googleCallback'),
                    'grant_type'    => 'authorization_code',
                ],
                'timeout' => 15,
                'http_errors' => false,
            ]);

            $tokens = json_decode($response->getBody(), true);
            if (!isset($tokens['access_token'])) {
                $session->setFlashdata('msg', 'Google Token Error: ' . ($tokens['error_description'] ?? 'ไม่สามารถรับ Token ได้'));
                return redirect()->to('admin/login');
            }

            // Get user info
            $userResponse = $curl->get('https://www.googleapis.com/oauth2/v3/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $tokens['access_token']
                ],
                'timeout' => 15,
                'http_errors' => false,
            ]);

            $userData = json_decode($userResponse->getBody(), true);
            if (!$userData || !isset($userData['email'])) {
                $session->setFlashdata('msg', 'ไม่สามารถดึงข้อมูลบัญชี Google ได้');
                return redirect()->to('admin/login');
            }

            $email = trim($userData['email']);
            $adminModel = new AdminModel();
            $admin = $adminModel->where('admin_email', $email)->first();

            if (!$admin) {
                $session->setFlashdata('msg', "อีเมล ({$email}) ไม่มีสิทธิ์เข้าถึงระบบผู้ดูแลระบบ (Admin Permission Required)");
                return redirect()->to('admin/login');
            }

            $adminRole = $admin['admin_role'] ?? 'admin';

            // Update last login
            $adminModel->update($admin['admin_id'], [
                'last_login_at' => date('Y-m-d H:i:s'),
                'admin_image'   => $admin['admin_image'] ?: ($userData['picture'] ?? null)
            ]);

            // Set session
            $sesData = [
                'id'         => $admin['admin_id'],
                'admin_id'   => $admin['admin_id'],
                'alumni_id'  => $admin['alumni_id'] ?? null,
                'username'   => $admin['admin_username'] ?? $admin['admin_email'],
                'email'      => $admin['admin_email'],
                'name'       => $admin['admin_name'] ?? ($userData['name'] ?? 'Admin'),
                'role'       => $adminRole,
                'image'      => $admin['admin_image'] ?: ($userData['picture'] ?? null),
                'isLoggedIn' => true,
                'isAdmin'    => true
            ];
            $session->set($sesData);

            return redirect()->to('admin');

        } catch (\Exception $e) {
            $session->setFlashdata('msg', 'เกิดข้อผิดพลาดในการเชื่อมต่อ Google: ' . $e->getMessage());
            return redirect()->to('admin/login');
        }
    }

    public function googleLogin()
    {
        $session = session();
        $adminModel = new AdminModel();

        $credential = $this->request->getVar('credential');
        $directEmail = $this->request->getVar('email');

        $email = null;
        $name = null;
        $picture = null;

        if (!empty($credential)) {
            // Decode Google JWT Token payload
            $tokenParts = explode('.', $credential);
            if (count($tokenParts) >= 2) {
                $payloadBase64 = str_replace(['-', '_'], ['+', '/'], $tokenParts[1]);
                $payload = json_decode(base64_decode($payloadBase64), true);
                if ($payload && isset($payload['email'])) {
                    $email = trim($payload['email']);
                    $name = $payload['name'] ?? null;
                    $picture = $payload['picture'] ?? null;
                }
            }
        } elseif (!empty($directEmail)) {
            $email = trim($directEmail);
        }

        if (empty($email)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ไม่พบข้อมูลบัญชี Google ที่ส่งมา กรุณาลองใหม่อีกครั้ง'
            ]);
        }

        // Search admin in database
        $admin = $adminModel->where('admin_email', $email)->first();

        if (!$admin) {
            return $this->response->setJSON([
                'success' => false,
                'message' => "อีเมล ({$email}) ไม่มีสิทธิ์เข้าถึงระบบผู้ดูแลระบบ (Admin Permission Required)"
            ]);
        }

        $adminRole = $admin['admin_role'] ?? 'admin';

        // Update last login
        $adminModel->update($admin['admin_id'], [
            'last_login_at' => date('Y-m-d H:i:s'),
            'admin_image'   => $admin['admin_image'] ?: $picture
        ]);

        // Set session
        $sesData = [
            'id'         => $admin['admin_id'],
            'admin_id'   => $admin['admin_id'],
            'alumni_id'  => $admin['alumni_id'] ?? null,
            'username'   => $admin['admin_username'] ?? $admin['admin_email'],
            'email'      => $admin['admin_email'],
            'name'       => $admin['admin_name'] ?? ($name ?: 'Admin'),
            'role'       => $adminRole,
            'image'      => $admin['admin_image'] ?: $picture,
            'isLoggedIn' => true,
            'isAdmin'    => true
        ];
        $session->set($sesData);

        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'เข้าสู่ระบบผู้ดูแลระบบสำเร็จ ยินดีต้อนรับ ' . ($admin['admin_name'] ?? 'Admin'),
            'redirect' => base_url('admin')
        ]);
    }

    public function dashboard()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $alumniModel = new AlumniModel();
        $jobModel    = new JobModel();
        $newsModel   = new NewsModel();

        // 1. KPI Stats
        $totalAlumni     = $alumniModel->countAllResults();
        $totalJobs       = $jobModel->countAllResults();
        $totalNews       = $newsModel->countAllResults();
        
        $employedCount   = $alumniModel->like('alm_current_status', 'ทำงานแล้ว')->countAllResults();
        $studyingCount   = $alumniModel->like('alm_current_status', 'กำลังศึกษาต่อ')->countAllResults();
        $unemployedCount = $alumniModel->where('alm_current_status', 'ว่างงาน')->countAllResults();

        // School Breakdown (จ.ว. vs สกจ.)
        $jwCount         = $alumniModel->like('alm_school', 'จิรประวัติวิทยาคม')->countAllResults();
        $skjCount        = max(0, $totalAlumni - $jwCount);

        // 2. Status Breakdown for Donut Chart
        $statusBreakdown = [
            'employed'   => $employedCount,
            'studying'   => $studyingCount,
            'unemployed' => $unemployedCount,
            'other'      => max(0, $totalAlumni - ($employedCount + $studyingCount + $unemployedCount))
        ];

        // 3. Top School & PAO Support Needs Analysis
        $allSupportNeeds = $alumniModel->select('alm_school_support_needs')->where('alm_school_support_needs IS NOT NULL')->findAll();
        $supportCounts = [];
        foreach ($allSupportNeeds as $row) {
            if (!empty($row['alm_school_support_needs'])) {
                $items = explode(', ', $row['alm_school_support_needs']);
                foreach ($items as $item) {
                    $item = trim($item);
                    if ($item !== '') {
                        $supportCounts[$item] = ($supportCounts[$item] ?? 0) + 1;
                    }
                }
            }
        }
        arsort($supportCounts);
        $topSupportNeeds = array_slice($supportCounts, 0, 6, true);

        // 4. Batch Distribution
        $batchStats = $alumniModel->select('alm_batch, COUNT(*) as count')
                                  ->groupBy('alm_batch')
                                  ->orderBy('count', 'DESC')
                                  ->limit(8)
                                  ->findAll();

        // 5. Recent Registrations
        $recentAlumni = $alumniModel->orderBy('alm_id', 'DESC')->limit(10)->findAll();

        $data = [
            'totalAlumni'     => $totalAlumni,
            'totalJobs'       => $totalJobs,
            'totalNews'       => $newsModel->countAllResults(),
            'employedCount'   => $employedCount,
            'studyingCount'   => $studyingCount,
            'unemployedCount' => $unemployedCount,
            'jwCount'         => $jwCount,
            'skjCount'        => $skjCount,
            'statusBreakdown' => $statusBreakdown,
            'topSupportNeeds' => $topSupportNeeds,
            'batchStats'      => $batchStats,
            'recentAlumni'    => $recentAlumni
        ];

        return view('admin/dashboard', $data);
    }

    public function alumniList()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $model = new AlumniModel();
        $search = $this->request->getVar('search');
        $batch  = $this->request->getVar('batch');
        $status = $this->request->getVar('status');
        $school = $this->request->getVar('school');

        $builder = $model;

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('alm_name', $search)
                               ->orLike('alm_email', $search)
                               ->orLike('alm_phone', $search)
                               ->orLike('alm_job_title', $search)
                               ->orLike('alm_grad_major', $search)
                               ->groupEnd();
        }

        if (!empty($batch)) {
            $builder = $builder->where('alm_batch', $batch);
        }

        if (!empty($status)) {
            $builder = $builder->like('alm_current_status', $status);
        }

        if (!empty($school)) {
            if ($school === 'jw') {
                $builder = $builder->like('alm_school', 'จิรประวัติวิทยาคม');
            } elseif ($school === 'skj') {
                $builder = $builder->notLike('alm_school', 'จิรประวัติวิทยาคม');
            }
        }

        $allBatches = $model->select('alm_batch')->distinct()->findAll();
        $alumniList = $builder->orderBy('alm_id', 'DESC')->paginate(20);
        $pager      = $model->pager;

        $data = [
            'alumniList' => $alumniList,
            'pager'      => $pager,
            'search'     => $search,
            'batch'      => $batch,
            'status'     => $status,
            'school'     => $school,
            'allBatches' => $allBatches,
            'totalCount' => $model->countAllResults(false)
        ];

        return view('admin/alumni_list', $data);
    }

    public function deleteAlumni($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $model = new AlumniModel();
        $model->delete($id);

        return redirect()->back()->with('msg', 'ลบข้อมูลศิษย์เก่าสำเร็จ');
    }

    public function managers()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $adminModel = new AdminModel();
        $admins = $adminModel->orderBy("FIELD(admin_role, 'super_admin', 'admin')", 'ASC', false)
                             ->orderBy('admin_id', 'ASC')
                             ->findAll();

        $currentRole = session()->get('role') ?? 'admin';
        $isSuperAdmin = ($currentRole === 'super_admin');

        $data = [
            'admins'       => $admins,
            'totalCount'   => count($admins),
            'currentRole'  => $currentRole,
            'isSuperAdmin' => $isSuperAdmin
        ];

        return view('admin/managers', $data);
    }

    public function addManager()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $session = session();
        if ($session->get('role') !== 'super_admin') {
            return redirect()->back()->with('error', 'เฉพาะผู้ดูแลระบบสูงสุด (Super Admin) เท่านั้นที่มีสิทธิ์แต่งตั้งผู้ดูแลระบบ');
        }

        $email      = trim((string)$this->request->getVar('email'));
        $prefix     = trim((string)$this->request->getVar('prefix'));
        $firstName  = trim((string)$this->request->getVar('first_name'));
        $lastName   = trim((string)$this->request->getVar('last_name'));
        $phone      = trim((string)$this->request->getVar('phone'));
        $department = trim((string)$this->request->getVar('department'));
        $role       = ($this->request->getVar('role') === 'super_admin') ? 'super_admin' : 'admin';

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'กรุณาระบุอีเมล Google ให้ถูกต้อง');
        }

        if (empty($firstName) || empty($lastName)) {
            return redirect()->back()->with('error', 'กรุณากรอกชื่อและนามสกุลให้ครบถ้วน');
        }

        $fullName = trim("{$prefix}{$firstName} {$lastName}");
        $adminModel = new AdminModel();
        $alumniModel = new AlumniModel();

        // Check if this email belongs to an alumnus to link alumni_id
        $alumni = $alumniModel->where('alm_email', $email)->first();
        $alumniId = $alumni ? $alumni['alm_id'] : null;

        $existingAdmin = $adminModel->where('admin_email', $email)->first();

        if ($existingAdmin) {
            $updateData = [
                'admin_role'       => ($existingAdmin['admin_role'] === 'super_admin') ? 'super_admin' : $role,
                'admin_prefix'     => $prefix ?: $existingAdmin['admin_prefix'],
                'admin_first_name' => $firstName ?: $existingAdmin['admin_first_name'],
                'admin_last_name'  => $lastName ?: $existingAdmin['admin_last_name'],
                'admin_name'       => $fullName ?: $existingAdmin['admin_name'],
                'admin_phone'      => $phone ?: $existingAdmin['admin_phone'],
                'admin_department' => $department ?: $existingAdmin['admin_department'],
                'alumni_id'        => $alumniId ?: $existingAdmin['alumni_id']
            ];
            $adminModel->update($existingAdmin['admin_id'], $updateData);
            return redirect()->back()->with('msg', "อัปเดตข้อมูลและสิทธิ์ผู้ดูแลระบบ ({$email}) เรียบร้อยแล้ว");
        } else {
            $insertData = [
                'admin_email'      => $email,
                'admin_username'   => explode('@', $email)[0],
                'admin_prefix'     => $prefix,
                'admin_first_name' => $firstName,
                'admin_last_name'  => $lastName,
                'admin_name'       => $fullName,
                'admin_phone'      => $phone,
                'admin_department' => $department ?: 'ผู้ดูแลระบบระบบทำเนียบศิษย์เก่า',
                'admin_role'       => $role,
                'admin_image'      => "https://ui-avatars.com/api/?name=" . urlencode($fullName) . "&background=random&color=fff&size=150",
                'alumni_id'        => $alumniId
            ];
            $adminModel->insert($insertData);
            return redirect()->back()->with('msg', "เพิ่มผู้ดูแลระบบใหม่ ({$email}) สำเร็จ สามารถเข้าสู่ระบบด้วย Google Account ได้ทันที");
        }
    }

    public function removeManager($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $session = session();
        if ($session->get('role') !== 'super_admin') {
            return redirect()->back()->with('error', 'เฉพาะผู้ดูแลระบบสูงสุด (Super Admin) เท่านั้นที่สามารถปลดสิทธิ์ได้');
        }

        if ($id == $session->get('admin_id') || $id == $session->get('id')) {
            return redirect()->back()->with('error', 'ไม่สามารถปลดสิทธิ์ผู้ดูแลระบบของตัวท่านเองได้');
        }

        $adminModel = new AdminModel();
        $admin = $adminModel->find($id);

        if ($admin) {
            if ($admin['admin_role'] === 'super_admin') {
                return redirect()->back()->with('error', 'ไม่สามารถปลดสิทธิ์ผู้ดูแลระบบสูงสุด (Super Admin) ได้');
            }

            $adminModel->delete($id);
            return redirect()->back()->with('msg', "ปลดสิทธิ์และลบผู้ดูแลระบบ {$admin['admin_name']} เรียบร้อยแล้ว");
        }

        return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ดูแลระบบ');
    }

    public function toggleRole($id)
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $session = session();
        if ($id == $session->get('id')) {
            return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสิทธิ์ของตัวท่านเองได้');
        }

        $model = new AlumniModel();
        $alumni = $model->find($id);
        if ($alumni) {
            if ($alumni['alm_role'] === 'super_admin') {
                return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสิทธิ์ของผู้ดูแลระบบสูงสุด (Super Admin) ได้');
            }

            $newRole = ($alumni['alm_role'] === 'admin') ? 'alumni' : 'admin';
            $model->update($id, ['alm_role' => $newRole]);
            return redirect()->back()->with('msg', 'อัปเดตสิทธิ์เรียบร้อยเป็น: ' . $newRole);
        }
        return redirect()->back()->with('error', 'ไม่พบผู้ใช้งาน');
    }

    public function exportSurvey()
    {
        $check = $this->checkAdmin();
        if ($check) return $check;

        $model = new AlumniModel();
        $alumni = $model->orderBy('alm_id', 'ASC')->findAll();

        $filename = "skj_alumni_survey_report_" . date('Ymd_His') . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Output UTF-8 BOM for Microsoft Excel Thai display
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // CSV Header
        fputcsv($output, [
            'รหัส',
            'สถาบัน/โรงเรียน',
            'ระดับชั้นที่จบจากโรงเรียน',
            'คำนำหน้า',
            'ชื่อจริง',
            'นามสกุล',
            'ชื่อ-นามสกุลเต็ม',
            'รุ่นที่จบ',
            'ปีการศึกษาที่จบ',
            'ระดับการศึกษาสูงสุดในปัจจุบัน',
            'ระดับอื่นๆ',
            'แผนการเรียน/สาขาวิชา',
            'ประสบการณ์ทำงาน',
            'อีเมล',
            'เบอร์โทรศัพท์',
            'ช่องทางติดต่ออื่นๆ',
            'ที่อยู่ปัจจุบัน',
            'สถานภาพปัจจุบัน',
            'อาชีพ/ตำแหน่งงาน',
            'สถาบัน/สาขาที่ศึกษาต่อ',
            'สาเหตุที่ยังไม่ได้ทำงาน',
            'สาเหตุอื่นๆ',
            'ปัญหาอุปสรรคการหางาน',
            'สิ่งที่ต้องการให้ รร./อบจ. ช่วยเหลือ',
            'ข้อเสนอแนะเพิ่มเติม',
            'วันที่ลงทะเบียน'
        ]);

        foreach ($alumni as $row) {
            fputcsv($output, [
                $row['alm_id'],
                $row['alm_school'] ?? 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์',
                $row['alm_school_grad_level'] ?? '',
                $row['alm_prefix'] ?? '',
                $row['alm_first_name'] ?? '',
                $row['alm_last_name'] ?? '',
                $row['alm_name'],
                $row['alm_batch'],
                $row['alm_grad_year'],
                $row['alm_grad_level'] ?? '',
                $row['alm_grad_level_other'] ?? '',
                $row['alm_grad_major'] ?? '',
                $row['alm_work_experience'] ?? '',
                $row['alm_email'],
                $row['alm_phone'] ?? '',
                $row['alm_contact_other'] ?? '',
                $row['alm_current_address'] ?? '',
                $row['alm_current_status'] ?? '',
                $row['alm_job_title'] ?? '',
                $row['alm_study_place'] ?? '',
                $row['alm_unemployed_reasons'] ?? '',
                $row['alm_unemployed_reasons_other'] ?? '',
                $row['alm_job_hunt_obstacles'] ?? '',
                $row['alm_school_support_needs'] ?? '',
                $row['alm_suggestions'] ?? '',
                $row['alm_created_at'] ?? ''
            ]);
        }

        fclose($output);
        exit;
    }
}
