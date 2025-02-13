<?php

namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['menu_name', 'menu_url', 'menu_icon', 'menu_order', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
