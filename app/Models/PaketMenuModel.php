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
}
