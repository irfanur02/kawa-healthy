<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Daftar extends BaseController
{
  public function index() {
    $data = [
      'title' => 'Daftar Akun',
    ];
    return view('user/daftar', $data);
  }
}
