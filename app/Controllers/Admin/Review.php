<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Review extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Data Review',
      'sidebar' => 'lihatReview'
    ];
    return view('admin/review', $data);
  }
}
