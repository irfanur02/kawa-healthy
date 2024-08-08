<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
  protected $table            = 'menu';
  protected $primaryKey       = 'id_menu';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_paket_menu', 'id_karbo', 'id_pack', 'nama_menu', 'harga_menu', 'gambar_menu'];
  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';
}
