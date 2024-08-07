<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BiayaOngkirModel;

class BiayaOngkir extends BaseController
{

  protected $biayaOngkirModel;

  public function __construct() {
    $this->biayaOngkirModel = new BiayaOngkirModel();
  }

  public function index()
  {
    $dataOngkir = $this->biayaOngkirModel->findAll();

    $data = [
      'title' => 'Kelola Biaya Ongkir',
      'sidebar' => 'kelolaBiayaOngkir',
      'dataOngkir' => $dataOngkir
    ];

    return view('admin/biayaOngkir', $data);
  }

  public function save()
  {
    $this->biayaOngkirModel->save([
      'ongkir_kota' => ucfirst($this->request->getVar('namaKota')),
      'biaya_ongkir' => $this->request->getVar('biayaOngkir')
    ]);
    
    session()->setFlashdata('notif', 'tambahKota');

    return redirect()->to('/dadmin/biayaOngkir');
  }

  public function update($id = '')
  {
    $this->biayaOngkirModel->save([
      'id_ongkir' => $id,
      'ongkir_kota' => ucfirst($this->request->getVar('namaKota')),
      'biaya_ongkir' => $this->request->getVar('biayaOngkir')
    ]);
    
    session()->setFlashdata('notif', 'updateKota');

    return redirect()->to('/dadmin/biayaOngkir');
  }

  public function delete($id = '')
  {
    $this->biayaOngkirModel->delete($id);
    
    session()->setFlashdata('notif', 'deleteKota');

    return redirect()->to('/dadmin/biayaOngkir');
  }

  public function cari()
  {
    $builder = $this->db->table('ongkir');

    $keyword = $this->request->getVar('keyword');

    if ($keyword == '') {
      $dataPencarian = $this->biayaOngkirModel->findAll();
    }

    if ($keyword !== '') {
      $pencarian = $builder->like('ongkir_kota', $keyword)->where('deleted_at', NULL);
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
    $detailData = $this->biayaOngkirModel->where('ongkir_kota', $dataPencarian)->find();
    $result = array(
      'detailData' => $detailData[0]
    );
    echo json_encode($result);
  }
}
