<?php

namespace App\Controllers;

use App\Models\AlumniModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginSubmit()
    {
        $session = session();
        $model = new AlumniModel();
        
        $identifier = trim((string)$this->request->getVar('username'));
        $password = (string)$this->request->getVar('password');
        
        $user = $model->groupStart()
                      ->where('alm_email', $identifier)
                      ->orWhere('alm_username', $identifier)
                      ->orWhere('alm_phone', $identifier)
                      ->groupEnd()
                      ->first();
        
        if ($user) {
            if (password_verify($password, $user['alm_password'])) {
                $ses_data = [
                    'id'         => $user['alm_id'],
                    'username'   => $user['alm_username'],
                    'email'      => $user['alm_email'],
                    'name'       => $user['alm_name'],
                    'role'       => $user['alm_role'] ?? 'alumni',
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('msg', 'รหัสผ่านไม่ถูกต้อง');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'ไม่พบบัญชีผู้ใช้งาน ชื่อผู้ใช้ หรืออีเมลนี้ในระบบ');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerSubmit()
    {
        // Auto-fallback sync for Step 3 status-tailored fields if submitted directly
        $status = trim((string)($this->request->getVar('current_status') ?? $this->request->getVar('ui_current_status')));
        if (!empty($status) && empty($this->request->getVar('current_status'))) {
            $_POST['current_status'] = $status;
        }

        $gradLevel = trim((string)$this->request->getVar('grad_level'));
        if (empty($gradLevel)) {
            if ($status === 'ทำงานแล้ว') $gradLevel = trim((string)$this->request->getVar('work_grad_level'));
            else if ($status === 'กำลังศึกษาต่อ') $gradLevel = trim((string)$this->request->getVar('study_grad_level'));
            else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $gradLevel = trim((string)$this->request->getVar('both_grad_level'));
            else if ($status === 'ว่างงาน') $gradLevel = trim((string)$this->request->getVar('unemp_grad_level'));
            
            if (!empty($gradLevel)) {
                $_POST['grad_level'] = $gradLevel;
            }
        }

        $rules = [
            'username'          => 'required|min_length[3]|max_length[50]|is_unique[tb_alumni.alm_username]',
            'email'             => 'permit_empty|valid_email|is_unique[tb_alumni.alm_email]',
            'password'          => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
            'passconf'          => 'matches[password]',
            'prefix'            => 'permit_empty',
            'first_name'        => 'required|min_length[2]|max_length[100]',
            'last_name'         => 'required|min_length[2]|max_length[100]',
            'school'            => 'required',
            'school_grad_level' => 'required',
            'batch'             => 'permit_empty',
            'grad_year'         => 'required',
            'grad_level'        => 'required',
            'current_status'    => 'required'
        ];

        $messages = [
            'username' => [
                'required'    => 'กรุณากรอกชื่อผู้ใช้งาน (Username)',
                'min_length'  => 'ชื่อผู้ใช้งานต้องมีความยาวอย่างน้อย 3 ตัวอักษร',
                'max_length'  => 'ชื่อผู้ใช้งานต้องมีความยาวไม่เกิน 50 ตัวอักษร',
                'is_unique'   => 'ชื่อผู้ใช้งานนี้มีผู้ใช้งานแล้วในระบบ โปรดเลือกชื่ออื่น'
            ],
            'email' => [
                'valid_email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                'is_unique'   => 'อีเมลนี้ถูกใช้งานลงทะเบียนในระบบแล้ว'
            ],
            'password' => [
                'required'    => 'กรุณากรอกรหัสผ่าน',
                'min_length'  => 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
                'regex_match' => 'รหัสผ่านต้องประกอบด้วยตัวพิมพ์ใหญ่ (A-Z), ตัวพิมพ์เล็ก (a-z) และตัวเลข (0-9)'
            ],
            'passconf' => [
                'matches' => 'การยืนยันรหัสผ่านไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง'
            ],
            'first_name' => [
                'required' => 'กรุณากรอกชื่อจริง'
            ],
            'last_name' => [
                'required' => 'กรุณากรอกนามสกุล'
            ],
            'school' => [
                'required' => 'กรุณาเลือกโรงเรียน/สังกัดที่สำเร็จการศึกษา (จ.ว. หรือ สกจ.)'
            ],
            'school_grad_level' => [
                'required' => 'กรุณาเลือกระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6)'
            ],
            'current_status' => [
                'required' => 'กรุณาเลือกสถานภาพปัจจุบันของท่าน'
            ],
            'grad_level' => [
                'required' => 'กรุณาเลือกระดับการศึกษาสูงสุดที่สำเร็จในปัจจุบัน'
            ]
        ];

        if ($this->validate($rules, $messages)) {
            $model = new AlumniModel();
            
            // Helper function to handle array inputs from checkboxes
            $processArray = function($inputName) {
                $data = $this->request->getVar($inputName);
                return is_array($data) ? implode(', ', $data) : $data;
            };

            $username = trim((string)$this->request->getVar('username'));
            $email = trim((string)$this->request->getVar('email'));
            
            // Handle Name Prefix, First name, and Last name
            $prefix = trim((string)$this->request->getVar('prefix'));
            if ($prefix === 'อื่นๆ' && !empty($this->request->getVar('prefix_other'))) {
                $prefix = trim((string)$this->request->getVar('prefix_other'));
            }
            $firstName = trim((string)$this->request->getVar('first_name'));
            $lastName  = trim((string)$this->request->getVar('last_name'));
            
            $fullName = trim($prefix ? "{$prefix}{$firstName} {$lastName}" : "{$firstName} {$lastName}");
            $nameForAvatar = urlencode($fullName);
            
            $school = trim((string)$this->request->getVar('school'));
            if (empty($school)) {
                $school = 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์';
            }

            // Fallback value extractions for conditional status fields
            $gradLevelOther = trim((string)$this->request->getVar('grad_level_other'));
            if (empty($gradLevelOther)) {
                if ($status === 'ทำงานแล้ว') $gradLevelOther = trim((string)$this->request->getVar('work_grad_level_other'));
                else if ($status === 'กำลังศึกษาต่อ') $gradLevelOther = trim((string)$this->request->getVar('study_grad_level_other'));
                else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $gradLevelOther = trim((string)$this->request->getVar('both_grad_level_other'));
                else if ($status === 'ว่างงาน') $gradLevelOther = trim((string)$this->request->getVar('unemp_grad_level_other'));
            }

            $gradMajor = trim((string)$this->request->getVar('grad_major'));
            if (empty($gradMajor)) {
                if ($status === 'ทำงานแล้ว') $gradMajor = trim((string)$this->request->getVar('work_major'));
                else if ($status === 'กำลังศึกษาต่อ') $gradMajor = trim((string)$this->request->getVar('study_major'));
                else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $gradMajor = trim((string)$this->request->getVar('both_major'));
                else if ($status === 'ว่างงาน') $gradMajor = trim((string)$this->request->getVar('unemp_major'));
            }

            $studyPlace = trim((string)$this->request->getVar('study_place'));
            if (empty($studyPlace)) {
                if ($status === 'กำลังศึกษาต่อ') $studyPlace = trim((string)$this->request->getVar('study_institute'));
                else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $studyPlace = trim((string)$this->request->getVar('both_institute'));
            }

            $jobTitleInput = trim((string)$this->request->getVar('job_title'));
            if (empty($jobTitleInput)) {
                if ($status === 'ทำงานแล้ว') $jobTitleInput = trim((string)$this->request->getVar('work_job_title'));
                else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $jobTitleInput = trim((string)$this->request->getVar('both_job_title'));
            }

            $workExperience = trim((string)$this->request->getVar('work_experience'));
            if (empty($workExperience)) {
                if ($status === 'ทำงานแล้ว') $workExperience = trim((string)$this->request->getVar('work_experience_input'));
                else if ($status === 'กำลังศึกษาต่อและทำงานไปด้วย') $workExperience = trim((string)$this->request->getVar('both_experience'));
                else if ($status === 'ว่างงาน') $workExperience = trim((string)$this->request->getVar('unemp_experience'));
            }

            $data = [
                'alm_username'             => $username,
                'alm_email'                => !empty($email) ? $email : null,
                'alm_password'             => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'alm_prefix'               => $prefix,
                'alm_first_name'           => $firstName,
                'alm_last_name'            => $lastName,
                'alm_name'                 => $fullName,
                'alm_school'               => $school,
                'alm_school_grad_level'    => $this->request->getVar('school_grad_level'),
                'alm_batch'                => $this->request->getVar('batch'),
                'alm_grad_year'            => $this->request->getVar('grad_year'),
                'alm_phone'                => $this->request->getVar('phone'),
                'alm_image'                => "https://ui-avatars.com/api/?name={$nameForAvatar}&background=random&color=fff&size=150",
                
                // Survey Fields
                'alm_grad_level'               => $gradLevel ?: $this->request->getVar('grad_level'),
                'alm_grad_level_other'         => $gradLevelOther ?: $this->request->getVar('grad_level_other'),
                'alm_grad_major'               => $gradMajor ?: $this->request->getVar('grad_major'),
                'alm_work_experience'          => $workExperience ?: $this->request->getVar('work_experience'),
                'alm_contact_other'            => $this->request->getVar('contact_other'),
                'alm_current_address'          => $this->request->getVar('current_address'),
                'alm_current_status'           => $status ?: $this->request->getVar('current_status'),
                'alm_study_place'              => $studyPlace ?: $this->request->getVar('study_place'),
                'alm_unemployed_reasons'       => $processArray('unemployed_reasons'),
                'alm_unemployed_reasons_other' => $this->request->getVar('unemployed_reasons_other'),
                'alm_job_hunt_obstacles'       => $processArray('job_hunt_obstacles'),
                'alm_school_support_needs'     => $processArray('school_support_needs'),
                'alm_suggestions'              => $this->request->getVar('suggestions'),
            ];
            
            $status = $this->request->getVar('current_status');
            $jobTitleInput = $this->request->getVar('job_title');
            
            if (!empty($jobTitleInput)) {
                $data['alm_job_title'] = $jobTitleInput;
            } else {
                if ($status == 'กำลังศึกษาต่อ') $data['alm_job_title'] = 'นักศึกษา';
                else if ($status == 'ว่างงาน') $data['alm_job_title'] = 'กำลังมองหางาน';
                else $data['alm_job_title'] = 'ศิษย์เก่า';
            }

            $model->insert($data);
            return redirect()->to('/login')
                ->with('registered_success', true)
                ->with('registered_name', $fullName)
                ->with('registered_username', $username)
                ->with('msg', 'สมัครสมาชิกและส่งข้อมูลสำเร็จ! ท่านสามารถเข้าสู่ระบบเพื่อแก้ไขข้อมูล ฝากงาน หรือใช้งานระบบศิษย์เก่าได้ทันที');
        } else {
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function forgotPassword()
    {
        return view('auth/forgot_password');
    }

    public function verifyForgotPassword()
    {
        $emailInput = trim((string)$this->request->getVar('email'));

        if (empty($emailInput)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'กรุณากรอกอีเมลที่ใช้ลงทะเบียน'
            ]);
        }

        $model = new AlumniModel();
        $user = $model->groupStart()
                      ->where('alm_email', $emailInput)
                      ->orWhere('alm_username', $emailInput)
                      ->groupEnd()
                      ->first();

        if (!$user || empty($user['alm_email'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ไม่พบบัญชีผู้ใช้งานหรืออีเมลนี้ในระบบ หรือบัญชีนี้ไม่ได้ระบุอีเมลไว้ กรุณาใช้แท็บ "กู้คืนด้วยข้อมูลศิษย์เก่า"'
            ]);
        }

        // Generate reset token (secure random 32 bytes)
        $token = bin2hex(random_bytes(32));
        $otpCode = sprintf('%06d', mt_rand(100000, 999999));
        $expires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $model->update($user['alm_id'], [
            'alm_reset_token'   => $token,
            'alm_reset_expires' => $expires
        ]);

        $resetLink = base_url('reset-password/' . $token);

        // Send Email Verification
        $emailSent = $this->sendResetEmail($user['alm_email'], $user['alm_name'], $token, $otpCode);

        // Mask email for user privacy (e.g. s***i@gmail.com)
        $parts = explode('@', $user['alm_email']);
        $namePart = $parts[0];
        $domain = $parts[1] ?? '';
        if (strlen($namePart) <= 2) {
            $maskedEmail = substr($namePart, 0, 1) . '***@' . $domain;
        } else {
            $maskedEmail = substr($namePart, 0, 1) . str_repeat('*', max(1, strlen($namePart) - 2)) . substr($namePart, -1) . '@' . $domain;
        }

        return $this->response->setJSON([
            'success'     => true,
            'message'     => 'ระบบได้ส่งอีเมลยืนยันการตั้งรหัสผ่านใหม่ไปยัง ' . $maskedEmail . ' เรียบร้อยแล้ว กรุณาเปิดอีเมลและคลิกลิงก์เพื่อตั้งรหัสผ่านใหม่',
            'masked_email'=> $maskedEmail,
            'email_sent'  => $emailSent,
            'reset_link'  => $resetLink,
            'token'       => $token
        ]);
    }

    public function verifyForgotPasswordByInfo()
    {
        $identifier = trim((string)$this->request->getVar('identifier'));
        $firstName  = trim((string)$this->request->getVar('first_name'));
        $lastName   = trim((string)$this->request->getVar('last_name'));
        $gradYear   = trim((string)$this->request->getVar('grad_year'));

        if (empty($identifier) || empty($firstName) || empty($lastName)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'กรุณากรอกข้อมูลยืนยันตัวตนให้ครบถ้วน (ชื่อผู้ใช้/เบอร์โทร, ชื่อจริง และนามสกุล)'
            ]);
        }

        $model = new AlumniModel();
        $builder = $model->groupStart()
                         ->where('alm_username', $identifier)
                         ->orWhere('alm_phone', $identifier)
                         ->orWhere('alm_email', $identifier)
                         ->groupEnd();

        // Check first name match
        $builder->groupStart()
                ->where('alm_first_name', $firstName)
                ->orLike('alm_name', $firstName)
                ->groupEnd();

        // Check last name match
        $builder->groupStart()
                ->where('alm_last_name', $lastName)
                ->orLike('alm_name', $lastName)
                ->groupEnd();

        if (!empty($gradYear)) {
            $builder->where('alm_grad_year', $gradYear);
        }

        $user = $builder->first();

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ข้อมูลไม่ตรงกับฐานข้อมูลในระบบ โปรดตรวจสอบชื่อ-นามสกุล, ชื่อผู้ใช้/เบอร์โทรศัพท์ หรือปี พ.ศ. ที่จบอีกครั้ง หรือติดต่อผู้ดูแลระบบ'
            ]);
        }

        // Generate reset token (valid for 30 minutes)
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        $model->update($user['alm_id'], [
            'alm_reset_token'   => $token,
            'alm_reset_expires' => $expires
        ]);

        return $this->response->setJSON([
            'success'    => true,
            'message'    => 'ยืนยันตัวตนสำเร็จ! พบข้อมูลของคุณ ' . $user['alm_name'] . ' กำลังนำท่านไปตั้งรหัสผ่านใหม่...',
            'redirect'   => base_url('reset-password/' . $token),
            'name'       => $user['alm_name'],
            'token'      => $token
        ]);
    }

    private function sendResetEmail($toEmail, $userName, $token, $otpCode = null)
    {
        try {
            $email = \Config\Services::email();
            
            $config = [
                'mailType' => 'html',
                'charset'  => 'utf-8',
                'CRLF'     => "\r\n",
                'newline'  => "\r\n"
            ];
            $email->initialize($config);

            $fromEmail = getenv('email.fromEmail') ?: 'noreply@skj.ac.th';
            $fromName = getenv('email.fromName') ?: 'SKJ Alumni Hub';

            $email->setFrom($fromEmail, $fromName);
            $email->setTo($toEmail);
            $email->setSubject('ยืนยันการตั้งรหัสผ่านใหม่ - SKJ Alumni Network');
            
            $resetLink = base_url('reset-password/' . $token);
            
            $htmlContent = view('emails/forgot_password', [
                'name'      => $userName,
                'email'     => $toEmail,
                'resetLink' => $resetLink,
                'otpCode'   => $otpCode,
                'expireMin' => 30
            ]);
            
            $email->setMessage($htmlContent);
            return @$email->send(false);
        } catch (\Throwable $e) {
            log_message('error', 'Error sending password reset email: ' . $e->getMessage());
            return false;
        }
    }

    public function resetPasswordWithToken($token = null)
    {
        if (empty($token)) {
            return redirect()->to('/forgot-password')->with('error', 'กรุณาระบุรหัสยืนยันการตั้งรหัสผ่าน');
        }

        $model = new AlumniModel();
        $user = $model->where('alm_reset_token', $token)
                      ->where('alm_reset_expires >=', date('Y-m-d H:i:s'))
                      ->first();

        if (!$user) {
            return redirect()->to('/forgot-password')->with('error', 'ลิงก์ตั้งรหัสผ่านใหม่นี้หมดอายุหรือไม่ถูกต้อง กรุณาส่งคำขอใหม่อีกครั้ง');
        }

        return view('auth/reset_password', [
            'token' => $token,
            'user'  => $user
        ]);
    }

    public function resetPasswordSubmit()
    {
        $token = trim((string)$this->request->getVar('token'));
        $password = (string)$this->request->getVar('password');
        $passconf = (string)$this->request->getVar('passconf');

        if (empty($token)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ไม่พบรหัสยืนยันการตั้งรหัสผ่าน (Token ไม่ถูกต้อง)'
            ]);
        }

        $rules = [
            'password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/]',
            'passconf' => 'matches[password]'
        ];

        $messages = [
            'password' => [
                'required'    => 'กรุณากรอกรหัสผ่านใหม่',
                'min_length'  => 'รหัสผ่านใหม่ต้องมีความยาวอย่างน้อย 8 ตัวอักษร',
                'regex_match' => 'รหัสผ่านต้องประกอบด้วยตัวพิมพ์ใหญ่ (A-Z), ตัวพิมพ์เล็ก (a-z) และตัวเลข (0-9)'
            ],
            'passconf' => [
                'matches' => 'การยืนยันรหัสผ่านใหม่ไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON([
                'success' => false,
                'message' => reset($errors)
            ]);
        }

        $model = new AlumniModel();
        $user = $model->where('alm_reset_token', $token)
                      ->where('alm_reset_expires >=', date('Y-m-d H:i:s'))
                      ->first();

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ลิงก์หรือรหัสยืนยันหมดอายุแล้ว กรุณาส่งคำขอใหม่อีกครั้ง'
            ]);
        }

        $newPasswordHash = password_hash($password, PASSWORD_DEFAULT);
        $model->update($user['alm_id'], [
            'alm_password'      => $newPasswordHash,
            'alm_reset_token'   => null,
            'alm_reset_expires' => null
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'เปลี่ยนรหัสผ่านใหม่เรียบร้อยแล้ว ท่านสามารถเข้าสู่ระบบด้วยรหัสผ่านใหม่ได้ทันที'
        ]);
    }
}
