<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuthModelAdmin;

class Auth extends BaseController
{

  protected $authModel;

  public function __construct() {
    $this->authModel = new AuthModelAdmin();
  }

  public function index() {
    $data = [
      'title' => 'Login Admin'
    ];

    return view('admin/login', $data);
  }

  public function authLogin() {
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $user = $this->authModel->where('username_admin', $username)->findAll();
    if (count($user) < 1) {
      session()->setFlashdata('dataLogin', 'username');
    } else {
      if ($password != $user[0]['password_admin']) {
        session()->setFlashdata('dataLogin', 'password');
      }

      if ($username == $user[0]['username_admin'] && $password == $user[0]['password_admin']) {
        $data = [
          'title' => 'Dashboard',
          'sidebar' => 'dashboard'
        ];
        return redirect()->to('/dadmin/dashboard');
      }
    }

    return redirect()->to('/dadmin')->withInput();
  }
}
