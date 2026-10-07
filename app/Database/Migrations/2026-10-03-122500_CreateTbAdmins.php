<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTbAdmins extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'admin_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'admin_username' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'admin_password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'admin_prefix' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'admin_first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'admin_last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'admin_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'admin_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'admin_department' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
            ],
            'admin_role' => [
                'type'       => 'ENUM',
                'constraint' => ['super_admin', 'admin'],
                'default'    => 'admin',
            ],
            'admin_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'alumni_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'last_login_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('admin_id', true);
        $this->forge->addKey('admin_email', false, true);
        $this->forge->createTable('tb_admins', true);
    }

    public function down()
    {
        $this->forge->dropTable('tb_admins', true);
    }
}
