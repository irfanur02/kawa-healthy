<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;

class AuthUser extends BaseController
{

  protected $akunModel;

  public function __construct()
  {
    $this->akunModel = new AkunModel();
  }

  public function index()
  {
    $data = [
      'title' => 'Login Admin'
    ];

    return view('admin/login', $data);
  }

  public function login()
  {
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $akun = $this->akunModel->getAkunByUsername($username)->getRowArray();
    if ($akun == null) {
      $statusLogin = "usernameTidakAda";
    }
    if ($akun != null) {
      if ($akun['password_akun'] != $password) {
        $statusLogin = "passwordSalah";
      }
      if ($akun['password_akun'] == $password) {
        $statusLogin = "sukses";

        $loginAkun = [
          'id_akun' => $akun['id_akun'],
          'logged_in' => true,
        ];

        $this->session->set($loginAkun);
      }
    }
    $result = array(
      'statusLogin' => $statusLogin
    );
    echo json_encode($result);
  }

  public function logout()
  {
    $this->session->destroy();
  }

  public function cekUsername()
  {
    $username = $this->request->getVar('username');
    $cekUsername = $this->akunModel->cekUsername($username)->getRowArray();
    if ($cekUsername != null) {
      $statusUsername = "ada";
    }
    if ($cekUsername == null) {
      $statusUsername = "kosong";
    }
    $result = array(
      'statusUsername' => $statusUsername
    );
    echo json_encode($result);
  }
}
