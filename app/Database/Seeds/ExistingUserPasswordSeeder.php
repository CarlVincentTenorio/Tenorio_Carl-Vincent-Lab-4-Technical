<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ExistingUserPasswordSeeder extends Seeder
{
    public function run()
    {
        $adminPassword = (string) env('TFA4_ADMIN_PASSWORD', '');

        if (strlen($adminPassword) < 12) {
            throw new \RuntimeException(
                'Set TFA4_ADMIN_PASSWORD in .env to at least 12 characters.'
            );
        }

        $users = $this->db->table('users')
            ->select('id, username, password')
            ->get()
            ->getResultArray();

        if (! in_array('admin01', array_column($users, 'username'), true)) {
            throw new \RuntimeException('User admin01 was not found.');
        }

        foreach ($users as $user) {
            if (! empty($user['password'])) {
                continue;
            }

            $plainPassword = $user['username'] === 'admin01'
                ? $adminPassword
                : bin2hex(random_bytes(32));

            $this->db->table('users')
                ->where('id', $user['id'])
                ->update([
                    'password' => password_hash($plainPassword, PASSWORD_DEFAULT),
                ]);
        }
    }
}