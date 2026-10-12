<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    protected $helpers = ['url', 'form'];

    public function index(): string
    {
        $userModel = new UserModel();

        return view('users', [
            'users' => $userModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('users/form', ['user' => null]);
    }

    public function store()
    {



        if (!$this->validateData($this->request->getPost(), $this->userRules())) {
            return redirect()->back()->withInput();
        }

        $data = $this->validator->getValidated();

        (new UserModel())->insert([
            'username' => $data['username'],
            'full_name' => $data['full_name'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        return redirect()->to(site_url('users'));

    }

    public function edit(int $id): string
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found');
        }

        return view('users/form', ['user' => $user]);
    }


    public function update(int $id)
    {
        $model = new UserModel();

        $user = $model->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found');
        }

        if ($this->request->getPost('username') === $user['username']) {
            $rules['username'] = 'required|max_length[50]';
        }

        $avatar = $this->request->getFile('avatar');
        $hasAvatar = $avatar !== null
            && $avatar->getError() !== UPLOAD_ERR_NO_FILE;

        $rules = $this->userRules($id);

        $password = (string) $this->request->getPost('password');
        $confirmation = (string) $this->request->getPost('confirm_password');

        if ($password !== '' || $confirmation !== '') {
            $rules['password'] = 'required|min_length[12]|max_length[72]';
            $rules['confirm_password'] = 'required|matches[password]';
        }

        if ($hasAvatar) {
            $rules['avatar'] = 'is_image[avatar]'
                . '|mime_in[avatar,image/jpeg,image/png]'
                . '|ext_in[avatar,jpg,jpeg,png]'
                . '|max_size[avatar,2048]';
        }

        if (!$this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput();
        }

        $validated = $this->validator->getValidated();

        $data = [
            'username' => $validated['username'],
            'full_name' => $validated['full_name'],
        ];

        if ($hasAvatar) {
            $directory = FCPATH . 'uploads/avatars/';

            if (!$avatar->isValid() || !is_dir($directory) || !is_writable($directory)) {
                return redirect()->back()->withInput()
                    ->with('upload_error', 'The avatar could not be saved.');
            }

            $extension = $avatar->getMimeType() === 'image/png' ? '.png' : '.jpg';
            $filename = bin2hex(random_bytes(16)) . $extension;

            try {
                service('image')
                    ->withFile($avatar->getTempName())
                    ->fit(160, 160, 'center')
                    ->save($directory . $filename);
            } catch (\CodeIgniter\Images\Exceptions\ImageException $e) {
                return redirect()->back()->withInput()
                    ->with('upload_error', 'Could not process the image.');
            }

            $data['avatar'] = $filename;
        }

        $model->update($id, $data);

        if ($password !== '') {
            $data['password'] = password_hash($validated['password'], PASSWORD_DEFAULT);
        }

        return redirect()->to(site_url('users'));
    }


    private function userRules(?int $id = null): array
    {
        $rules = [
            'username' => $id === null
                ? 'required|max_length[50]|is_unique[users.username]'
                : "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
        ];

        if ($id === null) {
            $rules['password'] = 'required|min_length[12]|max_length[72]';
            $rules['confirm_password'] = 'required|matches[password]';
        }

        return $rules;
    }

}
