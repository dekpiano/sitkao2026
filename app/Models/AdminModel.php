<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'tb_admins';
    protected $primaryKey       = 'admin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'admin_email',
        'admin_username',
        'admin_password',
        'admin_prefix',
        'admin_first_name',
        'admin_last_name',
        'admin_name',
        'admin_phone',
        'admin_department',
        'admin_role',
        'admin_image',
        'alumni_id',
        'last_login_at',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
