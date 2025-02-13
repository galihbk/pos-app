<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMenusAccess extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'role_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'menu_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('menus_access');
    }

    public function down()
    {
        $this->forge->dropTable('menus_access');
    }
}
