<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pesanan extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Pesanan Masuk',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananMasuk'
    ];
    return view('admin/pesanan', $data);
  }

  public function pesananDetail()
  {
    $data = [
      'title' => 'Detail Pesanan',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananMasuk'
    ];
    return view('admin/pesananDetail', $data);
  }

  public function pesananBatal()
  {
    $data = [
      'title' => 'Pesanan Batal',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananBatal'
    ];
    return view('admin/pesananBatal', $data);
  }

  public function pesananRiwayat()
  {
    $data = [
      'title' => 'Pesanan Riwayat',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananRiwayat'
    ];
    return view('admin/pesananRiwayat', $data);
  }
}
