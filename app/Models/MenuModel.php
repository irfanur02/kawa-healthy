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

  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  public function getAllMenu()
  {
    $builder = $this->db->table('menu');
    $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
    $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
    $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
    $builder->where('menu.deleted_at', null);
    // $builder->limit(7);
    $query = $builder->get();
    return $query;
  }

  public function getAllMenuByNama($keyword = '')
  {
    $builder = $this->db->table('menu');
    $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
    $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
    $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
    $builder->like('menu.nama_menu', $keyword);
    $builder->where('menu.deleted_at', null);
    $builder->limit(7);
    $query = $builder->get();
    return $query;
  }

  public function getMenuByNama($dataPencarian = '')
  {
    $builder = $this->db->table('menu');
    $builder->select('menu.id_menu, menu.nama_menu, pack.nama_pack, paket_menu.nama_paket_menu, menu.harga_menu');
    $builder->join('pack', 'pack.id_pack = menu.id_pack', 'left');
    $builder->join('paket_menu', 'paket_menu.id_paket_menu = menu.id_paket_menu', 'left');
    $builder->where('menu.nama_menu', $dataPencarian);
    $builder->where('menu.deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function getMenuById($id = '')
  {
    $builder = $this->db->table('menu');
    $builder->select('*');
    $builder->where('id_menu', $id);
    $builder->where('deleted_at', null);
    $query = $builder->get();
    return $query;
  }

  public function insertMenu($data = '')
  {
    $builder = $this->db->table('menu');
    $builder->insert($data);
  }

  public function updateMenu($data = '', $id = '')
  {
    $builder = $this->db->table('menu');
    $builder->where('id_menu', $id);
    $builder->update($data);
  }

  public function deleteMenu($data = '', $id = '')
  {
    $builder = $this->db->table('menu');
    $builder->where('id_menu', $id);
    $builder->update($data);
  }
}
