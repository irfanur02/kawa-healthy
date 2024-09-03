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
    $builder = $this->db->table('jadwal_menu');
    $builder->select('id_jadwal_menu, tanggal_menu, status_libur')
      ->where('id_jadwal', $id)
      ->groupBy('tanggal_menu');
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
}
