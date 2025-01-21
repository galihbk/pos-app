<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin1',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'name' => 'Admin Satu',
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
