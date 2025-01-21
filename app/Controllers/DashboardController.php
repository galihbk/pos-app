<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('Admin/dashboard', $data);
    }
}
