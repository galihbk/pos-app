<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sign In | Point of Sale',
        ];
        return view('Auth/login', $data);
    }
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                ]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password salah']);
            }
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Akun pengguna tidak ditemukan']);
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
