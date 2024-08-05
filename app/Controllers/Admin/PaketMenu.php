<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PaketMenu extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Kelola Paket Menu',
      'sidebar' => 'kelolaPaketMenu'
    ];
    return view('admin/paketMenu', $data);
  }
}
