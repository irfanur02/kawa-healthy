<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesananModel;

class Pesanan extends BaseController
{

  protected $pesananModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
  }

  // public function index()
  // {
  //   $dataAllPesananUser = $this->pesananModel->getAllPesananUser()->getResultArray();

  //   $data = [
  //     'title' => 'Pembayaran',
  //     'sidebar' => 'pesanan',
  //     'tabPesanan' => 'pesananPembayaran',
  //     'dataAllPesananUser' => $dataAllPesananUser
  //   ];
  //   return view('admin/pesananPembayaran', $data);
  // }

  public function pesananApproved()
  {
    $idPesanan = $this->request->getVar('idPesanan');

    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $data = [
      'approved' => 'y',
      'updated_at' => $date
    ];

    $this->pesananModel->updateDataPesananBy($data, $idPesanan);

    $result = array(
      'idPesanan' => $idPesanan
    );
    echo json_encode($result);
  }

  public function pesananNotApproved()
  {
    $idPesanan = $this->request->getVar('idPesanan');

    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $data = [
      'approved' => 'n',
      'updated_at' => $date
    ];

    $this->pesananModel->updateDataPesananBy($data, $idPesanan);

    $result = array(
      'idPesanan' => $idPesanan
    );
    echo json_encode($result);
  }

  public function pesananDetailPembayaran()
  {
    $idPesanan = $this->request->getVar('idPesanan');

    $dataPembayaran = $this->pesananModel->getDetailPembayaranBy($idPesanan)->getRowArray();

    $result = array(
      'dataPembayaran' => $dataPembayaran
    );
    echo json_encode($result);
  }

  public function pesananPembayaran()
  {
    $dataAllPesananUser = $this->pesananModel->getAllPesananUser('baru')->getResultArray();
    // dd($dataAllPesananUser);
    $data = [
      'title' => 'Pembayaran',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananPembayaran',
      'dataAllPesananUser' => $dataAllPesananUser
    ];
    return view('admin/pesananPembayaran', $data);
  }

  public function historiPembayaran() {
    $dataAllPesananUser = $this->pesananModel->getAllPesananUser('histori')->getResultArray();
    $htmlContent = view('admin/datatable/dataTableHistoriPembayaran', ['dataAllPesananUser' => $dataAllPesananUser]);

    $result = array(
      'element' => $htmlContent
    );
    echo json_encode($result);
  }

  public function pembayaranMasuk() {
    $dataAllPesananUser = $this->pesananModel->getAllPesananUser('baru')->getResultArray();
    $htmlContent = view('admin/datatable/dataTableHistoriPembayaran', ['dataAllPesananUser' => $dataAllPesananUser]);

    $result = array(
      'element' => $htmlContent
    );
    echo json_encode($result);
  }

  public function pesananMasuk()
  {
    $dataMenuPesanan = $this->pesananModel->getAllMenuPesanan(2)->getResultArray(); // terbayar
    $dataMenuDetailMenuPesanan = $this->pesananModel->getAllMenuDetailMenuPesanan(2)->getResultArray(); // terbayar
    $dataPackDetailMenuPesanan = $this->pesananModel->getAllPackDetailMenuPesanan(2)->getResultArray(); // terbayar
    $dataKarboDetailMenuPesanan = $this->pesananModel->getAllKarboDetailMenuPesanan(2)->getResultArray(); // terbayar
    // dd($dataMenuPesanan);
    // d($dataMenuDetailMenuPesanan);
    // d($dataPackDetailMenuPesanan);
    // d($dataKarboDetailMenuPesanan);
    // die();
    $data = [
      'title' => 'pesanan Masuk',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananMasuk',
      'dataMenuPesanan' => $dataMenuPesanan,
      'dataMenuDetailMenuPesanan' => $dataMenuDetailMenuPesanan,
      'dataPackDetailMenuPesanan' => $dataPackDetailMenuPesanan,
      'dataKarboDetailMenuPesanan' => $dataKarboDetailMenuPesanan
    ];
    return view('admin/pesananMasuk', $data);
  }

  public function pesananDetail($tanggalMenu)
  {
    $dataPelangganPemesanan = $this->pesananModel->getAllPelangganPemesanan($tanggalMenu)->getResultArray();
    $dataPesananPelanggan = $this->pesananModel->getAllPesananPelanggan($tanggalMenu, null, [2])->getResultArray();
    // dd($dataPelangganPemesanan);
    $data = [
      'title' => 'Detail Pesanan',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananMasuk',
      'dataPelangganPemesanan' => $dataPelangganPemesanan,
      'dataPesananPelanggan' => $dataPesananPelanggan,
      'tanggalMenu' => $tanggalMenu
    ];
    return view('admin/pesananDetail', $data);
  }

  public function pesananBatal()
  {
    $getAllPaketanPesananGantiMasa = $this->pesananModel->getAllPaketanPesananGantiMasa()->getResultArray();
    $getAllPaketanPesananBerhenti = $this->pesananModel->getAllPaketanPesananBerhenti()->getResultArray();
    $dataAllPesananBatal = $this->pesananModel->getAllBatalPesanan()->getResultArray();
    // dd($dataAllPesananBatal);
    $data = [
      'title' => 'Pesanan Batal',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananBatal',
      'getAllPaketanPesananGantiMasa' => $getAllPaketanPesananGantiMasa,
      'dataAllPesananBatal' => $dataAllPesananBatal,
      'dataAllPaketanPesananBerhenti' => $getAllPaketanPesananBerhenti
    ];
    return view('admin/pesananBatal', $data);
  }

  public function kembalikanUangPesanan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idPesanan = $this->request->getVar('idPesanan');
    $idMenuPesanan = $this->request->getVar('idMenuPesanan');
    $idMasaHariBatal = $this->request->getVar('idMasaHariBatal');
    $status = $this->request->getVar('status');

    if ($status == "gantiMasaHari") {
      $data = [
        'uang_dikembalikan' => 'y',
        'updated_at' => $date
      ];
      $where = $idMasaHariBatal;
      $this->pesananModel->updateUangDikembalikan($data, $where);
    } elseif ($status == "berhentiPaketan") {
      // $dataIdDetailMenuPesanan = 
      $dataIdMenuPesanan = $this->pesananModel->getDetailMenuPesananBy($idPesanan)->getResultArray();
      $dataIdDetailMenuPesanan = [];
      foreach ($dataIdMenuPesanan as $data) {
        $idDetailMenuPesanan = $this->pesananModel->getIdDetailMenuPesanan($data['id_menu_pesanan'])->getResultArray();
        foreach ($idDetailMenuPesanan as $dataSub) {
          $idDetailMenuPesanan1 = $dataSub['id_detail_menu_pesanan'];
          array_push($dataIdDetailMenuPesanan, ['id_detail_menu_pesanan' => $idDetailMenuPesanan1]);
        }
      }
      $statusPesanan = 9;
    } elseif ($status == "batalMenuPesanan") {
      $dataIdDetailMenuPesanan = $this->pesananModel->getIdDetailMenuPesanan($idMenuPesanan)->getResultArray();
      $statusPesanan = 4;
    }

    if ($status == "berhentiPaketan" || $status == "batalMenuPesanan") {
      foreach ($dataIdDetailMenuPesanan as $data) {
        $this->pesananModel->updatePesananBy($data['id_detail_menu_pesanan'], $statusPesanan, $date);
      }
    }

    $result = array(
      'data' => $idPesanan,
      'data1' => $idMenuPesanan,
      'data2' => $idMasaHariBatal,
      'data3' => $status,
      'data4' => $data,
    );
    echo json_encode($result);
  }

  public function kirimPesanan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $tanggalMenu = $this->request->getVar('tanggalMenu');

    $dataIdDetailMenuPesanan = $this->pesananModel->getAllIdDetailMenuPesanan($tanggalMenu)->getResultArray();

    foreach ($dataIdDetailMenuPesanan as $data) {
      $this->pesananModel->updatePesananBy($data['id_detail_menu_pesanan'], 5, $date);
    }

    $result = array(
      'data' => $tanggalMenu,
    );
    echo json_encode($result);
  }

  public function pesananRiwayat()
  {
    $dataPesananPelangganSelesai = $this->pesananModel->getAllPesananPelangganSelesai()->getResultArray();
    $dataMenuPesananPelangganSelesai = $this->pesananModel->getAllMenuPesananPelangganSelesai()->getResultArray();
    // d($dataPesananPelangganSelesai);
    // d($dataMenuPesananPelangganSelesai);
    // die();
    $data = [
      'title' => 'Pesanan Riwayat',
      'sidebar' => 'pesanan',
      'tabPesanan' => 'pesananRiwayat',
      'dataPesananPelangganSelesai' => $dataPesananPelangganSelesai,
      'dataMenuPesananPelangganSelesai' => $dataMenuPesananPelangganSelesai
    ];
    return view('admin/pesananRiwayat', $data);
  }
}
