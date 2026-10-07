<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSchoolGradLevelToAlumni extends Migration
{
    public function up()
    {
        $fields = [
            'alm_school_grad_level' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'มัธยมศึกษาปีที่ 6 (ม.6)',
                'null'       => true,
                'after'      => 'alm_school',
                'comment'    => 'ระดับชั้นที่สำเร็จการศึกษาจากโรงเรียน (ม.3 หรือ ม.6)'
            ],
        ];

        $this->forge->addColumn('tb_alumni', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_alumni', 'alm_school_grad_level');
    }
}
