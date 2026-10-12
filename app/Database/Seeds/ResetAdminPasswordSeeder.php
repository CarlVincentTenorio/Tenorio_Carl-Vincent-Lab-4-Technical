<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ResetAdminPasswordSeeder extends Seeder
{
    public function run()
    {
        $newPassword = (string) env('TFA4_ADMIN_PASSWORD', '');

        if (strlen($newPassword) < 12) {
            throw new \RuntimeException('Set a new admin password of at least 12 characters in .env.');
        }

        $admin = $this->db->table('users')
            ->select('id')
            ->where('username', 'admin01')
            ->get()
            ->getRowArray();

        if ($admin === null) {
            throw new \RuntimeException('admin01 was not found.');
        }

        $this->db->table('users')
            ->where('id', $admin['id'])
            ->update([
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ]);
    }
}