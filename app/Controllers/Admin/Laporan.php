<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
  public function index() {
    $data = [
      'title' => 'Laporan',
      'sidebar' => 'laporan'
    ];
    return view('admin/laporan', $data);
  }
}
