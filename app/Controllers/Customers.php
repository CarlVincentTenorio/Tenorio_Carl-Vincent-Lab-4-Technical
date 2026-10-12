<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    protected $helpers = ['url', 'form'];
    public function index(): string
    {
        $customerModel = new CustomerModel();

        return view('customers', [
            'customers' => $customerModel->orderBy('id', 'ASC')->findAll(),
        ]);
    }
      public function create(): string
    {
        return view('customers/form', ['customer' => null]);
    }

        public function store()
    {
        if (! $this->validateData($this->request->getPost(), $this->customerRules())) {
            return redirect()->back()->withInput();
        }

        (new CustomerModel())->insert($this->validator->getValidated());

        return redirect()->to(site_url('customers'));
    }

    private function customerRules(): array
    {
        return [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];
    }
    
        public function edit(int $id): string
    {
        $customer = (new CustomerModel())->find($id);

        if ($customer === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found');
        }

        return view('customers/form', ['customer' => $customer]);
    }

    public function update(int $id)
    {
        $model = new CustomerModel();

        if ($model->find($id) === null) {
            throw PageNotFoundException::forPageNotFound('Customer not found');
        }

        if (! $this->validateData($this->request->getPost(), $this->customerRules())) {
            return redirect()->back()->withInput();
        }

        $model->update($id, $this->validator->getValidated());

        return redirect()->to(site_url('customers'));
    }

}
