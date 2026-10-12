<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $helpers = ['url'];

    public function login()
    {
        if (session()->get('logged_in') === true) {
            return redirect()->to(site_url('users'));
        }

        return view('auth/login');
    }

public function logout()
{
    session()->destroy();

    return redirect()->to(site_url('login'));
}

    public function attempt()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($username === '' || $password === '') {
            return redirect()->to(site_url('login'))
                ->with('error', 'Enter your username and password.');
        }

        $user = (new UserModel())->where('username', $username)->first();

        if ($user === null || ! password_verify($password, (string) ($user['password'] ?? ''))) {
            return redirect()->to(site_url('login'))
                ->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->regenerate(true);
        $session->set([
            'logged_in' => true,
            'user_id'   => (int) $user['id'],
            'username'  => $user['username'],
        ]);

        return redirect()->to(site_url('users'));
    }
}