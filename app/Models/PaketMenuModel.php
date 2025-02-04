<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketMenuModel extends Model
{
  protected $table            = 'paket_menu';
  protected $primaryKey       = 'id_paket_menu';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['nama_paket_menu', 'harga_paket_menu'];
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

  public function getAllPaketMenu()
  {
    $builder = $this->db->table('paket_menu');
    $builder->select('*');
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function getPaketMenu($paketMenu = '')
  {
    $builder = $this->db->table('paket_menu');
    $builder->select('*');
    $builder->where('nama_paket_menu', $paketMenu);
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function insertPaketMenu($data = '')
  {
    $builder = $this->db->table('paket_menu');
    $builder->insert($data);
  }

  public function updatePaketMenu($data = '', $id = '')
  {
    $builder = $this->db->table('paket_menu');
    $builder->where('id_paket_menu', $id);
    $builder->update($data);
  }

  public function deletePaketMenu($data = '', $id = '')
  {
    $builder = $this->db->table('paket_menu');
    $builder->where('id_paket_menu', $id);
    $builder->update($data);
  }
}
