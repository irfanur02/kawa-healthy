<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BiayaOngkir extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Kelola Biaya Ongkir',
      'sidebar' => 'kelolaBiayaOngkir'
    ];
    return view('admin/biayaOngkir', $data);
  }
}
