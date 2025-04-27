<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesananModel;
use App\Models\AkunModel;

class Laporan extends BaseController
{
  protected $pesananModel;
  protected $akunModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
    $this->akunModel = new AkunModel();
  }

  public function index()
  {
    $dataLaporan = $this->pesananModel->getDataLaporan()->getResultArray();
    $data = [
      'title' => 'Laporan',
      'sidebar' => 'laporan',
      'dataLaporan' => $dataLaporan
    ];
    return view('admin/laporan', $data);
  }

  public function laporanByPeriode()
  {
    $tanggalAwal = $this->request->getVar("tanggalAwal");
    $tanggalAkhir = $this->request->getVar("tanggalAkhir");

    $dataLaporan = $this->pesananModel->getDataLaporan($tanggalAwal, $tanggalAkhir)->getResultArray();
    // $dataJadwalMenu = $this->jadwalModel->getAllJadwalMenuByPack($pack)->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByPeriode', ['dataLaporan' => $dataLaporan, 'laporan' => 'periode']);

    // $htmlContent = view('admin/datatable/dataTableLapora nByPeriode');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "periode"
    );
    echo json_encode($result);
  }

  public function laporanByBulan()
  {
    $dataLaporanPerBulan = $this->pesananModel->getDataLaporanBulan()->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByPeriode', ['dataLaporanPerBulan' => $dataLaporanPerBulan, 'laporan' => "bulan"]);

    $result = array(
      'element' => $htmlContent,
      'data' => $dataLaporanPerBulan,
      'laporan' => "bulan"
    );
    echo json_encode($result);
  }

  public function laporanByPelanggan()
  {
    $dataJumlahPemesananPelanggan = $this->pesananModel->getJumlahPemesananPelanggan()->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByPelanggan', ['dataJumlahPemesananPelanggan' => $dataJumlahPemesananPelanggan]);

    // $htmlContent = view('admin/datatable/dataTableLaporanByPelanggan');

    $result = array(
      'element' => $htmlContent,
      'data' => $dataJumlahPemesananPelanggan,
      'laporan' => "pelanggan"
    );
    echo json_encode($result);
  }

  public function laporanByDetailPelanggan()
  {
    $idAkun = $this->request->getVar("id");
    $dataPelanggan = $this->akunModel->getDataPelangganById($idAkun)->getRowArray();
    $dataPemesananPelanggan = $this->pesananModel->getDataPemesananPelanggan($idAkun)->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanDetailPelanggan', ['dataPemesananPelanggan' => $dataPemesananPelanggan, 'dataPelanggan' => $dataPelanggan]);

    // $htmlContent = view('admin/datatable/dataTableLaporanDetailPelanggan');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "detail pelanggan",
      'id' => $dataPemesananPelanggan
    );
    echo json_encode($result);
  }

  public function laporanByMenu()
  {
    $dataJumlahPesananDataMenu = $this->pesananModel->getJumlahPesananDataMenu()->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByMenu', ['dataJumlahPesananDataMenu' => $dataJumlahPesananDataMenu]);

    // $htmlContent = view('admin/datatable/dataTableLaporanByMenu');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "menu"
    );
    echo json_encode($result);
  }
}
