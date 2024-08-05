<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pesanan extends BaseController
{
  public function daftarPesanan() {
    $data = [
      'title' => 'Daftar PesananKu'
    ];
    return view('user/daftarPesanan', $data);
  }

  public function pesananku() {
    $data = [
      'title' => 'PesananKu',
      'tabPesananKu' => 'pesananKu'
    ];
    return view('user/pesananKu', $data);
  }

  public function detailPesananPaketan($id = '') {
    $data = [
      'title' => 'Detail PesananKu',
      'tabPesananKu' => 'pesananKu'
    ];
    return view('user/pesananDetailPaketan', $data);
  }

  public function detailPesananBiasa($id = '') {
    $data = [
      'title' => 'Detail PesananKu',
      'tabPesananKu' => 'pesananKu'
    ];
    return view('user/pesananDetailBiasa', $data);
  }

  public function pesananDatang() {
    $data = [
      'title' => 'Pesanan Datang',
      'tabPesananKu' => 'pesananDatang'
    ];
    return view('user/pesananDatang', $data);
  }

  public function pesananSelesai() {
    $data = [
      'title' => 'Pesanan Selesai',
      'tabPesananKu' => 'pesananSelesai'
    ];
    return view('user/pesananSelesai', $data);
  }
}
