<?php

namespace App\Models;

use CodeIgniter\Model;

class PackModel extends Model
{
  protected $table            = 'pack';
  protected $primaryKey       = 'id_pack';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['nama_pack'];
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

  public function getPackById($id = '')
  {
    $builder = $this->db->table('pack');
    $builder->select('*');
    $builder->where('id_pack', $id);
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function getAllPack()
  {
    $builder = $this->db->table('pack');
    $builder->select('*');
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }
}
