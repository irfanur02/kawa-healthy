<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
  protected $table            = 'review';
  protected $primaryKey       = 'id_review';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_pesanan', 'review'];
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

  public function insertReviewPesanan($data)
  {
    $builder = $this->db->table('review');
    $builder->insert($data);
  }

  public function getReview($idAkun, $idJadwalMenu)
  {
    $builder = $this->db->table('review');
    $builder->select('review.keterangan_review');
    $builder->join('menu_pesanan', 'menu_pesanan.id_menu_pesanan = review.id_menu_pesanan');
    // $builder->where('pesanan.id_akun', $idAkun);
    $builder->where('review.id_menu_pesanan', $idJadwalMenu);
    $query = $builder->get();
    return $query;
  }

  public function getDataPelangganReview()
  {
    $builder = $this->db->table('review r')
      ->select('p.id_pesanan, mp.id_menu_pesanan, jm.id_jadwal_menu, pel.nama_pelanggan, r.keterangan_review')
      ->join('menu_pesanan mp', 'mp.id_menu_pesanan = r.id_menu_pesanan')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu')
      ->join('pesanan p', 'p.id_pesanan = mp.id_pesanan')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan')
      ->join('akun a', 'a.id_akun = p.id_akun')
      ->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan')
      ->where('sdmp.id_status_pesanan', 6)
      ->groupBy('mp.id_menu_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getDataPesananPelanggan()
  {
    $builder = $this->db->table('review r')
      ->select('p.id_pesanan, m.nama_menu, mp.id_menu_pesanan')
      ->join('pesanan p', 'p.id_pesanan = r.id_pesanan')
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->join('akun a', 'a.id_akun = p.id_akun', 'left')
      ->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left')
      ->where('sdmp.id_status_pesanan', 6)
      ->groupBy(['p.id_pesanan', 'm.nama_menu']); // Kelompokkan berdasarkan pesanan dan nama menu
    $query = $builder->get();
    return $query;
  }
}
