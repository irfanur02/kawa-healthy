<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel;

class Dashboard extends BaseController
{
  protected $pesananModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
  }

  public function index()
  {
    $tanggalMenu = date("Y-m-d");
    // $tanggalMenu = '2025-01-28  ';
    $dataPelangganPemesanan = $this->pesananModel->getAllPelangganPemesanan($tanggalMenu)->getResultArray();
    $dataPesananPelanggan = $this->pesananModel->getAllPesananPelanggan($tanggalMenu, null, [2])->getResultArray();
    // dd($dataPelangganPemesanan);
    $data = [
      'title' => 'Dashboard',
      'sidebar' => 'dashboard',
      'dataPelangganPemesanan' => $dataPelangganPemesanan,
      'dataPesananPelanggan' => $dataPesananPelanggan,
      'tanggalMenu' => $tanggalMenu
    ];
    return view('admin/dashboard', $data);
  }
}
