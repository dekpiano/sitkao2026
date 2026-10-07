<?php

namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model
{
    protected $table      = 'tb_jobs';
    protected $primaryKey = 'job_id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'job_title',
        'job_company',
        'job_location',
        'job_type',
        'job_salary',
        'job_description',
        'job_qualifications',
        'job_contact',
        'job_contact_email',
        'job_contact_phone',
        'job_author_id',
        'job_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'job_created_at';
    protected $updatedField  = 'job_updated_at';
}
