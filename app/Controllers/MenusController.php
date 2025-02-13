<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenusModel;

class MenusController extends BaseController
{
    protected $userModel;
    protected $menusModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->menusModel = new MenusModel();
        $this->request = \Config\Services::request();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Menus | Point of Sale',
        ];
        return view('Admin/menus', $data);
    }
    public function addMenus()
    {
        $validationRules = [
            'menu_url' => [
                'label' => 'Menu URL',
                'rules' => 'required',
            ],
            'menu_icon' => [
                'label' => 'Menu icon',
                'rules' => 'required',
            ],
            'menu_name' => [
                'label' => 'Menu Name',
                'rules' => 'required|is_unique[menus.menu_name]',
            ],
            'menu_order' => [
                'label' => 'Menu Order',
                'rules' => 'required',
            ],
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ]);
        }
        $data = [
            'menu_name' => $this->request->getPost('menu_name'),
            'menu_url' => $this->request->getPost('menu_url'),
            'menu_icon' => $this->request->getPost('menu_icon'),
            'menu_order' => $this->request->getPost('menu_order'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if ($this->menusModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Menu Has Added Successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while adding the menu. Try Again!',
            ]);
        }
    }
    public function getMenus()
    {
        $data = [
            'menu' => $this->menusModel->get()->getResultArray(),
        ];
        return view('Admin/table/table-menus', $data);
    }
    public function updateAccess()
    {
        $builder = $this->db->table('menus_access');
        $user = $this->userModel->where('username', $_SESSION['username'])->get()->getRowArray();
        $id = $this->request->getPost('id');
        $menusAccess = $builder->where(['role_name' => $user['role'], 'menu_id' => $id])->get()->getRowArray();
        if (!empty($menusAccess)) {
            $builder->where('id', $menusAccess['id']);
            if ($builder->delete()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Access Controll Successfully Updated',
                ]);
            }
        } else {
            $data = [
                'role_name' => 'Kasir',
                'menu_id' => $id,
            ];
            if ($builder->insert($data)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Access Controll Successfully Updated',
                ]);
            }
        }
    }
}
