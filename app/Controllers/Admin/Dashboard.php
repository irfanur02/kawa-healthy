<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel;
use App\Models\WhatsAppModel;

class Dashboard extends BaseController
{
  protected $pesananModel;
  protected $whatsAppModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
    $this->whatsAppModel = new WhatsAppModel();
  }

  public function sendMessageToCustomer()
  {
    // Ganti dengan nomor pelanggan yang valid
    $customerPhoneNumber = '6281615167427'; // Format internasional tanpa "+"
    $message = 'Halo! Ini adalah pesan otomatis dari layanan kami.';
    // Kirim pesan
    $response = $this->whatsAppModel->sendWhatsAppMessage($customerPhoneNumber, $message);
    return $this->response->setJSON($response);
  }

  public function index()
  {
    // $this->sendMessageToCustomer();
    // d($this->sendMessageToCustomer());
    // die();
    $tanggalMenu = date("Y-m-d");
    // $tanggalMenu = '2025-02-07';
    $dataPelangganPemesanan = $this->pesananModel->getAllPelangganPemesanan($tanggalMenu)->getResultArray();
    $dataPesananPelanggan = $this->pesananModel->getAllPesananPelanggan($tanggalMenu, null, [2])->getResultArray();
    // dd($dataPesananPelanggan);
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
