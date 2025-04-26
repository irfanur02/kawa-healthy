<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\Admin\PaketMenu;
use App\Controllers\Admin\Pack;
use App\Models\MenuModel;
use App\Models\PackModel;
use App\Models\PaketMenuModel;

class Menu extends BaseController
{

  protected $menuModel;
  protected $paketMenuModel;
  protected $packModel;
  protected $paketMenuController;

  public function __construct()
  {
    $this->menuModel = new MenuModel();
    $this->paketMenuModel = new PaketMenuModel();
    $this->packModel = new PackModel();
    $this->paketMenuController = new PaketMenu();
  }

  public function index()
  {
    $jumlahDataPerhalaman = 7;
    $dataSemuaMenu = $this->menuModel->getAllMenu()->getResultArray();
    $halamanAktif = 1;
    $jumlahHalaman = ceil(count($dataSemuaMenu) / $jumlahDataPerhalaman);
    $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
    $dataMenu = $this->menuModel->getAllMenuLimit($jumlahDataPerhalaman, $awalData)->getResultArray();

    $data = [
      'title' => 'Kelola Menu',
      'sidebar' => 'kelolaMenu',
      'dataMenu' => $dataMenu,
      'jumlahHalaman' => $jumlahHalaman,
      'halamanAktif' => $halamanAktif,
      'no' => $halamanAktif
    ];
    return view('admin/menu', $data);
  }

  public function pageMenu($halaman = '')
  {
    $jumlahDataPerhalaman = 7;
    $dataSemuaMenu = $this->menuModel->getAllMenu()->getResultArray();
    $halamanAktif = $halaman;
    $jumlahHalaman = ceil(count($dataSemuaMenu) / $jumlahDataPerhalaman);
    // Hitung nomor awal untuk halaman aktif
    $no = ($halamanAktif - 1) * $jumlahDataPerhalaman + 1;
    $awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
    $dataMenu = $this->menuModel->getAllMenuLimit($jumlahDataPerhalaman, $awalData)->getResultArray();

    $htmlContent = view('admin/datatable/dataTableMenu', ['dataMenu' => $dataMenu, 'halamanAktif' => $halamanAktif, 'jumlahHalaman' => $jumlahHalaman, 'no' => $no]);

    $result = array(
      'element' => $htmlContent
    );
    echo json_encode($result);
  }

  public function createMenu()
  {
    $dataPaketMenu = $this->paketMenuController->getAllPaketMenu();

    $builder = $this->db->table('karbo');
    $query = $builder->get();
    $dataKarbo = $query->getResultArray();

    $dataPack = $this->packModel->getAllPack()->getResultArray();

    $data = [
      'title' => 'Form Tambah Menu',
      'sidebar' => 'kelolaMenu',
      'dataPaketMenu' => $dataPaketMenu,
      'dataKarbo' => $dataKarbo,
      'dataPack' => $dataPack
    ];
    return view('admin/menuCreate', $data);
  }

  public function editMenu($id = '')
  {
    $dataPaketMenu = $this->paketMenuController->getAllPaketMenu();

    $builder = $this->db->table('karbo');
    $query = $builder->get();
    $dataKarbo = $query->getResultArray();

    $dataPack = $this->packModel->getAllPack()->getResultArray();

    $dataMenuId = $this->menuModel->getMenuById($id)->getResultArray()[0];

    $data = [
      'title' => 'Form Edit Menu',
      'sidebar' => 'kelolaMenu',
      'dataMenuId' => $dataMenuId,
      'dataPaketMenu' => $dataPaketMenu,
      'dataKarbo' => $dataKarbo,
      'dataPack' => $dataPack
    ];
    return view('admin/menuEdit', $data);
  }

  public function save()
  {
    $idJenisPack = $this->request->getVar('jenisPack');
    $namaMenu = $this->request->getVar('namaMenu');
    $hargaMenu = $this->request->getVar('hargaMenu');
    $paketMenu = $this->request->getVar('paketMenu');
    // Tangkap file
    $fileGambar = $this->request->getFile('fileGambar');
    $namaGambar = $fileGambar->getRandomName();
    $fileGambar->move('assets/img/menu', $namaGambar);

    $jenisPack = $this->packModel->getPackById($idJenisPack)->getResultArray()[0];
    $date = date("Y-m-d") . ' ' . date("H:i:s");

    if ($jenisPack['nama_pack'] == "family") {
      $data = [
        'nama_menu' => $namaMenu,
        'gambar_menu' => $namaGambar,
        'id_pack' => $idJenisPack,
        'harga_menu' => $hargaMenu,
        'created_at' => $date
      ];
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $data = [
        'nama_menu' => $namaMenu,
        'gambar_menu' => $namaGambar,
        'id_pack' => $idJenisPack,
        'id_paket_menu' => $paketMenu,
        // 'id_karbo' => $this->request->getVar('jenisKarbo'),
        'created_at' => $date
      ];
    }

    $this->menuModel->insertMenu($data);

    $result = array(
      'namaMenu' => $namaMenu,
      'idJenisPack' => $idJenisPack,
      'hargaMenu' => $hargaMenu,
      'paketMenu' => $paketMenu,
      'namaGambar' => $namaGambar
    );
    echo json_encode($result);

    // return redirect()->to('/dadmin/menu');
  }

  public function update()
  {
    $idMenu = $this->request->getVar('idMenu');
    $gambarLama = $this->request->getVar('gambarLama');
    $idJenisPack = $this->request->getVar('jenisPack');
    $jenisPack = $this->packModel->getPackById($idJenisPack)->getResultArray()[0];
    $namaMenu = $this->request->getVar('namaMenu');
    $hargaMenu = $this->request->getVar('hargaMenu');
    $paketMenu = $this->request->getVar('paketMenu');
    // Tangkap file
    $fileGambar = $this->request->getFile('fileGambar');
    if ($fileGambar == null) {
      $namaGambar = $gambarLama;
    } else {
      $namaGambar = $fileGambar->getRandomName();
      $fileGambar->move('assets/img/menu', $namaGambar);
    }
    $date = date("Y-m-d") . ' ' . date("H:i:s");

    if ($jenisPack['nama_pack'] == "family") {
      $data = [
        'nama_menu' => $namaMenu,
        'id_pack' => $idJenisPack,
        'gambar_menu' => $namaGambar,
        'id_paket_menu' => null,
        'harga_menu' => $hargaMenu,
        'updated_at' => $date
      ];
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $data = [
        'nama_menu' => $namaMenu,
        'id_pack' => $idJenisPack,
        'gambar_menu' => $namaGambar,
        'id_paket_menu' => $paketMenu,
        'harga_menu' => null,
        // 'id_karbo' => $this->request->getVar('jenisKarbo'),
        'updated_at' => $date
      ];
    }
    $this->menuModel->updateMenu($data, $idMenu);

    $result = array(
      'namaMenu' => $namaMenu,
      'idJenisPack' => $idJenisPack,
      'hargaMenu' => $hargaMenu,
      'paketMenu' => $paketMenu,
      'namaGambar' => $namaGambar,
      // 'fileGambar' => $fileGambar
    );
    echo json_encode($result);

    // return redirect()->to('/dadmin/menu');
  }

  public function delete($id = '')
  {
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $data = [
      'deleted_at' => $date
    ];
    $this->menuModel->deleteMenu($data, $id);
    session()->setFlashdata('notif', 'deleteMenu');
    $result = array(
      'status' => 200,
    );
    echo json_encode($result);
  }

  public function cari()
  {
    $keyword = $this->request->getVar('keyword');

    if ($keyword == '') {
      $dataPencarian = $this->menuModel->getAllMenu()->getResult();
    }

    if ($keyword !== '') {
      $dataPencarian = $this->menuModel->getAllMenuByNama($keyword)->getResult();
    }
    $result = array(
      'dataPencarian' => $dataPencarian
    );
    echo json_encode($result);
  }

  public function getDetailPencarian()
  {
    $keyword = $this->request->getVar('keyword');
    $dataPencarian = $this->menuModel->getMenuByNama($keyword)->getResult();
    $result = array(
      'dataPencarian' => $dataPencarian[0]
    );
    echo json_encode($result);
  }
}
