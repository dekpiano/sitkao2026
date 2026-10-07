<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Migrate Super Admin (ครูวชิรวิทย์ แกล้วการไถ)
        $superAdmin = [
            'admin_email'      => 'dekpiano@skj.ac.th',
            'admin_username'   => 'dekpiano',
            'admin_prefix'     => '',
            'admin_first_name' => 'ครูวชิรวิทย์',
            'admin_last_name'  => 'แกล้วการไถ',
            'admin_name'       => 'ครูวชิรวิทย์ แกล้วการไถ',
            'admin_phone'      => '06-5359-8963',
            'admin_department' => 'กลุ่มสาระการเรียนรู้วิทยาศาสตร์และเทคโนโลยี / ผู้ดูแลระบบหลัก',
            'admin_role'       => 'super_admin',
            'admin_image'      => 'https://ui-avatars.com/api/?name=' . urlencode('ครูวชิรวิทย์ แกล้วการไถ') . '&background=f43f5e&color=fff&size=150',
            'alumni_id'        => 5,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        // 2. Migrate Admin 2 (dekpiano4815@gmail.com)
        $admin2 = [
            'admin_email'      => 'dekpiano4815@gmail.com',
            'admin_username'   => 'dekpiano4815',
            'admin_prefix'     => 'นาย',
            'admin_first_name' => 'วชิรวิทย์',
            'admin_last_name'  => 'แกล้วการไถ',
            'admin_name'       => 'นายวชิรวิทย์ แกล้วการไถ',
            'admin_phone'      => '0910815148',
            'admin_department' => 'ผู้ดูแลระบบระบบทำเนียบศิษย์เก่า',
            'admin_role'       => 'admin',
            'admin_image'      => 'https://ui-avatars.com/api/?name=' . urlencode('วชิรวิทย์') . '&background=3b82f6&color=fff&size=150',
            'alumni_id'        => null,
            'created_at'       => date('Y-m-d H:i:s'),
            'updated_at'       => date('Y-m-d H:i:s')
        ];

        $adminBuilder = $db->table('tb_admins');
        
        // Insert or update super admin
        $exists1 = $adminBuilder->where('admin_email', $superAdmin['admin_email'])->countAllResults();
        if ($exists1 == 0) {
            $adminBuilder->insert($superAdmin);
        }

        // Insert or update admin 2
        $exists2 = $adminBuilder->where('admin_email', $admin2['admin_email'])->countAllResults();
        if ($exists2 == 0) {
            $adminBuilder->insert($admin2);
        }

        // 3. Clean up fake alumni records with alm_batch = 'ผู้ดูแลระบบ'
        $db->table('tb_alumni')->where('alm_batch', 'ผู้ดูแลระบบ')->delete();
    }
}
