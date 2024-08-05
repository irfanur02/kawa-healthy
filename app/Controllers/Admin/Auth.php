<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
  public function index(): string
  {
    $data = [
      'title' => 'Login Admin'
    ];
    return view('admin/login', $data);
  }
}
