<?php

namespace App\Controllers;

use App\Controllers\Admin\BiayaOngkir;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesananModel;
use App\Models\BiayaOngkirModel;
use App\Models\PaketMenuModel;
use App\Models\JadwalModel;
use App\Models\ReviewModel;

class Pesanan extends BaseController
{
  protected $pesananModel;
  protected $reviewModel;

  public function __construct()
  {
    $this->pesananModel = new PesananModel();
    $this->biayaOngkirModel = new BiayaOngkirModel();
    $this->paketMenuModel = new PaketMenuModel();
    $this->jadwalModel = new JadwalModel();
    $this->reviewModel = new ReviewModel();
  }

  public function daftarPesanan()
  {
    $idAkun = $this->session->get("id_akun");
    $kerangjangPesananByIdAkun = $this->pesananModel->pesananByIdAkun($idAkun, 1)->getResultArray(); // dikeranjang
    $totalHarga = $this->pesananModel->totalHargaPesananAkun($idAkun, 1)->getRowArray(); // dikeranjang
    $dataOngkir = $this->biayaOngkirModel->getAllOngkir()->getResultArray();
    $dataPaketMenu = $this->paketMenuModel->getPaketMenu('infuse')->getRowArray();

    $builder = $this->db->table('karbo');
    $query = $builder->get();
    $dataKarbo = $query->getResultArray();
    $data = [
      'title' => 'Daftar PesananKu',
      'session' => $this->session,
      'dataPesanan' => $kerangjangPesananByIdAkun,
      'dataPaketMenu' => $dataPaketMenu,
      'totalHarga' => $totalHarga,
      'dataKarbo' => $dataKarbo,
      'dataOngkir' => $dataOngkir
    ];

    // dd($kerangjangPesananByIdAkun);
    return view('user/daftarPesanan', $data);
  }

  public function hapusMenuPesanan()
  {
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $idDetailMenuPesanan = $this->request->getVar('idDetailMenuPesanan');
    $idAkun = $this->request->getVar('idAkun');
    $namaPack = $this->request->getVar('namaPack');
    $dataMenuPesanan = $this->pesananModel->getDataMenuPesananBy($idDetailMenuPesanan, $idAkun, 1)->getRowArray(); //dikeranjang
    if ($namaPack == "family") {
      $pedas = $dataMenuPesanan['keterangan_pedas'];
      $namaMenu = $dataMenuPesanan['nama_menu'];
      $otherIdDetailMenuPesanan = $this->pesananModel->getOtherIdDetailMenuPesananFamilyBy($pedas, $namaMenu, $idAkun, 1)->getResultArray();
    } else {
      $pantangan = $dataMenuPesanan['pantangan_pesanan'];
      $namaMenu = $dataMenuPesanan['nama_menu'];
      $namaPaket = $dataMenuPesanan['nama_paket_menu'];
      $namaKarbo = $dataMenuPesanan['nama_karbo'];
      $otherIdDetailMenuPesanan = $this->pesananModel->getOtherIdDetailMenuPesananPersonalBy($pantangan, $namaMenu, $namaPaket, $namaKarbo, $idAkun, 1)->getResultArray();
    }
    for ($i = 0; $i < count($otherIdDetailMenuPesanan); $i++) {
      $this->pesananModel->softDeleteMenuPesanan($otherIdDetailMenuPesanan[$i], $date);
    }
    $result = array(
      'data' => $otherIdDetailMenuPesanan
    );
    echo json_encode($result);
  }

  public function bayarPesananPaketan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idAkun = $this->session->get("id_akun");
    $listPaketMenu = json_decode($this->request->getVar('listPaketMenu'), true);
    $newListPaketMenuNoInfuse = [];
    $listPaketMenuNoInfuse = json_decode($this->request->getVar('listPaketMenuNoInfuse'), true);
    for ($i = 0; $i < count($listPaketMenuNoInfuse); $i++) {
      array_push($newListPaketMenuNoInfuse, $listPaketMenuNoInfuse[$i]["idPaketMenu"]);
    }
    $newListPaketMenuWithInfuse = [];
    $listPaketMenuWithInfuse = json_decode($this->request->getVar('listPaketMenuWithInfuse'), true);
    for ($i = 0; $i < count($listPaketMenuWithInfuse); $i++) {
      array_push($newListPaketMenuWithInfuse, $listPaketMenuWithInfuse[$i]["idPaketMenu"]);
    }
    $tanggalMulai = $this->request->getVar('tanggal');
    $jumlahHari = $this->request->getVar('jumlahHari');
    $karbo = $this->request->getVar('karbo');
    $pantangan = $this->request->getVar('pantangan');
    $ongkir = $this->request->getVar('ongkir');
    $alamat = $this->request->getVar('alamat');
    $nominal = $this->request->getVar('nominal');
    $atasNama = $this->request->getVar('atasNama');
    // Tangkap file
    $fileGambar = $this->request->getFile('fileGambar');
    $namaGambar = $fileGambar->getRandomName();

    $fileGambar->move('assets/img/bukti_transfer', $namaGambar);

    // insert tabel catatan pesanan
    if ($karbo != "-") {
      $data = [
        'id_karbo' => $karbo,
        'pantangan_paketan' => $pantangan,
        'tanggal_mulai_pesanan' => $tanggalMulai,
        'periode_hari_paketan' => $jumlahHari,
        'created_at' => $date
      ];
    } else {
      $data = [
        'pantangan_paketan' => $pantangan,
        'tanggal_mulai_pesanan' => $tanggalMulai,
        'periode_hari_paketan' => $jumlahHari,
        'created_at' => $date
      ];
    }
    $this->pesananModel->insertCatatanPesanan($data);

    // insert tabel detail catatan
    $idCatatanPesanan = $this->pesananModel->getMaxIdCatatanPesanan()->getRowArray()['id_catatan_pesanan'];
    for ($i = 0; $i < count($listPaketMenu); $i++) {
      $data = [
        'id_catatan_pesanan' => $idCatatanPesanan,
        'id_paket_menu' => $listPaketMenu[$i]['idPaketMenu'],
        'created_at' => $date
      ];
      $this->pesananModel->insertDetailCatatanPesanan($data);
    }

    // insert tabel pesanan
    $data = [
      'id_akun' => $idAkun,
      'id_catatan_pesanan' => $idCatatanPesanan,
      'created_at' => $date
    ];
    $this->pesananModel->insertPesanan($data);

    // insert table menu pesanan
    $idPesanan = $this->pesananModel->getMaxIdPesanan()->getRowArray()['id_pesanan'];
    $IdJadwalMenu = $this->pesananModel->getIdJadwalMenuBy($tanggalMulai)->getResultArray();
    for ($i = 0; $i < count($IdJadwalMenu); $i++) {
      if ($i == $jumlahHari) break;
      $data = [
        'id_pesanan' => $idPesanan,
        'id_jadwal_menu' => $IdJadwalMenu[$i]['id_jadwal_menu'],
        'created_at' => $date
      ];
      $this->pesananModel->insertMenuPesanan($data);
    }

    // insert table detail menu pesanan
    $idMenuPesanan = $this->pesananModel->getIdMenuPesananBy($tanggalMulai, $idPesanan)->getResultArray();
    $IdDetailJadwalMenu = $this->pesananModel->getIdDetailJadwalMenuBy($tanggalMulai, $newListPaketMenuNoInfuse, $newListPaketMenuWithInfuse)->getResultArray();
    foreach ($idMenuPesanan as $index => $menuPesanan) {
      if ($index == $jumlahHari) break;
      foreach ($IdDetailJadwalMenu as $detailJadwalMenu) {
        // Cocokkan id_jadwal_menu
        if ($menuPesanan['id_jadwal_menu'] == $detailJadwalMenu['id_jadwal_menu']) {
          $data = [
            'id_detail_jadwal_menu' => $detailJadwalMenu['id_detail_jadwal_menu'],
            'id_menu_pesanan' => $menuPesanan['id_menu_pesanan'],
            'id_karbo' => ($detailJadwalMenu['nama_paket_menu'] == "lunch") ? $karbo : NULL,
            'qty_menu' => ($detailJadwalMenu['nama_paket_menu'] != NULL) ? 1 : NULL,
            'qty_infuse' => ($detailJadwalMenu['nama_paket_menu'] == NULL) ? 1 : NULL,
            'pantangan_pesanan' => ($detailJadwalMenu['nama_paket_menu'] != NULL) ? $pantangan : NULL,
            'created_at' => $date
          ];
          $this->pesananModel->insertDetailMenuPesanan($data);

          // insert table status detail menu pesanan
          $idDetailMenuPesanan = $this->pesananModel->getMaxIdDetailMenuPesanan()->getRowArray()['id_detail_menu_pesanan'];
          $data = [
            'id_detail_menu_pesanan' => $idDetailMenuPesanan,
            'id_status_pesanan' => 2, // terbayar
            'created_at' => $date
          ];
          $this->pesananModel->insertStatusDetailMenuPesanan($data);
        }
      }
    }

    // insert tabel transaksi
    $data = [
      'id_pesanan' => $idPesanan,
      'tanggal_transaksi' => $date,
      'id_ongkir' => $ongkir,
      'alamat_pengiriman' => $alamat,
      'created_at' => $date
    ];
    $this->pesananModel->insertTransaksi($data);

    // insert tabel pembayaran
    $idTransaksi = $this->pesananModel->getIdTransaksiBy($idPesanan)->getRowArray()['id_transaksi'];
    $data = [
      'id_tipe_pembayaran' => 2, // lunas
      'id_transaksi' => $idTransaksi,
      'created_at' => $date
    ];
    $this->pesananModel->insertPembayaran($data);

    // insert detail pemabayaran
    $idPembayaran = $this->pesananModel->getIdPembayaranBy($idTransaksi)->getRowArray()['id_pembayaran'];
    $data = [
      'id_pembayaran' => $idPembayaran,
      'id_pesanan' => $idPesanan,
      'gambar_transfer' => $namaGambar,
      'nominal_pembayaran' => $nominal,
      'atas_nama_pembayaran' => $atasNama,
      'created_at' => $date
    ];
    $this->pesananModel->insertDetailPembayaran($data);

    $result = array(
      'idtran' => $idTransaksi,
      'data' => $data,
      'gambar' => $fileGambar->getName(),
      'idAkun' => $idAkun,
      'ongkir' => $ongkir,
      'listPaketMenu' => $listPaketMenu,
      'alamat' => $alamat,
      'nominal' => $nominal,
      'tanggal' => $tanggalMulai,
      'jumlahHari' => $jumlahHari,
      'karbo' => $karbo,
      'pantangan' => $pantangan,
      'atasNama' => $atasNama,
    );
    echo json_encode($result);
  }

  public function bayarPesanan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idAkun = $this->session->get("id_akun");
    $ongkir = $this->request->getVar('ongkir');
    $alamat = $this->request->getVar('alamat');
    $nominal = $this->request->getVar('nominal');
    $atasNama = $this->request->getVar('atasNama');
    $dataPesanan = json_decode($this->request->getVar('dataPesanan'), true);
    // Tangkap file
    $fileGambar = $this->request->getFile('fileGambar');
    $namaGambar = $fileGambar->getRandomName();

    $fileGambar->move('assets/img/bukti_transfer', $namaGambar);

    // insert tabel transaksi
    $idPesanan = $this->pesananModel->getIdPesananBy($idAkun, 1)->getRowArray()['id_pesanan']; // dikeranjang
    // $idPesanan = "121"; // dikeranjang
    $data = [
      'id_pesanan' => $idPesanan,
      'tanggal_transaksi' => $date,
      'id_ongkir' => $ongkir,
      'alamat_pengiriman' => $alamat,
      'created_at' => $date
    ];
    $this->pesananModel->insertTransaksi($data);

    // update pesanan menjadi terbayar
    // ?? $this->pesananModel->updatePesananBy($idPesanan, 2, $date); // terbayar
    // $idPesanan = 154;
    $idDetailMenuPesanan = $this->pesananModel->getIdMenuPesanan($idPesanan)->getResultArray();
    for ($i = 0; $i < count($idDetailMenuPesanan); $i++) {
      $this->pesananModel->updatePesananBy($idDetailMenuPesanan[$i]['id_detail_menu_pesanan'], 2, $date);
    }

    // insert tabel pembayaran
    $idTransaksi = $this->pesananModel->getIdTransaksiBy($idPesanan)->getRowArray()['id_transaksi'];
    $data = [
      'id_tipe_pembayaran' => 2, // lunas
      'id_transaksi' => $idTransaksi,
      'created_at' => $date
    ];
    $this->pesananModel->insertPembayaran($data);

    // insert detail pembayaran
    // $idTransaksi = "1"; // dikeranjang
    $idPembayaran = $this->pesananModel->getIdPembayaranBy($idTransaksi)->getRowArray()['id_pembayaran'];
    $data = [
      'id_pembayaran' => $idPembayaran,
      'id_pesanan' => $idPesanan,
      'gambar_transfer' => $namaGambar,
      'nominal_pembayaran' => $nominal,
      'atas_nama_pembayaran' => $atasNama,
      'created_at' => $date
    ];
    $this->pesananModel->insertDetailPembayaran($data);

    $result = array(
      // 'data' => $fileGambar->getName()
      'data' => $dataPesanan,
      'idAkun' => $idAkun,
      'ongkir' => $ongkir,
      'alamat' => $alamat,
      'nominal' => $nominal,
      'atasNama' => $atasNama,
    );
    echo json_encode($result);
  }

  public function pesananku()
  {
    $idAkun = $this->session->get("id_akun");
    $dataPesananPaketan = $this->pesananModel->getAllPesananPaketanBy($idAkun)->getResultArray();
    $dataPesananBiasa = $this->pesananModel->getAllPesananBiasaBy($idAkun, [2, 4, 5])->getResultArray(); // terbayar
    // dd($dataPesananPaketan);
    $data = [
      'title' => 'PesananKu',
      'session' => $this->session,
      'tabPesananKu' => 'pesananKu',
      'dataPesananBiasa' => $dataPesananBiasa,
      'dataPesananPaketan' => $dataPesananPaketan
    ];
    return view('user/pesananKu', $data);
  }

  public function detailPesananPaketan($idPesanan)
  {
    $idAkun = $this->session->get('id_akun');
    $catatanPaketan = $this->pesananModel->getCatatanPaketanBy($idAkun, $idPesanan)->getRowArray();
    $catatanPaketMenu = $this->pesananModel->getCatatanPaketMenuBy($idAkun, $idPesanan)->getResultArray();
    $totalHargaPaketan = $this->pesananModel->getTotalHargaPaketanBy($idAkun, $idPesanan)->getRowArray();
    $dataPesananPaketan = $this->pesananModel->getPesananPaketanBy($idAkun, $idPesanan)->getResultArray();
    $dataDetailPesananPaketan = $this->pesananModel->getDetailPesananPaketanBy($idAkun, $idPesanan)->getResultArray();
    $sisaPesananPaketan = $this->pesananModel->getSisaPesananPaketanBy($idAkun, $idPesanan)->getRowArray();
    $pesananTerkirim = $this->pesananModel->getPesananPaketanTerkirimBy($idAkun, $idPesanan)->getRowArray();
    // dd($catatanPaketan);
    $data = [
      'title' => 'Detail PesananKu',
      'session' => $this->session,
      'tabPesananKu' => 'pesananKu',
      'catatanPaketan' => $catatanPaketan,
      'catatanPaketMenu' => $catatanPaketMenu,
      'totalHargaPaketan' => $totalHargaPaketan,
      'dataPesananPaketan' => $dataPesananPaketan,
      'dataDetailPesananPaketan' => $dataDetailPesananPaketan,
      'sisaPesananPaketan' => $sisaPesananPaketan,
      'pesananTerkirim' => (!empty($pesananTerkirim) ? $pesananTerkirim : "0"),
    ];
    return view('user/pesananDetailPaketan', $data);
  }

  public function detailPesananBiasaSelesai($idPesanan, $idJadwalMenu)
  {
    $idAkun = $this->session->get('id_akun');
    $tanggalMenu = $this->jadwalModel->getTanggalMenuBy($idJadwalMenu)->getRowArray()['tanggal_menu'];
    $dataTransaksi = $this->pesananModel->getDataTransaksiBy($idPesanan, $tanggalMenu, [6])->getRowArray(); // selesai
    $dataPesananBiasa = $this->pesananModel->getDetailPesananBiasaBy($idPesanan, $tanggalMenu, [6])->getResultArray(); //terbayar
    $dataPaketMenu = $this->paketMenuModel->getPaketMenu('infuse')->getRowArray();
    $review = $this->reviewModel->getReview($idAkun, $dataTransaksi['id_menu_pesanan'])->getRowArray();
    // dd($review);
    $data = [
      'title' => 'Detail PesananKu',
      'session' => $this->session,
      'tabPesananKu' => 'pesananSelesai',
      'dataTransaksi' => $dataTransaksi,
      'dataPesanan' => $dataPesananBiasa,
      'dataPaketMenu' => $dataPaketMenu,
      'dataReview' => $review
    ];
    return view('user/pesananDetailBiasa', $data);
  }

  public function detailPesananBiasa($idPesanan, $idJadwalMenu)
  {
    $tanggalMenu = $this->jadwalModel->getTanggalMenuBy($idJadwalMenu)->getRowArray()['tanggal_menu'];
    $dataTransaksi = $this->pesananModel->getDataTransaksiBy($idPesanan, $tanggalMenu, [2, 4, 5, 6])->getRowArray();
    $dataPesananBiasa = $this->pesananModel->getDetailPesananBiasaBy($idPesanan, $tanggalMenu, [2, 4, 5, 6])->getResultArray(); //terbayar
    $dataPaketMenu = $this->paketMenuModel->getPaketMenu('infuse')->getRowArray();
    // dd($dataPesananBiasa);
    $data = [
      'title' => 'Detail PesananKu',
      'session' => $this->session,
      'tabPesananKu' => 'pesananKu',
      'dataTransaksi' => $dataTransaksi,
      'dataPesanan' => $dataPesananBiasa,
      'dataPaketMenu' => $dataPaketMenu,
    ];
    return view('user/pesananDetailBiasa', $data);
  }

  public function batalPesanan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idPesanan = $this->request->getVar('idPesanan');
    $idJadwalMenu = $this->request->getVar('idJadwalMenu');

    $tanggalMenu = $this->jadwalModel->getTanggalMenuBy($idJadwalMenu)->getRowArray()['tanggal_menu'];
    $dataPesananBiasa = $this->pesananModel->getDetailPesananBiasaBy($idPesanan, $tanggalMenu, [2])->getResultArray(); //terbayar

    foreach ($dataPesananBiasa as $data) {
      $updateData = [
        'batal' => "b",
        'updated_at' => $date
      ];
      $where = $data['id_detail_menu_pesanan'];
      $this->pesananModel->updateMenuPesananBy($where, $updateData);
    }

    $result = array(
      'data' => $dataPesananBiasa,
    );
    echo json_encode($result);
  }

  public function berhentiPaketan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idPesanan = $this->request->getVar('idPesanan');

    $dataMenuPesanan = $this->pesananModel->getIdMenuPesananWillBerhenti($idPesanan)->getResultArray();
    foreach ($dataMenuPesanan as $data) {
      $updateData = [
        'batal' => "b",
        'updated_at' => $date
      ];
      $where = $data['id_detail_menu_pesanan'];
      $this->pesananModel->updateMenuPesananBy($where, $updateData);
    }

    $updateDataPesanan = [
      'berhenti_paketan' => "y",
      'updated_at' => $date
    ];
    $where = $idPesanan;
    $this->pesananModel->updateDataPesananBy($updateDataPesanan, $where);

    $result = array(
      'data' => $updateDataPesanan,
    );
    echo json_encode($result);
  }

  public function gantiMasaHariPaketan()
  {
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $idPesanan = $this->request->getVar('idPesanan');
    $idAkun = $this->session->get('id_akun');
    $masaHariBaru = $this->request->getVar('masaHariBaru');
    $idCatatanPesanan = $this->request->getVar('idCatatanPesanan');

    $listIdMenuPesanan = [];
    $idDetailMenuPesanan = $this->pesananModel->getIdMenuPesananPaketan($idPesanan)->getResultArray();

    if (count($idDetailMenuPesanan) > $masaHariBaru) {
      // Ambil data id_menu_pesanan dengan limit
      $dataIdMenuPesanan = $this->pesananModel->getIdMenuPesananWithLimit($idPesanan, $masaHariBaru)->getResultArray();
      $listIdMenuPesanan = array_column($dataIdMenuPesanan, 'id_menu_pesanan');

      // Ambil data menu yang akan dibatalkan
      $idMenuPesananWillBatal = $this->pesananModel->getIdMenuPesananWillBatal($idPesanan, $listIdMenuPesanan)->getResultArray();
      foreach ($idMenuPesananWillBatal as $data) {
        $updateData = [
          'batal' => "b",
          'updated_at' => $date
        ];
        $where = $data['id_detail_menu_pesanan'];
        $this->pesananModel->updateMenuPesananBy($where, $updateData);
      }

      // Update atau insert masa_hari_batal
      $masaHariBaru = count($idDetailMenuPesanan) - $masaHariBaru;
      $this->updateOrInsertMasaHariBatal($idPesanan, $masaHariBaru);
    } else {
      $dataCatatanPesanan = $this->pesananModel->getCatatanPaketanBy($idAkun, $idPesanan)->getRowArray();
      $masaPaketan = $dataCatatanPesanan['periode_hari_baru'] ?? $dataCatatanPesanan['periode_hari_paketan'];
      $masaHariBatal = $masaPaketan - $masaHariBaru;

      if ($masaPaketan != $masaHariBaru) {
        // Update atau insert masa_hari_batal
        $this->updateOrInsertMasaHariBatal($idPesanan, $masaHariBatal);
      }
    }

    $data = [
      'periode_hari_baru' => $masaHariBaru,
      'updated_at' => $date
    ];
    $where = $idCatatanPesanan;
    $this->pesananModel->updateMasaHariPaketan($data, $where);

    $result = array(
      'data' => count($idDetailMenuPesanan),
    );
    echo json_encode($result);
  }

  /**
   * Fungsi untuk update atau insert masa_hari_batal
   */
  function updateOrInsertMasaHariBatal($idPesanan, $masaHari)
  {
    $cekIdPesananInMasaHariBatal = $this->pesananModel->getIdPesananInMasaHariBatal($idPesanan)->getRowArray();

    if (empty($cekIdPesananInMasaHariBatal)) {
      $data = [
        'id_pesanan' => $idPesanan,
        'masa_hari' => $masaHari
      ];
      $this->pesananModel->insertMasaHariBatal($data);
    } else {
      $data = [
        'masa_hari' => $cekIdPesananInMasaHariBatal['masa_hari'] + $masaHari
      ];
      $where = $idPesanan;
      $this->pesananModel->updateMasaHariBatal($data, $where);
    }
  }

  public function pesananDatang()
  {
    $idAkun = $this->session->get('id_akun');
    $date = date("Y-m-d");
    // $date = "2025-01-24";
    $dataPesanan = $this->pesananModel->getAllPesananPelanggan($date, $idAkun, [5])->getResultArray();
    $data = [
      'title' => 'Pesanan Datang',
      'session' => $this->session,
      'tabPesananKu' => 'pesananDatang',
      'dataPesanan' => $dataPesanan
    ];
    return view('user/pesananDatang', $data);
  }

  public function terimaPesanan()
  {
    $idAkun = $this->request->getVar('idAkun');
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    // $date = '2025-01-24 ' . date('H-i-s');
    $dataIdDetailMenuPesanan = $this->pesananModel->getIdDetailMenuPesananByAkun($idAkun, 5)->getResultArray();
    foreach ($dataIdDetailMenuPesanan as $data) {
      $this->pesananModel->updatePesananBy($data['id_detail_menu_pesanan'], 6, $date);
    }

    $result = array(
      'data' => $idAkun,
    );
    echo json_encode($result);
  }

  public function pesananSelesai()
  {
    $idAkun = $this->session->get('id_akun');
    $dataPesananUser = $this->pesananModel->getPesananDiterimaUser($idAkun)->getResultArray();
    // dd($dataPesananUser);
    $data = [
      'title' => 'Pesanan Selesai',
      'session' => $this->session,
      'tabPesananKu' => 'pesananSelesai',
      'dataPesananUser' => $dataPesananUser
    ];
    return view('user/pesananSelesai', $data);
  }

  public function tundaPesanan()
  {
    $idMenuPesanan = $this->request->getVar('idMenuPesanan');
    $idPesanan = $this->request->getVar('idPesanan');
    $date = date("Y-m-d") . ' ' . date('H-i-s');

    $data = [
      'id_menu_pesanan' => $idMenuPesanan,
      'id_pesanan' => $idPesanan,
      'jumlah_tunda' => 1,
      'created_at' => $date
    ];

    $this->pesananModel->insertTundaPesanan($data);

    $result = array(
      'data' => $idMenuPesanan
    );
    echo json_encode($result);
  }

  public function tambahDaftarPesanan()
  {
    $idJadwalMenu = $this->request->getVar('idJadwalMenu');
    $pack = $this->request->getVar('pack');
    $itemsMenu = $this->request->getVar('itemsMenu');

    // cari id pesan by id akun yang status pesanan di kerangjang
    $idAkun = $this->session->get('id_akun');
    $idPesanan = $this->pesananModel->getIdPesananBy($idAkun, 1)->getRowArray();
    if (!empty($idPesanan)) {
      // echo "true"; // Jika $idPesanan tidak kosong
      $idPesanan = $idPesanan['id_pesanan'];
    } else {
      // echo "kosong"; // Jika $idPesanan kosong
      // insert table pesanan
      $date = date("Y-m-d") . ' ' . date('H-i-s');
      $data = [
        'id_akun' => $idAkun,
        'created_at' => $date
      ];
      $this->pesananModel->insertPesanan($data);
      $idPesanan = $this->pesananModel->getMaxIdPesanan()->getRowArray()['id_pesanan'];
    }

    // insert table menu pesanan
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $data = [
      'id_pesanan' => $idPesanan,
      'id_jadwal_menu' => $idJadwalMenu,
      'created_at' => $date
    ];
    $this->pesananModel->insertMenuPesanan($data);

    // insert table detail menu pesanan
    $idMenuPesanan = $this->pesananModel->getMaxIdMenuPesanan()->getRowArray()['id_menu_pesanan'];
    // $idMenuPesanan = "122";
    $date = date("Y-m-d") . ' ' . date('H-i-s');
    $tes = [];
    for ($i = 0; $i < count($itemsMenu); $i++) {
      if ($pack == "personal") {
        $data = [
          'id_detail_jadwal_menu' => $itemsMenu[$i]['idDetailJadwalMenu'] ?? null,
          'id_menu_pesanan' => $idMenuPesanan,
          'id_karbo' => (isset($itemsMenu[$i]["infuse"]) && $itemsMenu[$i]["infuse"] == "y") ? null
            : ($itemsMenu[$i]['karbo'] ?? null),
          'qty_menu' => (isset($itemsMenu[$i]["infuse"]) && $itemsMenu[$i]["infuse"] == "y") ? null
            : ($itemsMenu[$i]['jumlahMenu'] ?? null),
          'qty_infuse' => (isset($itemsMenu[$i]["infuse"]) && $itemsMenu[$i]["infuse"] == "y") ? ($itemsMenu[$i]['jumlahMenu'] ?? null)
            : null,
          'pantangan_pesanan' => (isset($itemsMenu[$i]["infuse"]) && $itemsMenu[$i]["infuse"] == "y") ? null
            : ($itemsMenu[$i]['pantangan'] ?? null),
          'created_at' => $date
        ];
        $this->pesananModel->insertDetailMenuPesanan($data);
      }
      if ($pack == "family") {
        $data = [
          'id_detail_jadwal_menu' => (isset($itemsMenu[$i]["idDetailJadwalMenu"])) ? $itemsMenu[$i]['idDetailJadwalMenu'] : null,
          'id_menu_pesanan' => $idMenuPesanan,
          'qty_menu' => (isset($itemsMenu[$i]["jumlahMenu"])) ? $itemsMenu[$i]['jumlahMenu'] : null,
          'keterangan_pedas' => (isset($itemsMenu[$i]["pedas"])) ? $itemsMenu[$i]['pedas'] : null,
          'created_at' => $date
        ];
        array_push($tes, $data);
        $this->pesananModel->insertDetailMenuPesanan($data);
      }

      // insert table status detail menu pesanan
      $idDetailMenuPesanan = $this->pesananModel->getMaxIdDetailMenuPesanan()->getRowArray()['id_detail_menu_pesanan'];
      $data = [
        'id_detail_menu_pesanan' => $idDetailMenuPesanan,
        'id_status_pesanan' => 1, // keranjang
        'created_at' => $date
      ];
      $this->pesananModel->insertStatusDetailMenuPesanan($data);
    }

    $result = array(
      'idAkun' => $this->session->get('id_akun'),
      'itemsMenu' => $itemsMenu,
      // 'infuse' => $infuse,
      'pack' => $pack,
      'idPesanan' => $idPesanan,
      'idJadwalMenu' => $idJadwalMenu
    );
    echo json_encode($result);
  }
}
