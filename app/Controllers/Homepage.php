<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Homepage extends BaseController
{
  public function index() {
    $data = [
      'title' => 'Kawa Healthy'
    ];
    return view('user/homepage', $data);
  }
}
