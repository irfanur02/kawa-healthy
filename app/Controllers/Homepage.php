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

  public function lihatJadwalPersonal() {
    $today = date("Y-m-d");
    $dataJadwalPersonal = $this->jadwalModel->getJadwalBy($today, 'personal')->getResultArray();
    if (!empty($dataJadwalPersonal)) {
      $dataNextJadwalPersonal = $this->jadwalModel->getJadwalByTanggal($dataJadwalPersonal[0]['tanggal_mulai'], 'personal')->getResultArray();
      $dataNextDetailJadwalPersonal = $this->jadwalModel->getDetailJadwalByTanggal($dataJadwalPersonal[0]['tanggal_mulai'], 'personal')->getResultArray();
      $dataNextInfuseJadwalPersonal = $this->jadwalModel->getInfuseJadwalPersonalByTanggal($dataJadwalPersonal[0]['tanggal_mulai'])->getResultArray();
      $dataPaketMenu = $this->paketMenuModel->getPaketMenu('infuse')->getRowArray();

      $htmlContent = view('user/datatable/kontenJadwalPersonal', [
                            'dataJadwalPersonal' => $dataNextJadwalPersonal, 
                            'dataDetailJadwalPersonal' => $dataNextDetailJadwalPersonal, 
                            'dataInfuseJadwalPersonal' => $dataNextInfuseJadwalPersonal, 
                            'dataPaketMenu' => $dataPaketMenu]);

      $result = array(
        'element' => $htmlContent
      );
    } else {
      $result = array(
        'dataJadwal' => 'kosong'
      );
    }
    echo json_encode($result);
  }

  public function lihatJadwalFamily() {
    $today = date("Y-m-d");
    $dataJadwalFamily = $this->jadwalModel->getJadwalBy($today, 'family')->getResultArray();
    if (!empty($dataJadwalFamily)) {
      $dataNextJadwalFamily = $this->jadwalModel->getJadwalByTanggal($dataJadwalFamily[0]['tanggal_mulai'], 'family')->getResultArray();
      $dataNextDetailJadwalFamily = $this->jadwalModel->getDetailJadwalByTanggal($dataJadwalFamily[0]['tanggal_mulai'], 'family')->getResultArray();

      $htmlContent = view('user/datatable/kontenJadwalFamily', [
                            'dataJadwalFamily' => $dataNextJadwalFamily, 
                            'dataDetailJadwalFamily' => $dataNextDetailJadwalFamily]);

      $result = array(
        'element' => $htmlContent
      );
    } else {
      $result = array(
        'dataJadwal' => 'kosong'
      );
    }
    echo json_encode($result);
  }
}
