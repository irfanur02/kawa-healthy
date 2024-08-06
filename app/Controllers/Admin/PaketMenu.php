<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PaketMenuModel;

class PaketMenu extends BaseController
{

  protected $paketMenuModel;

  public function __construct() {
    $this->paketMenuModel = new paketMenuModel();
  }

  public function index()
  {
    $dataPaketMenu = $this->paketMenuModel->findAll();

    $data = [
      'title' => 'Kelola Paket Menu',
      'sidebar' => 'kelolaPaketMenu',
      'dataPaketMenu' => $dataPaketMenu
    ];

    return view('admin/paketMenu', $data);
  }

  public function save()
  {
    $this->paketMenuModel->save([
      'nama_paket_menu' => ucfirst($this->request->getVar('namaPaketMenu')),
      'harga_paket_menu' => ucfirst($this->request->getVar('hargaPaketMenu'))
    ]);
    
    session()->setFlashdata('notif', 'tambahPaketMenu');

    return redirect()->to('/dadmin/paketMenu');
  }

  public function update($id = '')
  {
    $this->paketMenuModel->save([
      'id_paket_menu' => $id,
      'nama_paket_menu' => ucfirst($this->request->getVar('namaPaketMenu')),
      'harga_paket_menu' => ucfirst($this->request->getVar('hargaPaketMenu'))
    ]);
    
    session()->setFlashdata('notif', 'updatePaketMenu');

    return redirect()->to('/dadmin/paketMenu');
  }

  public function delete($id = '')
  {
    $this->paketMenuModel->delete($id);
    
    session()->setFlashdata('notif', 'deletePaketMenu');

    return redirect()->to('/dadmin/paketMenu');
  }

  public function cari()
  {
    $db      = \Config\Database::connect();
    $builder = $db->table('paket_menu');

    $keyword = $this->request->getVar('keyword');

    if ($keyword == '') {
      $dataPencarian = $this->paketMenuModel->findAll();
    }

    if ($keyword !== '') {
      $pencarian = $builder->like('nama_paket_menu', $keyword)->where('deleted_at', NULL);
      $query = $pencarian->get();

      $dataPencarian = $query->getResult();
    }
    $result = array(
      'dataPencarian' => $dataPencarian
    );
    echo json_encode($result);
  }

  public function getDetailPencarian($dataPencarian = '')
  {
    $detailData = $this->paketMenuModel->where('nama_paket_menu', $dataPencarian)->find();
    $result = array(
      'detailData' => $detailData[0]
    );
    echo json_encode($result);
  }
}
