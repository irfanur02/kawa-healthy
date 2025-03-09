<?php

namespace App\Controllers;
// namespace App\Helpers;

use App\Controllers\BaseController;
use App\Models\JadwalModel;
use App\Models\PaketMenuModel;

class Homepage extends BaseController
{
  protected $jadwalModel;
  protected $paketMenuModel;

  public function __construct()
  {
    $this->jadwalModel = new JadwalModel();
    $this->paketMenuModel = new PaketMenuModel();
  }

  public function index()
  {
    // $today = '2025-02-01';
    $today = date("Y-m-d");
    $dataJadwalPersonal = $this->jadwalModel->getJadwalByTanggal($today, 'personal')->getResultArray();
    $dataJadwalFamily = $this->jadwalModel->getJadwalByTanggal($today, 'family')->getResultArray();

    if (empty($dataJadwalPersonal)) {
      $newToday = $this->jadwalModel->findJadwal($today)->getRowArray();
      if (!empty($newToday)) {
        // dd("t");
        $dataJadwalPersonal = $this->jadwalModel->getJadwalByTanggal($newToday['tanggal_mulai'], 'personal')->getResultArray();
        $dataDetailJadwalPersonal = $this->jadwalModel->getDetailJadwalByTanggal($newToday['tanggal_mulai'], 'personal')->getResultArray();
        $dataInfuseJadwalPersonal = $this->jadwalModel->getInfuseJadwalPersonalByTanggal($newToday['tanggal_mulai'])->getResultArray();
      } else {
        $dataJadwalPersonal = $this->jadwalModel->getJadwalByTanggal($today, 'personal')->getResultArray();
        $dataDetailJadwalPersonal = $this->jadwalModel->getDetailJadwalByTanggal($today, 'personal')->getResultArray();
        $dataInfuseJadwalPersonal = $this->jadwalModel->getInfuseJadwalPersonalByTanggal($today)->getResultArray();
      }
    } else {
      $dataJadwalPersonal = $this->jadwalModel->getJadwalByTanggal($today, 'personal')->getResultArray();
      $dataDetailJadwalPersonal = $this->jadwalModel->getDetailJadwalByTanggal($today, 'personal')->getResultArray();
      $dataInfuseJadwalPersonal = $this->jadwalModel->getInfuseJadwalPersonalByTanggal($today)->getResultArray();
    }

    if (empty($dataJadwalFamily)) {
      $newToday = $this->jadwalModel->findJadwal($today)->getRowArray();
      if (!empty($newToday)) {
        $dataJadwalFamily = $this->jadwalModel->getJadwalByTanggal($newToday['tanggal_mulai'], 'family')->getResultArray();
        $dataDetailJadwalFamily = $this->jadwalModel->getDetailJadwalByTanggal($newToday['tanggal_mulai'], 'family')->getResultArray();
      } else {
        $dataJadwalFamily = $this->jadwalModel->getJadwalByTanggal($today, 'family')->getResultArray();
        $dataDetailJadwalFamily = $this->jadwalModel->getDetailJadwalByTanggal($today, 'family')->getResultArray();
      }
    } else {
      $dataJadwalFamily = $this->jadwalModel->getJadwalByTanggal($today, 'family')->getResultArray();
      $dataDetailJadwalFamily = $this->jadwalModel->getDetailJadwalByTanggal($today, 'family')->getResultArray();
    }

    $dataPaketMenu = $this->paketMenuModel->getPaketMenu('infuse')->getRowArray();
    $dataAllPaketMenu = $this->paketMenuModel->getAllPaketMenu()->getResultArray();

    $builder = $this->db->table('karbo');
    $query = $builder->get();
    $dataKarbo = $query->getResultArray();

    $data = [
      'title' => 'Kawa Healthy',
      'session' => $this->session,
      'dataJadwalPersonal' => $dataJadwalPersonal,
      'dataJadwalFamily' => $dataJadwalFamily,
      'dataDetailJadwalPersonal' => $dataDetailJadwalPersonal,
      'dataInfuseJadwalPersonal' => $dataInfuseJadwalPersonal,
      'dataDetailJadwalFamily' => $dataDetailJadwalFamily,
      'dataPaketMenu' => $dataPaketMenu,
      'dataAllPaketMenu' => $dataAllPaketMenu,
      'dataKarbo' => $dataKarbo
    ];

    // dd($dataDetailJadwalFamily);
    return view('user/homepage', $data);
  }
}
