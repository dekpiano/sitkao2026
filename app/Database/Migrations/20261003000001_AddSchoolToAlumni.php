<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSchoolToAlumni extends Migration
{
    public function up()
    {
        $fields = [
            'alm_school' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'default'    => 'โรงเรียนสวนกุหลาบวิทยาลัย (จิรประวัติ) นครสวรรค์',
                'null'       => true,
                'after'      => 'alm_name',
                'comment'    => 'โรงเรียนที่สำเร็จการศึกษา (จ.ว. / สกจ.)'
            ],
        ];

        $this->forge->addColumn('tb_alumni', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_alumni', 'alm_school');
    }
}
