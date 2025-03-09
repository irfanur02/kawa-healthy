<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BiayaOngkirModel;
use App\Models\PelangganModel;
use App\Models\AkunModel;
use CodeIgniter\HTTP\ResponseInterface;

class Daftar extends BaseController
{

  protected $biayaOngkirModel;
  protected $pelangganModel;
  protected $akunModel;

  public function __construct()
  {
    $this->biayaOngkirModel = new BiayaOngkirModel();
    $this->pelangganModel = new PelangganModel();
    $this->akunModel = new AkunModel();
  }

  public function index()
  {
    $dataKota = $this->biayaOngkirModel->getAllOngkir()->getResultArray();
    $data = [
      'title' => 'Daftar Akun',
      'dataKota' => $dataKota
    ];
    return view('user/daftar', $data);
  }

  public function save()
  {
    $nama = $this->request->getVar('nama');
    $alamat = $this->request->getVar('alamat');
    $kota = $this->request->getVar('kota');
    $notelp = $this->request->getVar('notelp');
    $email = $this->request->getVar('email');
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $dataPelanggan = [
      'nama_pelanggan' => $nama,
      'id_ongkir' => $kota,
      'alamat_pelanggan' => $alamat,
      'notelp_pelanggan' => $notelp,
      'created_at' => $date
    ];
    $this->pelangganModel->insertPelanggan($dataPelanggan);

    $idPelanggan = $this->pelangganModel->getMaxIdPelanggan()->getRowArray()['id_pelanggan'];
    $dataAkun = [
      'id_pelanggan' => $idPelanggan,
      'email_akun' => $email,
      'username_akun' => strtolower($username),
      'password_akun' => $password,
      'created_at' => $date
    ];

    $this->akunModel->insertAkun($dataAkun);

    $idAkun = $this->akunModel->getMaxIdAkun()->getRowArray()['id_akun'];

    setSession($this->session, $idAkun);

    return redirect()->to('/');
  }
}
