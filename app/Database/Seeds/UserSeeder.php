<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin1',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'name' => 'Admin Satu',
                'role' => 'Admin',
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'kasir1',
                'password' => password_hash('kasir123', PASSWORD_BCRYPT),
                'name' => 'Kasir Satu',
                'role' => 'Kasir',
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
