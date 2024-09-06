<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\PelangganModel;
use App\Models\BiayaOngkirModel;

class Profil extends BaseController
{
  protected $akunModel;
  protected $pelangganModel;
  protected $biayaOngkirModel;

  public function __construct()
  {
    $this->akunModel = new AkunModel();
    $this->pelangganModel = new PelangganModel();
    $this->biayaOngkirModel = new BiayaOngkirModel();
  }

  public function getProfil()
  {
    $idAkun = $this->request->getVar('idAkun');
    $dataAkun = $this->akunModel->getAkunById($idAkun)->getRowArray();
    $idPelanggan = $dataAkun['id_pelanggan'];
    $dataPelanggan = $this->pelangganModel->getPelangganById($idPelanggan)->getRowArray();
    $dataKota = $this->biayaOngkirModel->getAllOngkir()->getResultArray();
    $result = array(
      'dataAkun' => $dataAkun,
      'dataPelanggan' => $dataPelanggan,
      'dataKota' => $dataKota
    );
    echo json_encode($result);
  }

  public function update()
  {
    $idAkun = $this->request->getVar('idAkun');
    $idPelanggan = $this->request->getVar('idPelanggan');
    $nama = $this->request->getVar('nama');
    $alamat = $this->request->getVar('alamat');
    $kota = $this->request->getVar('kota');
    $notelp = $this->request->getVar('notelp');
    $email = $this->request->getVar('email');
    $username = $this->request->getVar('username');
    $password = $this->request->getVar('password');

    // pelanggan
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $data = [
      'nama_pelanggan' => $nama,
      'alamat_pelanggan' => $alamat,
      'id_ongkir' => $kota,
      'notelp_pelanggan' => $notelp,
      'updated_at' => $date
    ];
    $this->pelangganModel->updatePelanggan($data, $idPelanggan);

    $data = [
      'email_akun' => $email,
      'username_akun' => strtolower($username),
      'password_akun' => $password,
      'updated_at' => $date
    ];
    $this->akunModel->updateAkun($data, $idAkun);

    $result = array(
      // 'data' => $kota,
    );
    echo json_encode($result);
  }
}
