<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insertBatch([
            [
                'username' => 'admin01',
                'full_name' => 'John Cruz',
                'created_at' => '2026-09-01 08:30:00',
            ],
            [
                'username' => 'staff01',
                'full_name' => 'Maria Reyes',
                'created_at' => '2026-09-02 09:45:00',
            ],
            [
                'username' => 'staff02',
                'full_name' => 'Pedro Santos',
                'created_at' => '2026-09-03 11:00:00',
            ],
            [
                'username' => 'manager01',
                'full_name' => 'Ana Garcia',
                'created_at' => '2026-09-04 14:15:00',
            ],
            [
                'username' => 'staff03',
                'full_name' => 'Mark Mendoza',
                'created_at' => '2026-09-05 16:30:00',
            ],
        ]);
    }
}
