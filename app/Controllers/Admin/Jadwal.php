<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\Admin\Pack;
use App\Models\JadwalModel;
use App\Models\PesananModel;

class Jadwal extends BaseController
{
  protected $packController;
  protected $jadwalModel;
  protected $pesananModel;

  public function __construct()
  {
    $this->packController = new Pack();
    $this->jadwalModel = new JadwalModel();
    $this->pesananModel = new PesananModel();
  }

  public function index()
  {
    $dataPack = $this->packController->getAllPack();
    $dataJadwalMenu = $this->jadwalModel->getAllJadwalMenuByPack('family')->getResultArray();
    $data = [
      'title' => 'Kelola Jadwal Menu',
      'sidebar' => 'kelolaJadwalMenu',
      'dataPack' => $dataPack,
      'dataJadwalMenu' => $dataJadwalMenu
    ];
    return view('admin/jadwalMenu', $data);
  }

  public function viewJadwal()
  {
    $pack = $this->request->getVar('pack');
    $dataJadwalMenu = $this->jadwalModel->getAllJadwalMenuByPack($pack)->getResultArray();
    if ($pack == 'family') {
      $pack = 'family';
    } else {
      $pack = 'personal';
    }
    $htmlContent = view('admin/datatable/dataTableJadwalMenu', ['dataJadwalMenu' => $dataJadwalMenu, 'dataPack' => $pack]);

    $result = array(
      'dataJadwal' => $htmlContent
    );
    echo json_encode($result);
  }

  public function createMenuFamily()
  {
    $maxTanggalAkhir = $this->jadwalModel->getMaxTanggalAkhir('family')->getRowArray();
    // dd($maxTanggalAkhir);
    $data = [
      'title' => 'Buat Jadwal Family Pack',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'save',
      'jadwalKadaluarsa' => true,
      'maxTanggalAkhir' => $maxTanggalAkhir
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function createMenuPersonal()
  {
    $maxTanggalAkhir = $this->jadwalModel->getMaxTanggalAkhir('personal')->getRowArray();
    // dd($maxTanggalAkhir);
    $data = [
      'title' => 'Buat Jadwal Personal Pack',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'save',
      'jadwalKadaluarsa' => true,
      'maxTanggalAkhir' => $maxTanggalAkhir
    ];
    return view('admin/jadwalMenuPersonal', $data);
  }

  public function cariMenu()
  {
    $keyword = $this->request->getVar('keyword');
    $pack = $this->request->getVar('pack');

    if ($keyword !== '') {
      if ($pack == 'family') {
        $builder = $this->db->table('menu');
        $builder->select('menu.id_menu, menu.nama_menu');
        $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
        $builder->like('menu.nama_menu', $keyword);
        $builder->where('pack.nama_pack', $pack);
        $builder->where('menu.deleted_at', null);
        $builder->limit('7');
        $query = $builder->get();
        $dataPencarian = $query->getResult();
      }

      if ($pack == 'personal') {
        $paket = $this->request->getVar('paket');

        $builder = $this->db->table('menu');
        $builder->select('menu.id_menu, menu.nama_menu');
        $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
        $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
        $builder->like('menu.nama_menu', $keyword);
        $builder->where('pack.nama_pack', $pack);
        $builder->where('paket_menu.nama_paket_menu', $paket);
        $builder->where('menu.deleted_at', null);
        $builder->limit('7');
        $query = $builder->get();
        $dataPencarian = $query->getResult();
      }
      // $dataPencarian = $this->jadwalModel->getMenuByNameByPack($keyword, $pack)->getResult();
    }
    $result = array(
      'dataPencarian' => $dataPencarian
    );
    echo json_encode($result);
  }

  public function saveJadwalFamily()
  {
    $dataJadwal = $this->request->getVar('dataJadwal');

    $date = date("Y-m-d") . ' ' . date("H:i:s");

    // insert data to table jadwal
    $data = [
      'tanggal_mulai' => $dataJadwal[0]['tanggal'],
      'tanggal_akhir' => $dataJadwal[count($dataJadwal) - 1]['tanggal'],
      'created_at' => $date
    ];
    $this->jadwalModel->insertJadwal($data);

    // insert data to table jadwal menu
    $maxIdJadwal = $this->jadwalModel->getMaxIdJadwal()->getRowArray()['id_jadwal'];
    for ($i = 0; $i < count($dataJadwal); $i++) {
      $data = [
        'id_jadwal' => $maxIdJadwal,
        'tanggal_menu' => $dataJadwal[$i]['tanggal'],
        'status_libur' => ($dataJadwal[$i]['cbLibur'] == 'true') ? "L" : "B",
        'created_at' => $date
      ];
      $this->jadwalModel->insertJadwalMenu($data);

      // insert data to detail jadwal menu
      $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
      if ($dataJadwal[$i]['cbLibur'] == 'false') {
        for ($j = 0; $j < count($dataJadwal[$i]['itemsMenu']); $j++) {
          $data = [
            'id_jadwal_menu' => $maxIdJadwalMenu,
            'id_menu' => $dataJadwal[$i]['itemsMenu'][$j],
            'created_at' => $date
          ];
          $this->jadwalModel->insertDetailJadwalMenu($data);
        }
      }
    }
    $result = array(
      'data' => $dataJadwal
    );
    echo json_encode($result);
  }

  public function editMenuFamily($id = '')
  {
    $date = date("Y-m-d");
    $dataJadwalMenu = $this->jadwalModel->getJadwalMenuById($id)->getResultArray();
    $dataDetailJadwal = $this->jadwalModel->getDetailJadwalByIdByPack($id, 'family')->getResultArray();
    $jadwalKadaluarsa = false;
    foreach ($dataJadwalMenu as $tanggal) {
      ($tanggal['tanggal_menu'] > $date) ? $jadwalKadaluarsa = true : $jadwalKadaluarsa = false;
    }
    // dd($dataJadwalMenu);
    $data = [
      'title' => 'Edit Jadwal Personal Family',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'update',
      'idJadwal' => $id,
      'jadwalKadaluarsa' => $jadwalKadaluarsa,
      'dataJadwalMenu' => $dataJadwalMenu,
      'dataDetailJadwal' => $dataDetailJadwal
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function updateJadwalFamily()
  {
    $idJadwal = $this->request->getVar('idJadwal');
    $dataJadwal = $this->request->getVar('dataJadwal');
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $tanggalAwal = '';
    $tanggalAkhir = '';

    if (!empty($dataJadwal)) {
      for ($i = 0; $i < count($dataJadwal); $i++) {
        if ($dataJadwal[$i]['jadwal'] != "hapus") {
          $tanggalAwal = $dataJadwal[$i]['tanggal'];
          break;
        }
      }
      for ($i = count($dataJadwal) - 1; $i >= 0; $i--) {
        if (
          $dataJadwal[$i]['jadwal'] == "update" ||
          $dataJadwal[$i]['jadwal'] == "tambah" ||
          $dataJadwal[$i]['jadwal'] == "baca"
        ) {
          $tanggalAkhir = $dataJadwal[$i]['tanggal'];
          break;
        }
      }
      $dataTanggal = [
        'tanggal_mulai' => $tanggalAwal,
        'tanggal_akhir' => $tanggalAkhir,
        'updated_at' => $date
      ];
      $this->jadwalModel->updateJadwal($dataTanggal, $idJadwal);

      $tesHapus = [];
      $tesUpdate = [];
      $dataMenuAsli = [];
      $dataMenuBaru = [];
      foreach ($dataJadwal as $index => $jadwalMenu) {
        if ($jadwalMenu['cbLibur'] == 'false') {
          $data = [
            'status_libur' => 'B',
            'updated_at' => $date
          ];
          $where = $jadwalMenu['idJadwalMenu'];
          $this->jadwalModel->updateJadwalMenu($data, $where);

          if ($jadwalMenu['jadwal'] == 'hapus') {
            array_push($tesHapus, $jadwalMenu['idJadwalMenu']);
            $dataDeleteJadwalMenu = [
              'deleted_at' => $date
            ];
            $where = $jadwalMenu['idJadwalMenu'];
            $this->jadwalModel->updateJadwalMenu($dataDeleteJadwalMenu, $where);
          }

          if ($jadwalMenu['jadwal'] == 'update') {
            array_push($tesUpdate, $jadwalMenu['idJadwalMenu']);
            $dataDetailJadwalMenu = $this->jadwalModel->getDetailJadwalMenu($jadwalMenu['idJadwalMenu'])->getResultArray();
            foreach ($dataDetailJadwalMenu as $index => $data) {
              array_push($dataMenuAsli, $data['id_menu']);
            }
            for ($i = 0; $i < count($jadwalMenu['itemsMenuUpdate']); $i++) {
              array_push($dataMenuBaru, $jadwalMenu['itemsMenuUpdate'][$i]);
            }

            $menuTambah = array_values(array_diff($dataMenuBaru, $dataMenuAsli));
            $menuHapus = array_values(array_diff($dataMenuAsli, $dataMenuBaru));

            // update data to detail jadwal menu
            if (!empty($menuTambah)) {
              // insert
              for ($i = 0; $i < count($menuTambah); $i++) {
                $dataMenuTambah = [
                  'id_jadwal_menu' => $jadwalMenu['idJadwalMenu'],
                  'id_menu' => $menuTambah[$i],
                  'created_at' => $date
                ];
                $this->jadwalModel->insertDetailJadwalMenu($dataMenuTambah);
              }
            }
            if (!empty($menuHapus)) {
              // hapus soft
              for ($i = 0; $i < count($menuHapus); $i++) {
                $dataMenuHapus = [
                  'deleted_at' => $date
                ];
                $where = [
                  'id_jadwal_menu' => $jadwalMenu['idJadwalMenu'],
                  'id_menu' => $menuHapus[$i],
                ];
                $this->jadwalModel->updateDetailJadwalMenu($dataMenuHapus, $where);
              }
            }
          }

          if ($jadwalMenu['jadwal'] == 'tambah') {
            // insert data to table jadwal menu
            $dataTambahHari = [
              'id_jadwal' => $idJadwal,
              'tanggal_menu' => $jadwalMenu['tanggal'],
              'status_libur' => ($jadwalMenu['cbLibur'] == 'true') ? "L" : "B",
              'created_at' => $date
            ];
            $this->jadwalModel->insertJadwalMenu($dataTambahHari);

            // insert data to detail jadwal menu
            $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
            if ($jadwalMenu['cbLibur'] == 'false') {
              for ($j = 0; $j < count($jadwalMenu['itemsMenuAdd']); $j++) {
                $data = [
                  'id_jadwal_menu' => $maxIdJadwalMenu,
                  'id_menu' => $jadwalMenu['itemsMenuAdd'][$j],
                  'created_at' => $date
                ];
                $this->jadwalModel->insertDetailJadwalMenu($data);
              }
            }
          }
        } else {
          $data = [
            'status_libur' => 'L',
            'updated_at' => $date
          ];
          $where = $jadwalMenu['idJadwalMenu'];
          $this->jadwalModel->updateJadwalMenu($data, $where);
        }
      }
    }
    $result = array(
      // 'dataTambahHari' => $dataTambahHari,
      'dataJadwal' => $dataJadwal,
      'dataTanggal' => $dataTanggal,
      'tanggalAwal' => $tanggalAwal,
      'tanggalAkhir' => $tanggalAkhir,
      'tesHapus' => $tesHapus,
      'tesUpdate' => $tesUpdate,
      'dataMenuAsli' => $dataMenuAsli,
      'dataMenuBaru' => $dataMenuBaru,
      'dataMenuTambah' => (empty($menuTambah)) ? 'kosong' : $menuTambah,
      'dataMenuHapus' => (empty($menuHapus)) ? 'kosong' : $menuHapus,
    );
    echo json_encode($result);
  }

  public function saveJadwalPersonal()
  {
    $dataJadwal = $this->request->getVar('dataJadwal');
    $date = date("Y-m-d") . ' ' . date("H:i:s");

    // insert data to table jadwal
    $data = [
      'tanggal_mulai' => $dataJadwal[0]['tanggal'],
      'tanggal_akhir' => $dataJadwal[count($dataJadwal) - 1]['tanggal'],
      'created_at' => $date
    ];
    $this->jadwalModel->insertJadwal($data);

    // insert data to table jadwal menu
    $maxIdJadwal = $this->jadwalModel->getMaxIdJadwal()->getRowArray()['id_jadwal'];
    for ($i = 0; $i < count($dataJadwal); $i++) {
      $data = [
        'id_jadwal' => $maxIdJadwal,
        'tanggal_menu' => $dataJadwal[$i]['tanggal'],
        'status_libur' => ($dataJadwal[$i]['cbLibur'] == 'true') ? "L" : "B",
        'infuse' => 'Y',
        'created_at' => $date
      ];
      $this->jadwalModel->insertJadwalMenu($data);

      $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
      // insert data to detail jadwal menu
      if ($dataJadwal[$i]['cbLibur'] == 'false') {
        $data = [
          'id_jadwal_menu' => $maxIdJadwalMenu,
          'id_menu' => $dataJadwal[$i]['idMenuLunch'],
          'created_at' => $date
        ];
        $this->jadwalModel->insertDetailJadwalMenu($data);
        $data = [
          'id_jadwal_menu' => $maxIdJadwalMenu,
          'id_menu' => $dataJadwal[$i]['idMenuDinner'],
          'created_at' => $date
        ];
        $this->jadwalModel->insertDetailJadwalMenu($data);
        $data = [
          'id_jadwal_menu' => $maxIdJadwalMenu,
          'id_menu' => null,
          'created_at' => $date
        ];
        $this->jadwalModel->insertDetailJadwalMenu($data);
      }
    }
    // $maxIdJadwal = 72;
    $dataPelangganWithSisaJadwal = $this->pesananModel->getPelangganWithSisaJadwal()->getResultArray();
    $jadwalMenuBuka = $this->jadwalModel->getJadwalMenuBukaByIdJadwal($maxIdJadwal)->getResultArray();
    $tes = [];
    $tes1 = [];
    $tes2 = [];
    for ($i = 0; $i < count($dataPelangganWithSisaJadwal); $i++) {
      $idPesanan = $dataPelangganWithSisaJadwal[$i]['id_pesanan'];
      $idAkun = $dataPelangganWithSisaJadwal[$i]['id_akun'];
      for ($j = 0; $j < count($jadwalMenuBuka); $j++) {
        // insert data to table menu pesanan
        if ($j == $dataPelangganWithSisaJadwal[$i]['sisa_jadwal']) break;
        $data = [
          'id_pesanan' => $idPesanan,
          'id_jadwal_menu' => $jadwalMenuBuka[$j]['id_jadwal_menu'],
          'created_at' => $date
        ];
        array_push($tes, $data);
        $this->pesananModel->insertMenuPesanan($data);

        // insert table detail menu pesanan
        $idMenuPesanan = $this->pesananModel->getMaxIdMenuPesanan()->getRowArray()['id_menu_pesanan'];
        $detailJadwalMenu = $this->jadwalModel->getDetailJadwalMenu($jadwalMenuBuka[$j]['id_jadwal_menu'])->getResultArray();
        array_push($tes1, $detailJadwalMenu);
        $dataDetailCatatanPelanggan = $this->pesananModel->getCatatanPaketMenuBy($idAkun, $idPesanan)->getResultArray();
        foreach ($detailJadwalMenu as $detail) {
          foreach ($dataDetailCatatanPelanggan as $dataDetailCatatan) {

            $namaPaketMenu = ($detail['nama_paket_menu'] != NULL) ? $detail['nama_paket_menu'] : "infuse";

            if ($dataDetailCatatan['nama_paket_menu'] == $namaPaketMenu) {
              $data = [
                'id_detail_jadwal_menu' => $detail['id_detail_jadwal_menu'],
                // 'id_menu_pesanan' => 1,
                'id_menu_pesanan' => $idMenuPesanan,
                'id_karbo' => ($dataDetailCatatan['nama_paket_menu'] == "lunch") ? $dataPelangganWithSisaJadwal[$i]['id_karbo'] : NULL,
                'qty_menu' => ($dataDetailCatatan['nama_paket_menu'] != "infuse") ? 1 : NULL,
                'qty_infuse' => ($dataDetailCatatan['nama_paket_menu'] == "infuse") ? 1 : NULL,
                'pantangan_pesanan' => (!empty($dataPelangganWithSisaJadwal[$i]['pantangan_paketan'])) ? $dataPelangganWithSisaJadwal[$i]['pantangan_paketan'] : NULL,
                'created_at' => $date
              ];
              array_push($tes2, $data);
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
      }
    }

    // $dataPelangganPaketan = $this->pesananModel->getAllPelangganPaketan()->getResultArray();
    $result = array(
      'dataJadwal' => $dataJadwal,
      'dataMenuPesanan' => $tes,
      'dataDetailMenuPesanan' => $tes2,
      'dataPelangganWithSisaJadwal' => $dataPelangganWithSisaJadwal,
      'detailCatatanPelanggan' => $dataDetailCatatanPelanggan,
      // 'idMenuPesanan' => $idMenuPesanan,
      'jadwalMenuBuka' => $jadwalMenuBuka,
      'detailJadwalMenu' => $tes1,
    );
    echo json_encode($result);
  }

  public function editMenuPersonal($id = '')
  {
    $date = date("Y-m-d");
    $dataJadwalMenu = $this->jadwalModel->getJadwalMenuById($id)->getResultArray();
    $dataDetailJadwal = $this->jadwalModel->getDetailJadwalByIdByPack($id, 'personal')->getResultArray();
    $jadwalKadaluarsa = false;
    // dd($dataJadwalMenu);
    foreach ($dataJadwalMenu as $tanggal) {
      ($tanggal['tanggal_menu'] > $date) ? $jadwalKadaluarsa = true : $jadwalKadaluarsa = false;
    }
    $data = [
      'title' => 'Edit Jadwal Personal Personak',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'update',
      'idJadwal' => $id,
      'jadwalKadaluarsa' => $jadwalKadaluarsa,
      'dataJadwalMenu' => $dataJadwalMenu,
      'dataDetailJadwal' => $dataDetailJadwal
    ];
    // dd($data);
    return view('admin/jadwalMenuPersonal', $data);
  }

  public function updateJadwalPersonal()
  {
    $idJadwal = $this->request->getVar('idJadwal');
    $dataJadwal = $this->request->getVar('dataJadwal');
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $tanggalAwal = '';
    $tanggalAkhir = '';

    if (!empty($dataJadwal)) {
      for ($i = 0; $i < count($dataJadwal); $i++) {
        if ($dataJadwal[$i]['jadwal'] != "hapus") {
          $tanggalAwal = $dataJadwal[$i]['tanggal'];
          break;
        }
      }
      for ($i = count($dataJadwal) - 1; $i >= 0; $i--) {
        if (
          $dataJadwal[$i]['jadwal'] == "update" ||
          $dataJadwal[$i]['jadwal'] == "tambah" ||
          $dataJadwal[$i]['jadwal'] == "baca"
        ) {
          $tanggalAkhir = $dataJadwal[$i]['tanggal'];
          break;
        }
      }
      $dataTanggal = [
        'tanggal_mulai' => $tanggalAwal,
        'tanggal_akhir' => $tanggalAkhir,
        'updated_at' => $date
      ];
      $this->jadwalModel->updateJadwal($dataTanggal, $idJadwal);

      $tesHapus = [];
      $tesUpdate = [];
      $dataMenuAsli = [];
      $dataMenuBaru = [];
      foreach ($dataJadwal as $index => $jadwalMenu) {
        if ($jadwalMenu['cbLibur'] == 'false') {
          $data = [
            'status_libur' => 'B',
            'updated_at' => $date
          ];
          $where = $jadwalMenu['idJadwalMenu'];
          $this->jadwalModel->updateJadwalMenu($data, $where);

          if ($jadwalMenu['jadwal'] == 'hapus') {
            array_push($tesHapus, $jadwalMenu['idJadwalMenu']);
            $dataDeleteJadwalMenu = [
              'deleted_at' => $date
            ];
            $where = $jadwalMenu['idJadwalMenu'];
            $this->jadwalModel->updateJadwalMenu($dataDeleteJadwalMenu, $where);
          }

          if ($jadwalMenu['jadwal'] == 'update') {
            array_push($tesUpdate, $jadwalMenu['idJadwalMenu']);
            $dataDetailJadwalMenu = $this->jadwalModel->getDetailJadwalMenu($jadwalMenu['idJadwalMenu'])->getResultArray();
            foreach ($dataDetailJadwalMenu as $index => $data) {
              array_push($dataMenuAsli, $data['id_menu']);
              // Update Lunch & Dinner Menu jika ada perubahan
              if (isset($jadwalMenu['idMenuLunchBaru'])) {
                if ($jadwalMenu['idMenuLunch'] == $data['id_menu']) {
                  $dataMenuLunch = [
                    'id_menu' => $jadwalMenu['idMenuLunchBaru'],
                    'updated_at' => $date
                  ];
                  $where = [
                    'id_menu' => $jadwalMenu['idMenuLunch'],
                    'id_detail_jadwal_menu' => $data['id_detail_jadwal_menu'],
                  ];
                  $this->jadwalModel->updateDetailJadwalMenu($dataMenuLunch, $where);
                }
              }
              if (isset($jadwalMenu['idMenuDinnerBaru'])) {
                if ($jadwalMenu['idMenuDinner'] == $data['id_menu']) {
                  $dataMenuDinner = [
                    'id_menu' => $jadwalMenu['idMenuDinnerBaru'],
                    'updated_at' => $date
                  ];
                  $where = [
                    'id_menu' => $jadwalMenu['idMenuDinner'],
                    'id_detail_jadwal_menu' => $data['id_detail_jadwal_menu'],
                  ];
                  $this->jadwalModel->updateDetailJadwalMenu($dataMenuDinner, $where);
                }
              }
            }
          }

          if ($jadwalMenu['jadwal'] == 'tambah') {
            // insert data to table jadwal menu
            $dataTambahHari = [
              'id_jadwal' => $idJadwal,
              'tanggal_menu' => $jadwalMenu['tanggal'],
              'status_libur' => ($jadwalMenu['cbLibur'] == 'true') ? "L" : "B",
              'infuse' => 'Y',
              'created_at' => $date
            ];
            $this->jadwalModel->insertJadwalMenu($dataTambahHari);

            // insert data to detail jadwal menu
            $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
            if ($jadwalMenu['cbLibur'] == 'false') {
              if ($jadwalMenu['cbLibur'] == 'false') {
                $data = [
                  'id_jadwal_menu' => $maxIdJadwalMenu,
                  'id_menu' => $jadwalMenu['idMenuLunchBaru'],
                  'created_at' => $date
                ];
                $this->jadwalModel->insertDetailJadwalMenu($data);
                $data = [
                  'id_jadwal_menu' => $maxIdJadwalMenu,
                  'id_menu' => $jadwalMenu['idMenuDinnerBaru'],
                  'created_at' => $date
                ];
                $this->jadwalModel->insertDetailJadwalMenu($data);
                $data = [
                  'id_jadwal_menu' => $maxIdJadwalMenu,
                  'id_menu' => null,
                  'created_at' => $date
                ];
                $this->jadwalModel->insertDetailJadwalMenu($data);
              }
            }
          }
        } else {
          $data = [
            'status_libur' => 'L',
            'updated_at' => $date
          ];
          $where = $jadwalMenu['idJadwalMenu'];
          $this->jadwalModel->updateJadwalMenu($data, $where);
        }
      }
    }
    $result = array(
      // 'dataTambahHari' => $dataTambahHari,
      'idJadwal' => $idJadwal,
      'dataJadwal' => $dataJadwal,
      'dataTanggal' => $dataTanggal,
      // 'tanggalAwal' => $tanggalAwal,
      // 'tanggalAkhir' => $tanggalAkhir,
      'tesHapus' => $tesHapus,
      'tesUpdate' => $tesUpdate,
      'dataMenuAsli' => $dataMenuAsli,
      // 'dataMenuBaru' => $dataMenuBaru,
      // 'dataMenuTambah' => (empty($menuTambah)) ? 'kosong' : $menuTambah,
      // 'dataMenuHapus' => (empty($menuHapus)) ? 'kosong' : $menuHapus,
    );
    echo json_encode($result);
  }
}
