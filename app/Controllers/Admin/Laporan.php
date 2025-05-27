<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesananModel;
use App\Models\AkunModel;
use App\Models\PaketMenuModel;

class Laporan extends BaseController
{
  protected $pesananModel;
  protected $akunModel;
  protected $paketMenuModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
    $this->akunModel = new AkunModel();
    $this->paketMenuModel = new PaketMenuModel();
  }

  public function index()
  {
    $dataLaporan = $this->pesananModel->getDataLaporan()->getResultArray();
    // dd($dataLaporan);
    $perolehan = 0;
    foreach ($dataLaporan as $data) {
      $perolehan += $data['total_harga_family'] + $data['total_harga_personal'] + 
                    $data['total_harga_infuse'] + $data['total_harga_ongkir'];
    }
    $data = [
      'title' => 'Laporan',
      'sidebar' => 'laporan',
      'dataLaporan' => $dataLaporan,
      'perolehan' => $perolehan
    ];
    return view('admin/laporan', $data);
  }

  public function laporanByPeriode()
  {
    $tanggalAwal = $this->request->getVar("tanggalAwal");
    $tanggalAkhir = $this->request->getVar("tanggalAkhir");
    $range = $this->request->getVar("range");

    $dataLaporan = $this->pesananModel->getDataLaporan($tanggalAwal, $tanggalAkhir)->getResultArray();
    $perolehan = 0;
    foreach ($dataLaporan as $data) {
      $perolehan += $data['total_harga_family'] + $data['total_harga_personal'] + 
                    $data['total_harga_infuse'] + $data['total_harga_ongkir'];
    }
    // $dataJadwalMenu = $this->jadwalModel->getAllJadwalMenuByPack($pack)->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByPeriode', ['dataLaporan' => $dataLaporan, 'laporan' => 'periode', 'range' => $range, 'tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir, 'perolehan' => $perolehan]);

    // $htmlContent = view('admin/datatable/dataTableLapora nByPeriode');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "periode",
      'data' => $dataLaporan,
      'range' => $range
    );
    echo json_encode($result);
  }

  public function laporanByBulan()
  {
    $dataTahunPerolehan = $this->pesananModel->getTahunPerolehan()->getResultArray();
    $dataLaporanPerBulan = $this->pesananModel->getDataLaporanBulan()->getResultArray();
    $dataPerolehanPemasukan = 0;
    foreach ($dataLaporanPerBulan as $data) {
      $dataPerolehanPemasukan += $data['total_harga_ongkir'] + $data['total_harga_family'] + 
                                $data['total_harga_personal'] + $data['total_harga_infuse'];
    }
    $htmlContent = view('admin/datatable/dataTableLaporanByPeriode', ['dataLaporanPerBulan' => $dataLaporanPerBulan, 'laporan' => "bulan", 'tahunPerolehan' => $dataTahunPerolehan, 
      'dataPerolehanPemasukan' => $dataPerolehanPemasukan]);

    $result = array(
      'element' => $htmlContent,
      'data' => $dataLaporanPerBulan,
      'laporan' => "bulan"
    );
    echo json_encode($result);
  }

  public function laporanFrekuensiHariByBulan() {
    $tanggal = $this->request->getVar('tanggal');
    $bulanTahun = date('Y-m', strtotime($tanggal));
    $dataFrekuensiHari = $this->pesananModel->getFrekuensiHariByTanggal($bulanTahun)->getRowArray();
    $result = array(
      // 'element' => $htmlContent,
      'dataFrekuensiHari' => $dataFrekuensiHari,
      'tanggal' => $tanggal
    );
    echo json_encode($result);
  }

  public function laporanAktifitas() {
    $tanggal = $this->request->getVar('tanggal');
    $laporan = $this->request->getVar('laporan');
    // $bulanTahun = date('Y-m', strtotime($tanggal));
    $dataAktifitas = $this->pesananModel->getAktifitasPerBulan($tanggal, $laporan)->getResultArray();

    $htmlContent = view('admin/datatable/dataTableLaporanAktifitas', ['dataAktifitas' => $dataAktifitas]);
    $result = array(
      'element' => $htmlContent,
      'data' => $dataAktifitas
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

  public function laporanDetailPelangganPemesanan() {
    $idAkun = $this->request->getVar("idAkun");
    $tanggal = $this->request->getVar("tanggal");
    $dataPesananPelangganAkun = $this->pesananModel->getAllPesananPelangganAkun($idAkun, $tanggal)->getResultArray();
    $dataMenuPesananPelangganAkun = $this->pesananModel->getAllMenuPesananPelangganAkun($idAkun, $tanggal)->getResultArray();

    $htmlContent = view('admin/datatable/dataTableLaporanDetailPelangganPemesanan', [
              'dataPesananPelangganAkun' => $dataPesananPelangganAkun, 
              'dataMenuPesananPelangganAkun' => $dataMenuPesananPelangganAkun]);
    // $htmlContent = view('admin/datatable/dataTableLaporanDetailPelangganPemesanan');

    $result = array(
      'element' => $htmlContent,
      'dataPesananPelangganAkun' => $dataPesananPelangganAkun,
      'dataMenuPesananPelangganAkun' => $dataMenuPesananPelangganAkun
    );
    echo json_encode($result);
  }

  public function laporanByDetailPelanggan()
  {
    $idAkun = $this->request->getVar("id");
    $dataPelanggan = $this->akunModel->getDataPelangganById($idAkun)->getRowArray();
    $dataTotalPembelianPelanggan = $this->pesananModel->getTotalPembelianPelanggan($idAkun)->getRowArray();
    $dataPemesananPelanggan = $this->pesananModel->getDataPemesananPelanggan($idAkun)->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanDetailPelanggan', [
              'dataPemesananPelanggan' => $dataPemesananPelanggan, 
              'dataTotalPembelianPelanggan' => $dataTotalPembelianPelanggan, 
              'dataPelanggan' => $dataPelanggan,
              'idAkun' => $idAkun]);
    // $htmlContent = view('admin/datatable/dataTableLaporanDetailPelanggan');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "detail pelanggan",
      'id' => $dataPemesananPelanggan,
      'dataTotalPembelianPelanggan' => $dataTotalPembelianPelanggan
    );
    echo json_encode($result);
  }

  public function laporanByMenu()
  {
    $paketInfuse = $this->paketMenuModel->getPaketMenu("infuse")->getRowArray();
    $dataJumlahPesananDataMenu = $this->pesananModel->getJumlahPesananDataMenu()->getResultArray();
    $htmlContent = view('admin/datatable/dataTableLaporanByMenu', ['dataJumlahPesananDataMenu' => $dataJumlahPesananDataMenu, 'paketInfuse' => $paketInfuse['harga_paket_menu']]);

    // $htmlContent = view('admin/datatable/dataTableLaporanByMenu');

    $result = array(
      'element' => $htmlContent,
      'laporan' => "menu"
    );
    echo json_encode($result);
  }
}
