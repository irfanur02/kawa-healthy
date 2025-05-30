<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
  protected $table            = 'akun';
  protected $primaryKey       = 'id_akun';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_pelanggan', 'email_akun', 'username_akun', 'password_akun'];
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

  public function insertAkun($data)
  {
    $builder = $this->db->table('akun');
    $builder->insert($data);
  }

  public function getMaxIdAkun()
  {
    $builder = $this->db->table('akun');
    $builder->selectMax('id_akun');
    $query = $builder->get();
    return $query;
  }

  public function getAkunByUsername($username = '')
  {
    $builder = $this->db->table('akun');
    $builder->select('*');
    $builder->where('username_akun', $username);
    $query = $builder->get();
    return $query;
  }

  public function getAkunById($id = '')
  {
    $builder = $this->db->table('akun');
    $builder->select('*');
    $builder->where('id_akun', $id);
    $query = $builder->get();
    return $query;
  }

  public function getDataPelangganById($id = '')
  {
    $builder = $this->db->table('akun');
    $builder->select('*');
    $builder->join('pelanggan', 'pelanggan.id_pelanggan = akun.id_pelanggan');
    $builder->join('ongkir', 'ongkir.id_ongkir = pelanggan.id_ongkir');
    $builder->where('akun.id_akun', $id);
    $query = $builder->get();
    return $query;
  }

  public function updateAkun($data = '', $idAkun = '')
  {
    $builder = $this->db->table('akun');
    $builder->where('id_akun', $idAkun);
    $builder->update($data);
  }

  public function cekUsername($username = '')
  {
    $builder = $this->db->table('akun');
    $builder->select('username_akun');
    $builder->where('username_akun', $username);
    $query = $builder->get();
    return $query;
  }

  public function cekEmail($email = '')
  {
    $builder = $this->db->table('akun');
    $builder->select('email_akun');
    $builder->where('email_akun', $email);
    $query = $builder->get();
    return $query;
  }
}
