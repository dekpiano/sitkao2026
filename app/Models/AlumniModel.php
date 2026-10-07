<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table      = 'tb_alumni';
    protected $primaryKey = 'alm_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'alm_username', 
        'alm_password', 
        'alm_role',
        'alm_prefix',
        'alm_first_name',
        'alm_last_name',
        'alm_name', 
        'alm_school',
        'alm_school_grad_level',
        'alm_batch', 
        'alm_grad_year', 
        'alm_grad_level', 
        'alm_grad_level_other', 
        'alm_grad_major', 
        'alm_work_experience', 
        'alm_current_address', 
        'alm_privacy_address',
        'alm_phone', 
        'alm_privacy_phone',
        'alm_contact_other', 
        'alm_email', 
        'alm_privacy_email',
        'alm_current_status', 
        'alm_job_title', 
        'alm_study_place', 
        'alm_unemployed_reasons', 
        'alm_unemployed_reasons_other', 
        'alm_job_hunt_obstacles', 
        'alm_school_support_needs', 
        'alm_suggestions', 
        'alm_pdpa_consent',
        'alm_bio', 
        'alm_image',
        'alm_reset_token',
        'alm_reset_expires'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'alm_created_at';
    protected $updatedField  = 'alm_updated_at';

    public function __construct()
    {
        parent::__construct();
        $this->ensureSchema();
    }

    protected function ensureSchema()
    {
        try {
            $db = \Config\Database::connect();
            if (!$db->fieldExists('alm_school_grad_level', $this->table)) {
                $forge = \Config\Database::forge();
                $forge->addColumn($this->table, [
                    'alm_school_grad_level' => [
                        'type'       => 'VARCHAR',
                        'constraint' => 50,
                        'null'       => true,
                        'default'    => 'มัธยมศึกษาปีที่ 6 (ม.6)',
                        'after'      => 'alm_school',
                        'comment'    => 'ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6)'
                    ]
                ]);
            }
        } catch (\Throwable $e) {
            log_message('error', 'Schema ensure error: ' . $e->getMessage());
        }
    }
}
