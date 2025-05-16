<?php

namespace App\Models;

use CodeIgniter\Model;

class BiayaOngkirModel extends Model
{
  protected $table            = 'ongkir';
  protected $primaryKey       = 'id_ongkir';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['ongkir_kota', 'biaya_ongkir'];
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

  public function getAllOngkir()
  {
    $builder = $this->db->table('ongkir');
    $builder->select('*');
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function getOngkir($data = '')
  {
    $builder = $this->db->table('ongkir');
    $builder->select('*');
    $builder->where('ongkir_kota', $data);
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function insertOngkir($data = '')
  {
    $builder = $this->db->table('ongkir');
    $builder->insert($data);
  }

  public function updateOngkir($data = '', $id = '')
  {
    $builder = $this->db->table('ongkir');
    $builder->where('id_ongkir', $id);
    $builder->update($data);
  }

  public function deleteOngkir($data = '', $id = '')
  {
    $builder = $this->db->table('ongkir');
    $builder->where('id_ongkir', $id);
    $builder->update($data);
  }
}
