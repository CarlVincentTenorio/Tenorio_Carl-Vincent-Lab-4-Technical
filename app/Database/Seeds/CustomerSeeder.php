<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('customers')->insertBatch([
            [
                'full_name' => 'Juan Dela Cruz',
                'email' => 'juan@example.com',
                'phone' => '09123456789',
                'created_at' => '2026-09-01 09:00:00',
            ],
            [
                'full_name' => 'Maria Santos',
                'email' => 'maria@example.com',
                'phone' => '09234567890',
                'created_at' => '2026-09-02 10:15:00',
            ],
            [
                'full_name' => 'Pedro Reyes',
                'email' => 'pedro@example.com',
                'phone' => '09345678901',
                'created_at' => '2026-09-03 11:30:00',
            ],
            [
                'full_name' => 'Ana Garcia',
                'email' => 'ana@example.com',
                'phone' => '09456789012',
                'created_at' => '2026-09-04 13:45:00',
            ],
            [
                'full_name' => 'Carlo Mendoza',
                'email' => 'carlo@example.com',
                'phone' => '09567890123',
                'created_at' => '2026-09-05 15:00:00',
            ],
        ]);
    }
}
