<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
  protected $table            = 'pelanggan';
  protected $primaryKey       = 'id_pelanggan';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['nama_pelanggan', 'alamat_pelanggan', 'notelp_pelanggan'];
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

  public function insertPelanggan($data)
  {
    $builder = $this->db->table('pelanggan');
    $builder->insert($data);
  }

  public function getMaxIdPelanggan()
  {
    $builder = $this->db->table('pelanggan');
    $builder->selectMax('id_pelanggan');
    $query = $builder->get();
    return $query;
  }

  public function getPelangganById($id = '')
  {
    $builder = $this->db->table('pelanggan');
    $builder->select('*');
    $builder->where('id_pelanggan', $id);
    $query = $builder->get();
    return $query;
  }

  public function updatePelanggan($data = '', $idPelanggan = '')
  {
    $builder = $this->db->table('pelanggan');
    $builder->where('id_pelanggan', $idPelanggan);
    $builder->update($data);
  }
}
