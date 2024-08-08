<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\Admin\PaketMenu;
use App\Controllers\Admin\Pack;
use App\Models\MenuModel;
use App\Models\PaketMenuModel;

class Menu extends BaseController
{

  protected $menuModel;
  protected $paketMenuModel;
  protected $paketMenuController;
  protected $packController;

  public function __construct() {
    $this->menuModel = new MenuModel();
    $this->paketMenuModel = new PaketMenuModel();
    $this->paketMenuController = new PaketMenu();
    $this->packController = new Pack();
  }

  public function index()
  {
    $builder = $this->db->table('menu');
    $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
    $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
    $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
    $builder->where('menu.deleted_at', null);
    $query = $builder->get();
    $dataMenu = $query->getResultArray();

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

    $builder = $this->db->table('pack');
    $query = $builder->get();
    $dataPack = $query->getResultArray();

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

    $builder = $this->db->table('pack');
    $query = $builder->get();
    $dataPack = $query->getResultArray();

    $dataMenuId = $this->menuModel->find($id);

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
    $jenisPack = $this->packController->getPackById($idJenisPack);

    if ($jenisPack['nama_pack'] == "family") {
      $this->menuModel->save([
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'harga_menu' => $this->request->getVar('hargaMenu')
      ]);
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $this->menuModel->save([
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'id_paket_menu' => $this->request->getVar('paketMenu'),
        'id_karbo' => $this->request->getVar('jenisKarbo')
      ]);
    }

    return redirect()->to('/dadmin/menu');
  }

  public function update($id = '')
  {
    $idJenisPack = $this->request->getVar('jenisPack');
    $jenisPack = $this->packController->getPackById($idJenisPack);

    if ($jenisPack['nama_pack'] == "family") {
      $this->menuModel->save([
        'id_menu' => $id,
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'harga_menu' => $this->request->getVar('hargaMenu')
      ]);
    }

    if ($jenisPack['nama_pack'] == "personal") {
      $this->menuModel->save([
        'id_menu' => $id,
        'nama_menu' => $this->request->getVar('namaMenu'),
        'id_pack' => $this->request->getVar('jenisPack'),
        'id_paket_menu' => $this->request->getVar('paketMenu'),
        'id_karbo' => $this->request->getVar('jenisKarbo')
      ]);
    }

    return redirect()->to('/dadmin/menu');
  }

  public function delete($id = '')
  {
    $this->menuModel->delete($id);
    session()->setFlashdata('notif', 'deleteMenu');
    return redirect()->to('/dadmin/menu');
  }

  public function cari()
  {
    $keyword = $this->request->getVar('keyword');

    if ($keyword == '') {
      $builder = $this->db->table('menu');
      $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
      $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
      $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
      $builder->where('menu.deleted_at', null);
      $query = $builder->get();
      $dataPencarian = $query->getResult();
    }

    if ($keyword !== '') {
      $builder = $this->db->table('menu');
      $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
      $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
      $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
      $builder->like('menu.nama_menu', $keyword);
      $builder->where('menu.deleted_at', null);
      $query = $builder->get();
      $dataPencarian = $query->getResult();
    }
    $result = array(
      'dataPencarian' => $dataPencarian
    );
    echo json_encode($result);
  }

  public function getDetailPencarian($dataPencarian = '')
  {
    $builder = $this->db->table('menu');
    $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
    $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
    $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
    $builder->where('menu.nama_menu', $dataPencarian);
    $builder->where('menu.deleted_at', null);
    $query = $builder->get();
    $dataPencarian = $query->getResult();
    $result = array(
      'dataPencarian' => $dataPencarian[0]
    );
    echo json_encode($result);
  }

}
