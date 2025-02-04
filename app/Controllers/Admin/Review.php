<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ReviewModel;

class Review extends BaseController
{
  protected $reviewModel;
  public function __construct()
  {
    $this->reviewModel = new ReviewModel();
  }
  public function index()
  {
    $dataPelangganReview = $this->reviewModel->getDataPelangganReview()->getResultArray();
    $dataPesananPelanggan = $this->reviewModel->getDataPesananPelanggan()->getResultArray();
    // dd($dataPelangganReview);
    $data = [
      'title' => 'Data Review',
      'sidebar' => 'lihatReview',
      'dataPelangganReview' => $dataPelangganReview,
      'dataPesananPelanggan' => $dataPesananPelanggan
    ];
    return view('admin/review', $data);
  }
}
