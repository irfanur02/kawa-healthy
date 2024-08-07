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
}
