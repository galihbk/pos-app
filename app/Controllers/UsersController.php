<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $data = [
            'title' => 'Users | Point of Sale',
        ];
        return view('Admin/users', $data);
    }
    public function addUsers()
    {
        $validationRules = [
            'name' => [
                'label' => 'Fullname',
                'rules' => 'required|min_length[3]|max_length[50]',
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'Kasir',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->userModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Added Successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while adding the user. Try Again!',
            ]);
        }
    }
    public function getUser()
    {
        $data = [
            'user' => $this->userModel->where('role !=', 'Admin')->where('status', 0)->get()->getResultArray(),
        ];
        return view('Admin/table/table-users', $data);
    }
    public function deleteUser()
    {
        $id = $this->request->getPost('id');

        if ($this->userModel->update($id, ['status' => 1])) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Successfully Removed',
            ]);
        }
    }
    public function getFormEdit()
    {
        $data = [
            'user' => $this->userModel->where('id', $_POST['id'])->get()->getRowArray(),
        ];
        return view('Admin/form/form-edit-user', $data);
    }
    public function updateUser()
    {
        $validationRules = [
            'name' => [
                'label' => 'Fullname',
                'rules' => 'required|min_length[3]|max_length[50]',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ]);
        }
        $data = [
            'name' => $this->request->getPost('name'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $id = $this->request->getPost('id');
        if ($this->userModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Updated Successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while adding the user. Try Again!',
            ]);
        }
    }
    public function getFormEditPassword()
    {
        $data = [
            'user' => $this->userModel->where('id', $_POST['id'])->get()->getRowArray(),
        ];
        return view('Admin/form/form-edit-user-password', $data);
    }
    public function updatePasswordUser()
    {
        $validationRules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ]);
        }
        $data = [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $id = $this->request->getPost('id');
        if ($this->userModel->update($id, $data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User Password Updated Successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while adding the user. Try Again!',
            ]);
        }
    }
}
