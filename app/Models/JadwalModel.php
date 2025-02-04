<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
  protected $table            = 'jadwal';
  protected $primaryKey       = 'id_jadwal';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['tanggal_mulai', 'tanggal_akhir'];
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  // tabel jadwal
  public function insertJadwal($data = '')
  {
    $builder = $this->db->table('jadwal');
    $builder->insert($data);
  }

  public function updateJadwal($data = '', $idJadwal = '')
  {
    $builder = $this->db->table('jadwal');
    $builder->set($data);
    $builder->where('id_jadwal', $idJadwal);
    $builder->update();
  }

  public function getMaxIdJadwal()
  {
    $builder = $this->db->table('jadwal');
    $builder->selectMax('id_jadwal');
    $query = $builder->get();
    return $query;
  }

  public function getMaxTanggalAkhir($pack)
  {
    $builder = $this->db->table('jadwal j');
    $builder->selectMax('j.tanggal_akhir');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal = j.id_jadwal');
    $builder->where('jm.infuse', ($pack == "family") ? NULL : 'y');
    $query = $builder->get();
    return $query;
  }

  public function getAllJadwalMenu()
  {
    $builder = $this->db->table('jadwal');
    $builder->select('id_jadwal, tanggal_mulai, tanggal_akhir');
    $query = $builder->get();
    return $query;
  }

  public function getAllJadwalMenuByPack($pack = '')
  {
    $builder = $this->db->table('jadwal');
    $builder->select('jadwal.id_jadwal, jadwal.tanggal_mulai, jadwal.tanggal_akhir')
      ->join('jadwal_menu', 'jadwal_menu.id_jadwal = jadwal.id_jadwal')
      ->join('detail_jadwal_menu', 'detail_jadwal_menu.id_jadwal_menu = jadwal_menu.id_jadwal_menu')
      ->join('menu', 'menu.id_menu = detail_jadwal_menu.id_menu')
      ->join('pack', 'pack.id_pack = menu.id_pack')
      ->where('pack.nama_pack', $pack)
      ->groupBy('jadwal.id_jadwal')
      ->orderBy('jadwal.id_jadwal', 'DESC');
    $query = $builder->get();
    return $query;
  }

  public function getJadwalMenuById($id = '')
  {
    // $builder = $this->db->table('jadwal_menu as jm');
    // $builder->select('
    //               jm.id_jadwal_menu, jm.tanggal_menu, jm.status_libur, dmp.id_menu_pesanan, dmp.batal
    //               ');
    // $builder->join('detail_jadwal_menu as djm', 'jm.id_jadwal_menu = djm.id_jadwal_menu');
    // $builder->join('detail_menu_pesanan as dmp', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    // $builder->where('jm.id_jadwal', $id);
    // $builder->groupBy('jm.tanggal_menu');
    $builder = $this->db->table('jadwal_menu as jm');
    $builder->select("
              jm.id_jadwal_menu,
              jm.tanggal_menu,
              dmp.batal,
              dmp.id_menu_pesanan,
              jm.status_libur,
              CASE 
                  WHEN SUM(CASE WHEN dmp.batal = 'b' THEN 1 ELSE 0 END) > 0 THEN 'b'
                  ELSE NULL
              END AS batal,
              CASE 
                  WHEN SUM(CASE WHEN sdmp.id_status_pesanan = 9 THEN 1 ELSE 0 END) > 0 THEN 'y'
                  ELSE NULL
              END AS berhenti_paketan
          ");
    $builder->join('detail_jadwal_menu as djm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan as dmp', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->where('jm.id_jadwal', $id);
    $builder->groupBy('jm.tanggal_menu');
    $query = $builder->get();
    return $query;
  }

  public function getTanggalMenuBy($idJadwalMenu)
  {
    $builder = $this->db->table('jadwal_menu');
    $builder->select('tanggal_menu')
      ->where('id_jadwal_menu', $idJadwalMenu);
    $query = $builder->get();
    return $query;
  }

  public function getDetailJadwalByIdByPack($id = '', $pack = '')
  {
    $builder = $this->db->table('jadwal_menu as jm');
    $builder->select('jm.tanggal_menu, djm.id_menu, m.nama_menu, pm.nama_paket_menu')
      ->join('detail_jadwal_menu as djm', 'djm.id_jadwal_menu = jm.id_jadwal_menu', 'left')
      ->join('menu as m', 'm.id_menu = djm.id_menu', 'left')
      ->join('pack as p', 'p.id_pack = m.id_pack', 'left')
      ->join('paket_menu as pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->where('jm.id_jadwal', $id)
      ->groupStart() // Mulai grup kondisi OR
      ->where('p.nama_pack', $pack)
      ->orWhereIn('jm.status_libur', ['L', 'B'])
      ->groupEnd(); // Akhiri grup kondisi OR
    $query = $builder->get();
    return $query;
  }
  // tabel jadwal


  // tabel jadwal menu
  public function insertJadwalMenu($data)
  {
    $builder = $this->db->table('jadwal_menu');
    $builder->insert($data);
  }

  public function getMaxIdJadwalMenu()
  {
    $builder = $this->db->table('jadwal_menu');
    $builder->selectMax('id_jadwal_menu');
    $query = $builder->get();
    return $query;
  }
  // tabel jadwal menu


  // tabel detail jadwal menu
  public function insertDetailJadwalMenu($data)
  {
    $builder = $this->db->table('detail_jadwal_menu');
    $builder->insert($data);
  }
  // tabel detail jadwal menu

  // tabel jadwal menu
  public function getJadwalByTanggal($date = '', $pack = '')
  {
    $builder = $this->db->table('detail_jadwal_menu as djm');
    $builder->select('*');
    $builder->join('menu as m', 'm.id_menu = djm.id_menu');
    $builder->join('pack as p', 'p.id_pack = m.id_pack');
    $builder->join('jadwal_menu as jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu');
    $subQuery = $this->db->table('jadwal_menu');
    $subQuery->select('id_jadwal');
    $subQuery->where('tanggal_menu', $date);
    $builder->where('jm.id_jadwal IN(' . $subQuery->getCompiledSelect() . ')', null, false);
    $builder->where('p.nama_pack', $pack);
    $builder->where('djm.deleted_at', null);
    $builder->groupBy('jm.tanggal_menu');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }
  // tabel jadwal menu

  public function getInfuseJadwalPersonalByTanggal($date)
  {
    $builder = $this->db->table('detail_jadwal_menu as djm');
    $builder->select('*');
    $builder->join('jadwal_menu as jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu');
    $subQuery = $this->db->table('jadwal_menu');
    $subQuery->select('id_jadwal');
    $subQuery->where('tanggal_menu', $date);
    $builder->where('jm.id_jadwal IN(' . $subQuery->getCompiledSelect() . ')', null, false);
    $builder->where('djm.id_menu', null);
    $builder->where('djm.deleted_at', null);
    $builder->groupBy('jm.tanggal_menu');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  // tabel jadwal menu
  public function getDetailJadwalByTanggal($date = '', $pack = '')
  {
    $builder = $this->db->table('detail_jadwal_menu as djm');
    $builder->select('*');
    $builder->join('jadwal_menu as jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu as m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('pack as p', 'p.id_pack = m.id_pack', 'left');
    $builder->join('paket_menu as pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $subQuery = $this->db->table('jadwal_menu');
    $subQuery->select('id_jadwal');
    $subQuery->where('tanggal_menu', $date);
    $builder->where('jm.id_jadwal IN(' . $subQuery->getCompiledSelect() . ')', null, false);
    $builder->where('p.nama_pack', $pack);
    $builder->where('djm.deleted_at', null);
    $builder->orderBy("jm.tanggal_menu", "ASC");
    $builder->orderBy("pm.id_paket_menu", "ASC");
    $query = $builder->get();
    return $query;
  }
  // tabel jadwal menu

  public function findJadwal($date)
  {
    $builder = $this->db->table('jadwal');
    $builder->select('tanggal_mulai');
    $builder->where('tanggal_mulai >= ', $date);
    $builder->groupBy('tanggal_mulai');
    $builder->orderBy('tanggal_mulai', 'ASC');
    $builder->limit(1);
    $query = $builder->get();
    return $query;
  }

  public function getJadwalMenuBukaByIdJadwal($idJadwal)
  {
    $builder = $this->db->table('jadwal_menu');
    $builder->select('id_jadwal_menu, status_libur');
    $builder->where('id_jadwal', $idJadwal);
    $builder->where('status_libur', 'b');
    $query = $builder->get();
    return $query;
  }

  public function getDetailJadwalMenu($idJadwalMenu)
  {
    $builder = $this->db->table('detail_jadwal_menu djm');
    $builder->select('djm.id_detail_jadwal_menu, djm.id_jadwal_menu, pm.id_paket_menu, pm.nama_paket_menu');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('djm.id_jadwal_menu', $idJadwalMenu);
    $query = $builder->get();
    return $query;
  }
}
