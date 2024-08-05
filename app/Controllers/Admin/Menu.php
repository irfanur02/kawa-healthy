<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Menu extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Kelola Menu',
      'sidebar' => 'kelolaMenu'
    ];
    return view('admin/menu', $data);
  }

  public function createMenu()
  {
    $data = [
      'title' => 'Form Tambah Menu',
      'sidebar' => 'kelolaMenu'
    ];
    return view('admin/menuCreate', $data);
  }

  public function updateMenu($id = '')
  {
    $data = [
      'title' => 'Form Edit Menu',
      'sidebar' => 'kelolaMenu',
      'id' => $id
    ];
    return view('admin/menuCreate', $data);
  }
}
