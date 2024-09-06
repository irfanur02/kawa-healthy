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
    $dataMenu = $this->menuModel->getAllMenu()->getResultArray();

    $data = [
      'title' => 'Kelola Menu',
      'sidebar' => 'kelolaMenu',
      'dataMenu' => $dataMenu
    ];
    return view('admin/menu', $data);
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
    $jenisPack = $this->packModel->getPackById($idJenisPack)->getResultArray()[0];
    $date = date("Y-m-d") . ' ' . date("H:i:s");

    if ($jenisPack['nama_pack'] == "family") {
      $data = [
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'harga_menu' => $this->request->getVar('hargaMenu'),
        'created_at' => $date
      ];
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $data = [
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'id_paket_menu' => $this->request->getVar('paketMenu'),
        // 'id_karbo' => $this->request->getVar('jenisKarbo'),
        'created_at' => $date
      ];
    }
    $this->menuModel->insertMenu($data);

    return redirect()->to('/dadmin/menu');
  }

  public function update($id = '')
  {
    $idJenisPack = $this->request->getVar('jenisPack');
    $jenisPack = $this->packModel->getPackById($idJenisPack)->getResultArray()[0];
    $date = date("Y-m-d") . ' ' . date("H:i:s");

    if ($jenisPack['nama_pack'] == "family") {
      $data = [
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'id_paket_menu' => null,
        'harga_menu' => $this->request->getVar('hargaMenu'),
        'updated_at' => $date
      ];
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $data = [
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'id_paket_menu' => $this->request->getVar('paketMenu'),
        'harga_menu' => null,
        // 'id_karbo' => $this->request->getVar('jenisKarbo'),
        'updated_at' => $date
      ];
    }
    $this->menuModel->updateMenu($data, $id);

    return redirect()->to('/dadmin/menu');
  }

  public function delete($id = '')
  {
    $date = date("Y-m-d") . ' ' . date("H:i:s");
    $data = [
      'deleted_at' => $date
    ];
    $this->menuModel->deleteMenu($data, $id);
    session()->setFlashdata('notif', 'deleteMenu');
    return redirect()->to('/dadmin/menu');
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

  public function getDetailPencarian($dataPencarian = '')
  {
    $dataPencarian = $this->menuModel->getMenuByNama($dataPencarian)->getResult();
    $result = array(
      'dataPencarian' => $dataPencarian[0]
    );
    echo json_encode($result);
  }
}
