<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Controllers\Admin\Pack;
use App\Models\JadwalModel;

class Jadwal extends BaseController
{
  protected $packController;
  protected $jadwalModel;

  public function __construct()
  {
    $this->packController = new Pack();
    $this->jadwalModel = new JadwalModel();
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
    $htmlContent = view('admin/datatable/datatableJadwalMenu', ['dataJadwalMenu' => $dataJadwalMenu, 'dataPack' => $pack]);

    $result = array(
      'dataJadwal' => $htmlContent
    );
    echo json_encode($result);
  }

  public function createMenuFamily()
  {
    $data = [
      'title' => 'Buat Jadwal Family Pack',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'save'
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function createMenuPersonal()
  {
    $data = [
      'title' => 'Buat Jadwal Personal Pack',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'save'
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

    // insert data to table jadwal
    $data = [
      'tanggal_mulai' => $dataJadwal[0]['tanggal'],
      'tanggal_akhir' => $dataJadwal[count($dataJadwal) - 1]['tanggal']
    ];
    $this->jadwalModel->insertJadwal($data);

    // insert data to table jadwal menu
    $maxIdJadwal = $this->jadwalModel->getMaxIdJadwal()->getRowArray()['id_jadwal'];
    for ($i = 0; $i < count($dataJadwal); $i++) {
      $data = [
        'id_jadwal' => $maxIdJadwal,
        'tanggal_menu' => $dataJadwal[$i]['tanggal'],
        'status_libur' => ($dataJadwal[$i]['cbLibur'] == 'true') ? "L" : "B"
      ];
      $this->jadwalModel->insertJadwalMenu($data);

      // insert data to detail jadwal menu
      $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
      if ($dataJadwal[$i]['cbLibur'] == 'false') {
        for ($j = 0; $j < count($dataJadwal[$i]['itemsMenu']); $j++) {
          $data = [
            'id_jadwal_menu' => $maxIdJadwalMenu,
            'id_menu' => $dataJadwal[$i]['itemsMenu'][$j]
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
    $dataJadwalMenu = $this->jadwalModel->getJadwalMenuById($id)->getResultArray();
    $dataDetailJadwal = $this->jadwalModel->getDetailJadwalByIdByPack($id, 'family')->getResultArray();
    $data = [
      'title' => 'Edit Jadwal Personal Family',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'update',
      'idJadwal' => $id,
      'dataJadwalMenu' => $dataJadwalMenu,
      'dataDetailJadwal' => $dataDetailJadwal
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function updateJadwalFamily()
  {
    $idJadwal = $this->request->getVar('idJadwal');
    $dataJadwal = $this->request->getVar('dataJadwal');

    // update data to table jadwal
    $data = [
      'tanggal_mulai' => $dataJadwal[0]['tanggal'],
      'tanggal_akhir' => $dataJadwal[count($dataJadwal) - 1]['tanggal']
    ];
    $this->jadwalModel->updateJadwal($data, $idJadwal);

    // update data to table jadwal menu
    $maxIdJadwal = $this->jadwalModel->getMaxIdJadwal()->getRowArray()['id_jadwal'];
    for ($i = 0; $i < count($dataJadwal); $i++) {
      $data = [
        'id_jadwal' => $maxIdJadwal,
        'tanggal_menu' => $dataJadwal[$i]['tanggal'],
        'status_libur' => ($dataJadwal[$i]['cbLibur'] == 'true') ? "L" : "B"
      ];
      $this->jadwalModel->insertJadwalMenu($data);

      // update data to detail jadwal menu
      $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
      if ($dataJadwal[$i]['cbLibur'] == 'false') {
        for ($j = 0; $j < count($dataJadwal[$i]['itemsMenu']); $j++) {
          $data = [
            'id_jadwal_menu' => $maxIdJadwalMenu,
            'id_menu' => $dataJadwal[$i]['itemsMenu'][$j]
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

  public function saveJadwalPersonal()
  {
    $dataJadwal = $this->request->getVar('dataJadwal');

    // insert data to table jadwal
    $data = [
      'tanggal_mulai' => $dataJadwal[0]['tanggal'],
      'tanggal_akhir' => $dataJadwal[count($dataJadwal) - 1]['tanggal']
    ];
    $this->jadwalModel->insertJadwal($data);

    // insert data to table jadwal menu
    $maxIdJadwal = $this->jadwalModel->getMaxIdJadwal()->getRowArray()['id_jadwal'];
    for ($i = 0; $i < count($dataJadwal); $i++) {
      $data = [
        'id_jadwal' => $maxIdJadwal,
        'tanggal_menu' => $dataJadwal[$i]['tanggal'],
        'status_libur' => ($dataJadwal[$i]['cbLibur'] == 'true') ? "L" : "B"
      ];
      $this->jadwalModel->insertJadwalMenu($data);

      // insert data to detail jadwal menu
      $maxIdJadwalMenu = $this->jadwalModel->getMaxIdJadwalMenu()->getRowArray()['id_jadwal_menu'];
      if ($dataJadwal[$i]['cbLibur'] == 'false') {
        $data = [
          'id_jadwal_menu' => $maxIdJadwalMenu,
          'id_menu' => $dataJadwal[$i]['idMenuLunch']
        ];
        $this->jadwalModel->insertDetailJadwalMenu($data);
        $data = [
          'id_jadwal_menu' => $maxIdJadwalMenu,
          'id_menu' => $dataJadwal[$i]['idMenuDinner']
        ];
        $this->jadwalModel->insertDetailJadwalMenu($data);
      }
    }
    $result = array(
      'data' => $dataJadwal
    );
    echo json_encode($result);
  }

  public function editMenuPersonal($id = '')
  {
    $dataJadwalMenu = $this->jadwalModel->getJadwalMenuById($id)->getResultArray();
    $dataDetailJadwal = $this->jadwalModel->getDetailJadwalByIdByPack($id, 'personal')->getResultArray();
    $data = [
      'title' => 'Edit Jadwal Personal Personak',
      'sidebar' => 'kelolaJadwalMenu',
      'case' => 'update',
      'idJadwal' => $id,
      'dataJadwalMenu' => $dataJadwalMenu,
      'dataDetailJadwal' => $dataDetailJadwal
    ];
    // dd($data);
    return view('admin/jadwalMenuPersonal', $data);
  }
}
