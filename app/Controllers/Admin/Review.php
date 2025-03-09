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

  public function reviewPesanan()
  {
    $idPesanan = $this->request->getVar('idPesanan');
    $idMenuPesanan = $this->request->getVar('idMenuPesanan');
    $review = $this->request->getVar('review');
    $date = date("Y-m-d") . ' ' . date('H-i-s');

    $data = [
      'id_pesanan' => $idPesanan,
      'id_menu_pesanan' => $idMenuPesanan,
      'keterangan_review' => $review,
      'created_at' => $date
    ];

    $this->reviewModel->insertReviewPesanan($data);

    $result = array(
      'data' => $idPesanan
    );
    echo json_encode($result);
  }
}
