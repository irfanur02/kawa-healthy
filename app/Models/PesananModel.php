<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
  protected $table            = 'pesanan';
  protected $primaryKey       = 'id_pesanan';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = ['id_catatan_pesanan', 'id_akun', 'id_transaksi'];
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

  public function insertPesanan($data)
  {
    $builder = $this->db->table('pesanan');
    $builder->insert($data);
  }

  public function insertMenuPesanan($data)
  {
    $builder = $this->db->table('menu_pesanan');
    $builder->insert($data);
  }

  public function insertDetailMenuPesanan($data)
  {
    $builder = $this->db->table('detail_menu_pesanan');
    $builder->insert($data);
  }

  public function insertStatusDetailMenuPesanan($data)
  {
    $builder = $this->db->table('status_detail_menu_pesanan');
    $builder->insert($data);
  }

  public function insertTransaksi($data)
  {
    $builder = $this->db->table('transaksi');
    $builder->insert($data);
  }

  public function insertPembayaran($data)
  {
    $builder = $this->db->table('pembayaran');
    $builder->insert($data);
  }

  public function insertDetailPembayaran($data)
  {
    $builder = $this->db->table('detail_pembayaran');
    $builder->insert($data);
  }

  public function insertCatatanPesanan($data)
  {
    $builder = $this->db->table('catatan_pesanan');
    $builder->insert($data);
  }

  public function insertDetailCatatanPesanan($data)
  {
    $builder = $this->db->table('detail_catatan');
    $builder->insert($data);
  }

  public function insertMasaHariBatal($data)
  {
    $builder = $this->db->table('masa_hari_batal');
    $builder->insert($data);
  }

  public function insertTundaPesanan($data)
  {
    $builder = $this->db->table('tunda_pesanan');
    $builder->insert($data);
  }

  public function softDeleteMenuPesanan($otherIdDetailMenuPesanan, $date)
  {
    $builder = $this->db->table('detail_menu_pesanan');
    $builder->set('deleted_at', $date);
    $builder->where('id_detail_menu_pesanan', $otherIdDetailMenuPesanan);
    $builder->update();
  }

  public function updateDataPesananBy($data, $idPesanan)
  {
    $builder = $this->db->table('pesanan');
    $builder->where('id_pesanan', $idPesanan);
    $builder->update($data);
  }

  public function updateMasaHariPaketan($data, $where)
  {
    $builder = $this->db->table('catatan_pesanan');
    $builder->where('id_catatan_pesanan', $where);
    $builder->update($data);
  }

  public function updateMasaHariBatal($data, $where)
  {
    $builder = $this->db->table('masa_hari_batal');
    $builder->where('id_pesanan', $where);
    $builder->update($data);
  }

  public function updateUangDikembalikan($data, $where)
  {
    $builder = $this->db->table('masa_hari_batal');
    $builder->where('id_masa_hari_batal', $where);
    $builder->update($data);
  }

  public function isPaketan($idMenuPesanan)
  {
    $builder = $this->db->table('pesanan p');
    $builder->select('p.id_catatan_pesanan');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan');
    // Kondisi
    $builder->where('mp.id_menu_pesanan', $idMenuPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getAllIdDetailMenuPesanan($tanggalMenu)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('sdmp.id_detail_menu_pesanan');
    $builder->join('karbo k', 'k.id_karbo = dmp.id_karbo', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->join('pack p', 'p.id_pack = m.id_pack', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('akun a', 'a.id_akun = pe.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->where('sdmp.id_status_pesanan', 2);
    $builder->where('jm.tanggal_menu', $tanggalMenu);
    $builder->where('dmp.deleted_at IS NULL', null, false);
    $builder->where('dmp.batal IS NULL', null, false);
    $builder->where('pe.approved', 'y');
    $builder->orderBy('mp.id_menu_pesanan', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getIdDetailMenuPesananByAkun($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('dmp.id_detail_menu_pesanan');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan', 'left');
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('tp.jumlah_tunda', NULL);
    $builder->where('pe.id_akun', $idAkun);
    $query = $builder->get();
    return $query;
  }

  public function getAllPesananPelanggan($tanggalMenu, $idAkun = '', $statusPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                  pe.id_pesanan, pe.id_catatan_pesanan, pel.nama_pelanggan, pel.notelp_pelanggan, mp.id_pesanan, 
                  dmp.id_detail_jadwal_menu, jm.tanggal_menu, dmp.id_menu_pesanan, m.nama_menu, 
                  SUM(dmp.qty_menu) AS qty_menu, SUM(dmp.qty_infuse) AS qty_infuse, p.nama_pack, k.nama_karbo, 
                  dmp.pantangan_pesanan, dmp.keterangan_pedas, pm.nama_paket_menu, 
                  SUM(m.harga_menu) AS harga_menu, SUM(pm.harga_paket_menu) AS harga_paket_menu, tp.jumlah_tunda
              ');
    $builder->join('karbo k', 'k.id_karbo = dmp.id_karbo', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->join('pack p', 'p.id_pack = m.id_pack', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('akun a', 'a.id_akun = pe.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', $statusPesanan);
    if (!empty($idAkun)) {
      $builder->where('pe.id_akun', $idAkun);
    }
    $builder->where('jm.tanggal_menu', $tanggalMenu);
    $builder->where('dmp.deleted_at IS NULL', null, false);
    $builder->where('dmp.batal IS NULL', null, false);
    $builder->where('tp.jumlah_tunda', null);
    $builder->where('pe.approved', 'y');
    $builder->groupBy('
                  m.nama_menu, dmp.qty_menu, dmp.qty_infuse, p.nama_pack, k.nama_karbo, 
                  dmp.pantangan_pesanan, dmp.keterangan_pedas');
    $builder->orderBy('mp.id_menu_pesanan', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllPelangganPemesanan($tanggalMenu)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                pe.id_pesanan, pe.id_catatan_pesanan, pel.nama_pelanggan, o.ongkir_kota, t.alamat_pengiriman, pel.notelp_pelanggan, mp.id_pesanan, tp.jumlah_tunda
    ');
    $builder->join('karbo k', 'k.id_karbo = dmp.id_karbo', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->join('pack p', 'p.id_pack = m.id_pack', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('tunda_pesanan tp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('akun a', 'a.id_akun = pe.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = pe.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->where('sdmp.id_status_pesanan', 2);
    $builder->where('jm.tanggal_menu', $tanggalMenu);
    $builder->where('dmp.deleted_at IS NULL', null, false);
    $builder->where('dmp.batal IS NULL', null, false);
    $builder->where('pe.approved', 'y');
    $builder->groupBy('pel.nama_pelanggan, o.ongkir_kota, t.alamat_pengiriman');
    $builder->orderBy('mp.id_menu_pesanan', 'ASC');

    $query = $builder->get();
    return $query;
  }

  public function getDetailMenuPesananBy($idPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                  mp.id_menu_pesanan, mp.id_jadwal_menu, dmp.id_detail_menu_pesanan, jm.tanggal_menu
              ');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu');
    // Kondisi
    $builder->where('mp.id_pesanan', $idPesanan);
    $builder->groupBy('mp.id_menu_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getDetailPembayaranBy($idPesanan)
  {
    $builder = $this->db->table('detail_pembayaran dp');
    $builder->select('
                  dp.gambar_transfer, dp.nominal_pembayaran, dp.atas_nama_pembayaran
              ');
    $builder->join('pembayaran pem', 'pem.id_pembayaran = dp.id_pembayaran');
    $builder->join('transaksi t', 't.id_transaksi = pem.id_transaksi');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan');
    // Kondisi
    $builder->where('p.id_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getAllMenuPesanan($statusPesanan)
  {
    $builder = $this->db->table('menu_pesanan mp');
    $builder->select('
                  mp.id_jadwal_menu, jm.tanggal_menu, dmp.id_detail_menu_pesanan, tp.jumlah_tunda
              ');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    // Kondisi
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('p.approved', 'y');
    $builder->where('tp.jumlah_tunda', NULL);
    $builder->where('dmp.deleted_at', null);
    // Grouping
    $builder->groupBy('jm.tanggal_menu');
    // Pengurutan
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllMenuDetailMenuPesanan($statusPesanan)
  {
    // SUM(dmp.qty_menu) AS qty_menu
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                mp.id_jadwal_menu, jm.tanggal_menu, dmp.id_detail_menu_pesanan, m.nama_menu, 
                SUM(dmp.qty_menu) AS qty_menu, tp.jumlah_tunda
            ');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan');
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', null);
    $builder->where('dmp.batal', null);
    $builder->where('p.approved', 'y');
    $builder->groupBy('jm.tanggal_menu');
    $builder->groupBy('m.nama_menu');
    $builder->groupBy('mp.id_menu_pesanan');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllPackDetailMenuPesanan($statusPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                mp.id_jadwal_menu, jm.tanggal_menu, dmp.id_detail_menu_pesanan, 
                SUM(dmp.qty_infuse) AS qty_infuse, SUM(dmp.qty_menu) AS qty_menu, p.nama_pack, tp.jumlah_tunda
            ');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('pack p', 'p.id_pack = m.id_pack', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan');
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', null);
    $builder->where('dmp.batal', null);
    $builder->where('pe.approved', 'y');
    $builder->groupBy('jm.tanggal_menu');
    $builder->groupBy('p.nama_pack');
    $builder->groupBy('mp.id_menu_pesanan');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllKarboDetailMenuPesanan($statusPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                mp.id_jadwal_menu, jm.tanggal_menu, dmp.id_detail_menu_pesanan, 
                SUM(dmp.qty_menu) AS qty_menu, k.nama_karbo, tp.jumlah_tunda
            ');
    $builder->join('karbo k', 'k.id_karbo = dmp.id_karbo');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan');
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', null);
    $builder->where('dmp.batal', null);
    $builder->where('p.approved', 'y');
    $builder->groupBy('jm.tanggal_menu');
    $builder->groupBy('k.nama_karbo');
    $builder->groupBy('mp.id_menu_pesanan');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getIdJadwalMenuBy($tanggalMulai)
  {
    // Subquery untuk mendapatkan id_jadwal
    $subQuery = $this->db->table('jadwal_menu jm')
      ->select('jm.id_jadwal')
      ->join('jadwal j', 'j.id_jadwal = jm.id_jadwal')
      ->join('detail_jadwal_menu djm', 'djm.id_jadwal_menu = jm.id_jadwal_menu')
      ->join('menu m', 'm.id_menu = djm.id_menu')
      ->join('pack p', 'p.id_pack = m.id_pack')
      ->where('jm.tanggal_menu', $tanggalMulai)
      ->where('p.nama_pack', 'personal')
      ->groupBy('jm.id_jadwal');
    // Query utama menggunakan subquery di atas
    $builder = $this->db->table('jadwal_menu')
      ->select('id_jadwal_menu')
      ->where('id_jadwal', '(' . $subQuery->getCompiledSelect() . ')', false) // Memasukkan subquery
      ->where('tanggal_menu >=', $tanggalMulai);
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananWithLimit($idPesanan, $masaHariBaru)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('mp.id_menu_pesanan')
      ->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu')
      ->where('mp.id_pesanan', $idPesanan)
      ->groupBy('jm.tanggal_menu')
      ->limit($masaHariBaru);
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananWillBerhenti($idPesanan)
  {
    // Menggunakan Query Builder
    $builder = $this->db->table('status_detail_menu_pesanan sdmp');
    $builder->select('sdmp.id_detail_menu_pesanan');
    $builder->join('detail_menu_pesanan dmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan mp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('pesanan p', 'mp.id_pesanan = p.id_pesanan');
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->where('dmp.batal', NULL);
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananWillBatal($idPesanan, $listIdMenuPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('mp.id_menu_pesanan, dmp.id_detail_menu_pesanan')
      ->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu')
      ->where('mp.id_pesanan', $idPesanan)
      ->whereNotIn('mp.id_menu_pesanan', $listIdMenuPesanan);
    // ->groupBy('jm.tanggal_menu');
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananWillTerima($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan dmp');
    $builder->select('
                  pe.id_pesanan, pe.id_catatan_pesanan, pel.nama_pelanggan, pel.notelp_pelanggan, mp.id_pesanan, jm.tanggal_menu, dmp.id_menu_pesanan, sdmp.id_status_pesanan
              ');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('pesanan pe', 'pe.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('akun a', 'a.id_akun = pe.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('pe.id_akun', $idAkun);
    $builder->where('dmp.deleted_at IS NULL', null, false);
    $builder->groupBy('mp.id_menu_pesanan');
    $builder->orderBy('mp.id_menu_pesanan', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananBy($tanggalMulai, $idPesanan)
  {
    // Membuat query untuk SELECT utama
    $builder = $this->db->table('menu_pesanan mp');
    // Subquery untuk bagian WHERE
    $subQuery = $this->db->table('jadwal_menu jm')
      ->select('jm.id_jadwal')
      ->join('jadwal j', 'j.id_jadwal = jm.id_jadwal')
      ->join('detail_jadwal_menu djm', 'djm.id_jadwal_menu = jm.id_jadwal_menu')
      ->join('menu m', 'm.id_menu = djm.id_menu')
      ->join('pack p', 'p.id_pack = m.id_pack')
      ->where('jm.tanggal_menu', $tanggalMulai)
      ->where('p.nama_pack', 'personal')
      ->groupBy('jm.id_jadwal'); // Menyusun subquery untuk id_jadwal
    // Menyusun query utama
    $builder->select('mp.id_menu_pesanan, mp.id_pesanan, mp.id_jadwal_menu, jm.tanggal_menu')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->where('jm.id_jadwal', '(' . $subQuery->getCompiledSelect() . ')', false)
      ->where('jm.tanggal_menu >=', $tanggalMulai)
      ->where('mp.id_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getIdDetailJadwalMenuBy($tanggalMulai, $listPaketMenuNoInfuse, $listPaketMenuWithInfuse)
  {
    // query
    // SELECT djm.id_jadwal_menu, mp.id_pesanan, djm.id_detail_jadwal_menu, pm.id_paket_menu, pm.nama_paket_menu
    // FROM detail_jadwal_menu djm
    // LEFT JOIN jadwal_menu jm ON jm.id_jadwal_menu = djm.id_jadwal_menu
    // LEFT JOIN menu_pesanan mp ON mp.id_jadwal_menu = jm.id_jadwal_menu
    // LEFT JOIN menu m ON m.id_menu = djm.id_menu
    // LEFT JOIN paket_menu pm ON pm.id_paket_menu = m.id_paket_menu
    // WHERE jm.id_jadwal = (
    //     SELECT jm.id_jadwal
    //     FROM jadwal_menu jm
    //     JOIN jadwal j ON j.id_jadwal = jm.id_jadwal
    //     JOIN detail_jadwal_menu djm ON djm.id_jadwal_menu = jm.id_jadwal_menu
    //     JOIN menu m ON m.id_menu = djm.id_menu
    //     JOIN pack p ON p.id_pack = m.id_pack
    //     WHERE jm.tanggal_menu = '2025-01-22' AND p.nama_pack = 'personal'
    //     GROUP BY jm.id_jadwal)
    // AND jm.tanggal_menu >= '2025-01-22'
    // AND (pm.id_paket_menu IN (1,2) OR pm.id_paket_menu IS null)
    // Membuat query untuk SELECT utama
    $builder = $this->db->table('detail_jadwal_menu djm');
    // Subquery untuk bagian WHERE
    $subQuery = $this->db->table('jadwal_menu jm')
      ->select('jm.id_jadwal')
      ->join('jadwal j', 'j.id_jadwal = jm.id_jadwal')
      ->join('detail_jadwal_menu djm', 'djm.id_jadwal_menu = jm.id_jadwal_menu')
      ->join('menu m', 'm.id_menu = djm.id_menu')
      ->join('pack p', 'p.id_pack = m.id_pack')
      ->where('jm.tanggal_menu', $tanggalMulai)
      ->where('p.nama_pack', 'personal')
      ->groupBy('jm.id_jadwal')
      ->getCompiledSelect(); // Menyusun subquery untuk id_jadwal
    // Menyusun query utama
    $builder->select('djm.id_jadwal_menu, djm.id_detail_jadwal_menu, pm.id_paket_menu, pm.nama_paket_menu');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = djm.id_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('jm.id_jadwal = (' . $subQuery . ')');
    $builder->where('jm.tanggal_menu >=', $tanggalMulai);
    $builder->groupStart(); // Memulai grup kondisi
    $builder->whereIn('pm.id_paket_menu', $listPaketMenuNoInfuse);
    if (!empty($listPaketMenuWithInfuse)) {
      $builder->orWhere('pm.id_paket_menu IS NULL'); // Menambahkan kondisi NULL
    }
    $builder->groupEnd(); // Menutup grup kondisi;

    $query = $builder->get();
    return $query;
  }

  // ! why not work
  // public function updatePesananBy($idPesanan, $statusPesanan, $date)
  // {
  //   $builder = $this->db->table('status_detail_menu_pesanan');
  //   $builder->join('detail_menu_pesanan', 'status_detail_menu_pesanan.id_detail_menu_pesanan = detail_menu_pesanan.id_detail_menu_pesanan');
  //   $builder->join('menu_pesanan', 'detail_menu_pesanan.id_menu_pesanan = menu_pesanan.id_menu_pesanan');
  //   $builder->join('pesanan', 'menu_pesanan.id_pesanan = pesanan.id_pesanan');
  //   $builder->where('pesanan.id_pesanan', $idPesanan);
  //   $builder->set('status_detail_menu_pesanan.id_status_pesanan', $statusPesanan);
  //   $builder->set('status_detail_menu_pesanan.updated_at', $date);
  //   $builder->update();
  // }
  public function updatePesananBy($idDetailMenuPesanan, $statusPesanan, $date)
  {
    $builder = $this->db->table('status_detail_menu_pesanan');
    $builder->set('id_status_pesanan', $statusPesanan);
    $builder->set('updated_at', $date);
    $builder->where('id_detail_menu_pesanan', $idDetailMenuPesanan);
    $builder->update();
  }

  public function updateMenuPesananBy($where, $data)
  {
    $builder = $this->db->table('detail_menu_pesanan');
    $builder->where('id_detail_menu_pesanan', $where);
    $builder->update($data);
  }

  public function getIdMenuPesanan($idPesanan)
  {
    // Menggunakan Query Builder
    $builder = $this->db->table('status_detail_menu_pesanan sdmp');
    $builder->select('sdmp.id_detail_menu_pesanan');
    $builder->join('detail_menu_pesanan dmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan mp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('pesanan p', 'mp.id_pesanan = p.id_pesanan');
    $builder->where('p.id_pesanan', $idPesanan);
    // $builder->groupBy('mp.id_menu_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananPaketan($idPesanan)
  {
    // Menggunakan Query Builder
    $builder = $this->db->table('status_detail_menu_pesanan sdmp');
    $builder->select('sdmp.id_detail_menu_pesanan');
    $builder->join('detail_menu_pesanan dmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan mp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('pesanan p', 'mp.id_pesanan = p.id_pesanan');
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->groupBy('mp.id_menu_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getIdMenuPesananFindBerhenti($idPesanan)
  {
    // Menggunakan Query Builder
    $builder = $this->db->table('status_detail_menu_pesanan sdmp');
    $builder->select('COUNT(*)');
    $builder->join('detail_menu_pesanan dmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan mp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('pesanan p', 'mp.id_pesanan = p.id_pesanan');
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->where('sdmp.id_status_pesanan', 9);
    $builder->groupBy('sdmp.id_status_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getIdTransaksiBy($idPesanan)
  {
    $builder = $this->db->table('transaksi');
    $builder->select('id_transaksi');
    $builder->where('id_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getIdPembayaranBy($idTransaksi)
  {
    $builder = $this->db->table('pembayaran');
    $builder->select('id_pembayaran');
    $builder->where('id_transaksi', $idTransaksi);
    $query = $builder->get();
    return $query;
  }

  public function getMaxIdPesanan()
  {
    $builder = $this->db->table('pesanan');
    $builder->selectMax('id_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getMaxIdMenuPesanan()
  {
    $builder = $this->db->table('menu_pesanan');
    $builder->selectMax('id_menu_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getMaxIdDetailMenuPesanan()
  {
    $builder = $this->db->table('detail_menu_pesanan');
    $builder->selectMax('id_detail_menu_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getMaxIdCatatanPesanan()
  {
    $builder = $this->db->table('catatan_pesanan');
    $builder->selectMax('id_catatan_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getIdPesananBy($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('p.id_pesanan');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->groupBy('p.id_pesanan');
    $query = $builder->get();
    return $query;
  }


  public function getOtherIdDetailMenuPesananFamilyBy($pedas, $namaMenu, $idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.keterangan_pedas', $pedas);
    $builder->where('m.nama_menu', $namaMenu);
    $query = $builder->get();
    return $query;
  }

  public function getOtherIdDetailMenuPesananPersonalBy($pantangan, $namaMenu, $namaPaket, $namaKarbo, $idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('dmp.id_detail_menu_pesanan');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('karbo as k', 'dmp.id_karbo = k.id_karbo', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('paket_menu as pm', 'm.id_paket_menu = pm.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.pantangan_pesanan', $pantangan);
    $builder->where('m.nama_menu', $namaMenu);
    $builder->where('pm.nama_paket_menu', $namaPaket);
    $builder->where('k.nama_karbo', $namaKarbo);
    $query = $builder->get();
    return $query;
  }

  public function getDataMenuPesananBy($idDetailMenuPesanan, $idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('m.nama_menu, dmp.keterangan_pedas, dmp.pantangan_pesanan, pm.nama_paket_menu, k.nama_karbo');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('karbo as k', 'dmp.id_karbo = k.id_karbo', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('paket_menu as pm', 'm.id_paket_menu = pm.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.id_detail_menu_pesanan', $idDetailMenuPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getIdPesananInMasaHariBatal($idPesanan)
  {
    $builder = $this->db->table('masa_hari_batal');
    $builder->select('id_pesanan, masa_hari');
    $builder->where('id_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getAllPaketanPesananBerhenti()
  {
    // Subquery: Menghitung jumlah pesanan yang belum dikirim
    $subQueryBelumDikirim = $this->db->table('menu_pesanan mp1')
      ->select('COUNT(DISTINCT mp1.id_menu_pesanan)', false)
      ->join('detail_menu_pesanan dmp1', 'dmp1.id_menu_pesanan = mp1.id_menu_pesanan')
      ->join('status_detail_menu_pesanan sdmp1', 'sdmp1.id_detail_menu_pesanan = dmp1.id_detail_menu_pesanan')
      ->where('mp1.id_pesanan = p.id_pesanan')
      ->whereIn('sdmp1.id_status_pesanan', [2, 9])
      ->groupBy('mp1.id_pesanan')
      ->getCompiledSelect(false);

    // Subquery: Menghitung sisa jadwal
    $subQuerySisaJadwal = "COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) - ($subQueryBelumDikirim)";
    // Subquery: Menghitung jumlah hari
    $subQueryJumlahHari = "($subQueryBelumDikirim) + ($subQuerySisaJadwal)";
    // Subquery: Menghitung total ongkir
    $subQueryTotalOngkir = "o.biaya_ongkir * ($subQueryJumlahHari)";
    // Query utama
    $builder = $this->db->table('pesanan as p');
    $builder->select("
            p.id_pesanan, pel.nama_pelanggan, o.biaya_ongkir, sdmp.id_status_pesanan, pel.notelp_pelanggan,
            COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) AS masa_paketan,
            ($subQueryBelumDikirim) AS jumlah_pesanan_belum_dikirim,
            ($subQuerySisaJadwal) AS sisa_jadwal,
            ($subQueryJumlahHari) AS jumlah_hari,
            ($subQueryTotalOngkir) AS total_ongkir,
            SUM(DISTINCT pm.harga_paket_menu) AS harga_paket_menu,
            (SUM(DISTINCT pm.harga_paket_menu) * ($subQueryJumlahHari)) AS total_harga_menu,
            ((SUM(DISTINCT pm.harga_paket_menu) * ($subQueryJumlahHari)) + ($subQueryTotalOngkir)) AS total_harga_keseluruhan
            ");
    $builder->join('menu_pesanan as mp', 'mp.id_pesanan = p.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('status_detail_menu_pesanan as sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('akun as a', 'a.id_akun = p.id_akun');
    $builder->join('pelanggan as pel', 'pel.id_pelanggan = a.id_pelanggan');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan');
    $builder->join('detail_catatan dc', 'dc.id_catatan_pesanan = cp.id_catatan_pesanan');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = dc.id_paket_menu');
    $builder->where('p.berhenti_paketan', 'y');
    $builder->groupBy('p.id_pesanan');

    $query = $builder->get();
    return $query;
  }

  public function getAllPaketanPesananGantiMasa()
  {
    $builder = $this->db->table('masa_hari_batal as mhb');
    $builder->select('
                  p.id_pesanan, mhb.id_masa_hari_batal, pel.nama_pelanggan, o.biaya_ongkir, pel.notelp_pelanggan,
                  mhb.masa_hari, mhb.uang_dikembalikan, p.berhenti_paketan, 
                  (mhb.masa_hari * o.biaya_ongkir) AS total_ongkir,
                  (mhb.masa_hari * SUM(pm.harga_paket_menu)) AS total_harga');
    $builder->join('pesanan as p', 'p.id_pesanan = mhb.id_pesanan', 'left');
    $builder->join('akun as a', 'a.id_akun = p.id_akun', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('pelanggan as pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('catatan_pesanan as cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan', 'left');
    $builder->join('detail_catatan as dc', 'dc.id_catatan_pesanan = cp.id_catatan_pesanan', 'left');
    $builder->join('paket_menu as pm', 'pm.id_paket_menu = dc.id_paket_menu', 'left');
    // $builder->groupStart(); // Group conditions for "OR" logic
    // $builder->where('p.masa_hari_batal IS NOT', NULL);
    // $builder->orWhere('p.berhenti_paketan IS NOT', NULL);
    // $builder->groupEnd();
    $builder->groupBy('p.id_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getAllBatalPesanan()
  {
    $builder = $this->db->table('menu_pesanan mp');
    $builder->select("
                mp.id_menu_pesanan, mp.id_pesanan, mp.id_jadwal_menu, sdmp.id_status_pesanan, p.id_catatan_pesanan, pel.notelp_pelanggan,
                sdmp.id_status_pesanan, sp.keterangan_status, pel.nama_pelanggan, dmp.batal, p.berhenti_paketan,
                o.biaya_ongkir, dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu,
                SUM(
                    COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * 
                    COALESCE(m.harga_menu, pm.harga_paket_menu, 0) + 
                    COALESCE(dmp.qty_infuse, 0) * 10000
                ) AS total_harga
            ", false);
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('status_pesanan sp', 'sp.id_status_pesanan = sdmp.id_status_pesanan', 'left');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('akun a', 'a.id_akun = p.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->groupStart() // Group conditions for "OR" logic
      ->orWhereIn('sdmp.id_status_pesanan', [2, 4])
      ->where('dmp.batal', 'b')
      ->where('p.id_catatan_pesanan', NULL)
      ->groupEnd();
    $builder->groupBy(['mp.id_menu_pesanan', 'mp.id_pesanan']);
    $builder->orderBy('sdmp.id_status_pesanan', "ASC");
    $query = $builder->get();
    return $query;
  }

  public function getAllPesananPelangganSelesai()
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select("
                    p.id_pesanan,
                    p.id_catatan_pesanan,
                    mp.id_menu_pesanan,
                    jm.tanggal_menu, 
                    pel.nama_pelanggan, 
                    t.alamat_pengiriman, 
                    o.ongkir_kota, 
                    o.biaya_ongkir, 
                    m.nama_menu,
                    SUM(dmp.qty_menu) AS qty_menu, 
                    SUM(dmp.qty_infuse) AS qty_infuse,
                    SUM(
                        COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * 
                        COALESCE(m.harga_menu, pm.harga_paket_menu, 0) + 
                        COALESCE(dmp.qty_infuse, 0) * 10000
                    ) AS total_harga
                ");
    $builder->join('akun as a', 'p.id_akun = a.id_akun', 'left');
    $builder->join('pelanggan as pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi as t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir as o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('menu_pesanan as mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu as jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan as dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu as djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu as pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->groupBy(['pel.nama_pelanggan', 'jm.tanggal_menu', 'mp.id_pesanan']);
    $builder->orderBy('jm.tanggal_menu', 'DESC');
    $builder->orderBy('pel.nama_pelanggan', 'ASC');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllMenuPesananPelangganSelesai()
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select("
                  p.id_pesanan,
                  p.id_catatan_pesanan,
                  mp.id_menu_pesanan,
                  jm.tanggal_menu, 
                  pel.nama_pelanggan, 
                  t.alamat_pengiriman, 
                  o.ongkir_kota, 
                  m.nama_menu,
                  SUM(dmp.qty_menu) AS qty_menu, 
                  SUM(dmp.qty_infuse) AS qty_infuse, 
                  m.harga_menu, 
                  pm.harga_paket_menu
              ");
    $builder->join('akun as a', 'p.id_akun = a.id_akun', 'left');
    $builder->join('pelanggan as pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi as t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir as o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('menu_pesanan as mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu as jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan as dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu as djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu as pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->groupBy(['m.nama_menu', 'pel.nama_pelanggan', 'p.id_pesanan']);
    $builder->orderBy('jm.tanggal_menu', 'DESC');
    $builder->orderBy('pel.nama_pelanggan', 'ASC');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getPesananDiterimaUser($idAkun)
  {
    $builder = $this->db->table('pesanan pe')
      ->select("
            t.tanggal_transaksi, pe.id_pesanan, mp.id_menu_pesanan, mp.id_jadwal_menu, jm.tanggal_menu, o.biaya_ongkir,
            dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu, r.keterangan_review")
      ->select("SUM(
              COALESCE(dmp.qty_menu, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
              COALESCE(dmp.qty_infuse, 0) * 10000
              ) AS total_harga")
      ->join('transaksi t', 't.id_pesanan = pe.id_pesanan', 'left')
      ->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left')
      ->join('menu_pesanan mp', 'mp.id_pesanan = pe.id_pesanan', 'left')
      ->join('review r', 'r.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('dmp.deleted_at IS NULL')
      ->where('pe.id_akun', $idAkun)
      ->where('sdmp.id_status_pesanan', 6)
      ->groupBy('mp.id_jadwal_menu')
      // ->groupBy('pe.id_pesanan')
      ->groupBy('pe.id_pesanan', 'mp.id_menu_pesanan')
      ->orderBy('jm.tanggal_menu', 'DESC');
    $query = $builder->get();
    return $query;
  }

  public function getAllPesananUser()
  {
    $subquery1 = $this->db->table('catatan_pesanan cp1')
      ->select('SUM(pm1.harga_paket_menu)')
      ->join('detail_catatan dc1', 'dc1.id_catatan_pesanan = cp1.id_catatan_pesanan', 'inner')
      ->join('paket_menu pm1', 'pm1.id_paket_menu = dc1.id_paket_menu', 'inner')
      ->where('cp1.id_catatan_pesanan = cp.id_catatan_pesanan')
      ->groupBy('cp1.id_catatan_pesanan');

    $subquery2 = $this->db->table('catatan_pesanan cp1')
      ->select('SUM(pm1.harga_paket_menu)')
      ->join('detail_catatan dc1', 'dc1.id_catatan_pesanan = cp1.id_catatan_pesanan', 'inner')
      ->join('paket_menu pm1', 'pm1.id_paket_menu = dc1.id_paket_menu', 'inner')
      ->where('cp1.id_catatan_pesanan = cp.id_catatan_pesanan')
      ->groupBy('cp1.id_catatan_pesanan');

    $subquery3 = $this->db->table('menu_pesanan')
      ->select('COUNT(DISTINCT jadwal_menu.tanggal_menu)')
      ->join('jadwal_menu', 'jadwal_menu.id_jadwal_menu = menu_pesanan.id_jadwal_menu')
      ->where('menu_pesanan.id_pesanan = pe.id_pesanan');

    // * ({$subquery3->getCompiledSelect()} * o.biaya_ongkir) AS total_ongkir, 
    $builder = $this->db->table('pesanan pe')
      ->select("
            t.tanggal_transaksi, pe.id_pesanan, pel.nama_pelanggan, o.biaya_ongkir, dmp.batal,
            ({$subquery3->getCompiledSelect()}) AS jumlah_hari, 
            pe.id_catatan_pesanan, cp.periode_hari_paketan", false)
      ->select("({$subquery1->getCompiledSelect()}) AS total_harga_paketan", false)
      ->select("
            ((o.biaya_ongkir * cp.periode_hari_paketan) + 
            (cp.periode_hari_paketan * ({$subquery2->getCompiledSelect()}))
            ) AS total_harga_paketan_keseluruhan", false)
      ->select('dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu')
      ->select("SUM(
                  COALESCE(dmp.qty_menu, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
                  COALESCE(dmp.qty_infuse, 0) * 10000
                ) AS total_harga", false)
      ->select('pe.approved')
      ->join('transaksi t', 't.id_pesanan = pe.id_pesanan', 'left')
      ->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left')
      ->join('menu_pesanan mp', 'mp.id_pesanan = pe.id_pesanan', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->join('akun a', 'a.id_akun = pe.id_akun', 'left')
      ->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left')
      ->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = pe.id_catatan_pesanan', 'left')
      ->where('dmp.deleted_at IS NULL')
      ->whereIn('sdmp.id_status_pesanan', [2, 4, 5, 6, 9])
      ->groupBy('pe.id_pesanan')
      ->orderBy('pe.approved', 'ASC')
      ->orderBy('t.tanggal_transaksi', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getAllPesananBiasaBy($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('transaksi t');
    $builder->select('
                    t.id_transaksi, t.tanggal_transaksi, mp.id_menu_pesanan, jm.id_jadwal_menu , jm.tanggal_menu, p.id_catatan_pesanan, p.id_pesanan, sp.keterangan_status, 
                    dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu, dmp.batal,
                    SUM(
                      COALESCE(dmp.qty_menu, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
                      COALESCE(dmp.qty_infuse, 0) * 10000
                    ) AS total_harga,
                    (SUM(
                      COALESCE(dmp.qty_menu, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
                      COALESCE(dmp.qty_infuse, 0) * 10000
                    ) + o.biaya_ongkir
                    ) AS total_semua_harga
                ');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('status_pesanan sp', 'sp.id_status_pesanan = sdmp.id_status_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_catatan_pesanan', null);
    $builder->whereIn('sdmp.id_status_pesanan', $statusPesanan);
    $builder->groupBy('jm.tanggal_menu');
    $builder->groupBy('t.id_transaksi');
    $builder->where('dmp.deleted_at', NULL);
    $query = $builder->get();
    return $query;
  }

  public function getAllPesananPaketanBy($idAkun)
  {
    // Subquery untuk menghitung 'pesanan_terkirim'
    $subQueryGetPesananTerkirim = $this->db->table('menu_pesanan mp_sub')
      ->select("COUNT(DISTINCT mp_sub.id_menu_pesanan) AS pesanan_terkirim")
      ->join('pesanan p_sub', 'p_sub.id_pesanan = mp_sub.id_pesanan')
      ->join('jadwal_menu jm_sub', 'jm_sub.id_jadwal_menu = mp_sub.id_jadwal_menu')
      ->join('detail_menu_pesanan dmp_sub', 'dmp_sub.id_menu_pesanan = mp_sub.id_menu_pesanan')
      ->join('status_detail_menu_pesanan sdmp_sub', 'sdmp_sub.id_detail_menu_pesanan = dmp_sub.id_detail_menu_pesanan')
      ->join('detail_jadwal_menu djm_sub', 'djm_sub.id_detail_jadwal_menu = dmp_sub.id_detail_jadwal_menu')
      ->join('menu m_sub', 'm_sub.id_menu = djm_sub.id_menu')
      ->join('paket_menu pm_sub', 'pm_sub.id_paket_menu = m_sub.id_paket_menu')
      ->where('p_sub.id_akun', $idAkun)
      ->where('p_sub.id_pesanan = p.id_pesanan', null, false) // Pastikan tidak di-bind sebagai string literal
      ->whereIn('sdmp_sub.id_status_pesanan', [5, 6])
      ->where('dmp_sub.deleted_at', null)
      ->groupBy('mp_sub.id_pesanan');

    $subQueryGetTotalHarga = $this->db->table('catatan_pesanan cp_sub')
      ->select("
          ((COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) * SUM(pm_sub.harga_paket_menu)) + 
          (o_sub.biaya_ongkir * COALESCE(cp_sub.periode_hari_baru, cp_sub.periode_hari_paketan))) AS total_semua
      ")
      ->join('pesanan p_sub', 'p_sub.id_catatan_pesanan = cp_sub.id_catatan_pesanan', 'left')
      ->join('transaksi t_sub', 't_sub.id_pesanan = p_sub.id_pesanan', 'left')
      ->join('ongkir o_sub', 'o_sub.id_ongkir = t_sub.id_ongkir', 'left')
      ->join('detail_catatan dc_sub', 'dc_sub.id_catatan_pesanan = cp_sub.id_catatan_pesanan')
      ->join('paket_menu pm_sub', 'pm_sub.id_paket_menu = dc_sub.id_paket_menu')
      ->where('cp_sub.id_catatan_pesanan', 'p.id_catatan_pesanan', false) // Menggunakan false untuk menghindari escape
      ->groupBy('cp_sub.id_catatan_pesanan');

    $subQueryGetPesananBerhenti = $this->db->table('status_detail_menu_pesanan sdmp')
      ->select('COUNT(*)')
      ->join('detail_menu_pesanan dmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan')
      ->join('menu_pesanan mp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan')
      ->join('pesanan pe', 'mp.id_pesanan = pe.id_pesanan')
      ->where('pe.id_pesanan', 'p.id_pesanan', false)
      ->where('sdmp.id_status_pesanan', 9)
      ->groupBy('sdmp.id_status_pesanan');

    // Query utama
    $builder = $this->db->table('transaksi t');
    $builder->select("
              t.tanggal_transaksi, jm.id_jadwal_menu, jm.tanggal_menu AS tanggal_menu, cp.periode_hari_paketan, 
              ({$subQueryGetTotalHarga->getCompiledSelect(false)}) AS total_harga,
              ({$subQueryGetPesananTerkirim->getCompiledSelect(false)}) AS pesanan_terkirim,
              ({$subQueryGetPesananBerhenti->getCompiledSelect(false)}) AS status_berhenti,
              p.id_pesanan, cp.periode_hari_baru, p.approved, p.berhenti_paketan
              ");
    // Join tabel
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan', 'left');
    $builder->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    // Kondisi
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_catatan_pesanan IS NOT', null, false); // Pastikan nilai NULL tidak menjadi string
    $builder->whereIn('sdmp.id_status_pesanan', [2, 5, 6, 7, 9]);
    $builder->where('dmp.deleted_at', null);
    // Grouping
    $builder->groupBy('p.id_pesanan');
    $builder->groupBy('t.id_transaksi');
    // $builder->orderBy('p.id_pesanan', "DESC");
    // $builder->orderBy('jm.tanggal_menu', "ASC");
    $builder->orderBy('p.approved', "DESC");
    $builder->orderBy('p.berhenti_paketan', "ASC");
    // $builder->orderBy('sdmp.id_status_pesanan', "ASC");
    // $builder->orderBy('t.tanggal_transaksi', "DESC");
    $query = $builder->get();
    return $query;
  }

  public function getTotalHargaPaketanBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('catatan_pesanan cp');
    $builder->select("
                  ((COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) * SUM(pm.harga_paket_menu)) + 
                  (o.biaya_ongkir * COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan))) AS total_harga
              ");
    $builder->join('pesanan p', 'p.id_catatan_pesanan = cp.id_catatan_pesanan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('detail_catatan dc', 'dc.id_catatan_pesanan = cp.id_catatan_pesanan');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = dc.id_paket_menu');
    $builder->where('p.id_pesanan', $idPesanan); // Menggunakan false untuk menghindari escape
    $builder->groupBy('cp.id_catatan_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function getCatatanPaketanBy($idAkun, $idPesanan)
  {
    $subquery1 = $this->db->table('tunda_pesanan tp')
      ->select('SUM(tp.jumlah_tunda)')
      ->where('tp.id_pesanan', 'p.id_pesanan', false)
      ->groupBy('tp.id_pesanan');

    $builder = $this->db->table('catatan_pesanan cp');
    $builder->select("
                  p.id_pesanan, p.id_catatan_pesanan, cp.id_karbo, k.nama_karbo, cp.pantangan_paketan, 
                  cp.periode_hari_paketan, cp.periode_hari_baru, cp.tanggal_mulai_pesanan, 
                  t.tanggal_transaksi, p.approved, p.berhenti_paketan, SUM(DISTINCT tp.jumlah_tunda) AS jumlah_tunda
              ");
    $builder->select("({$subquery1->getCompiledSelect()}) AS jumlah_tunda", false);
    $builder->join('detail_catatan dc', 'dc.id_detail_catatan = cp.id_catatan_pesanan', 'left');
    $builder->join('pesanan p', 'p.id_catatan_pesanan = cp.id_catatan_pesanan', 'left');
    $builder->join('tunda_pesanan tp', 'tp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('karbo k', 'k.id_karbo = m.id_karbo', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->where('p.id_catatan_pesanan IS NOT', null);
    $builder->whereIn('sdmp.id_status_pesanan', [2, 4, 5, 6, 9]);
    $builder->where('dmp.deleted_at', null);
    // $builder->groupBy('p.id_pesanan');

    $query = $builder->get();
    return $query;
  }

  public function getCatatanPaketMenuBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select("pm.nama_paket_menu");
    $builder->join('catatan_pesanan as cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan');
    $builder->join('detail_catatan as dc', 'dc.id_catatan_pesanan = cp.id_catatan_pesanan');
    $builder->join('paket_menu as pm', 'pm.id_paket_menu = dc.id_paket_menu');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_pesanan', $idPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getPesananPaketanBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('transaksi t');
    $builder->select('
                    mp.id_menu_pesanan, 
                    jm.id_jadwal_menu, 
                    jm.tanggal_menu,
                    dmp.batal,
                    sdmp.id_status_pesanan,
                    p.berhenti_paketan,
                    tp.jumlah_tunda
                ');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan');
    $builder->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_pesanan', $idPesanan);
    // $builder->where('dmp.batal', NULL);
    $builder->whereIn('sdmp.id_status_pesanan', [2, 5, 6, 9]);
    $builder->where('p.id_catatan_pesanan IS NOT', null);
    $builder->where('dmp.deleted_at', null);
    $builder->groupBy('jm.tanggal_menu');

    $query = $builder->get();
    return $query;
  }

  public function getDetailPesananPaketanBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('transaksi t');
    $builder->select('
                    mp.id_menu_pesanan, 
                    jm.id_jadwal_menu, 
                    jm.tanggal_menu, 
                    m.nama_menu, 
                    pm.nama_paket_menu,
                    dmp.batal
                ');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->where('p.id_catatan_pesanan IS NOT', null);
    $builder->whereIn('sdmp.id_status_pesanan', [2, 4, 5, 6, 9]);
    $builder->where('dmp.deleted_at', null);
    $builder->orderBy('jm.tanggal_menu', "ASC");
    $builder->orderBy('pm.nama_paket_menu', "DESC");

    $query = $builder->get();
    return $query;
  }

  public function getSisaPesananPaketanBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('menu_pesanan mp');
    // $builder->select('*');
    $builder->select('
                  cp.periode_hari_paketan, COUNT(*) AS pesanan_terjadwal, 
                  (COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) - COUNT(*)) AS sisa_pesanan_paketan
              ');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('mp.id_pesanan', $idPesanan);
    $builder->groupBy('cp.periode_hari_paketan');
    $query = $builder->get();
    return $query;
  }

  public function getAllPelangganPaketan()
  {
    $builder = $this->db->table('menu_pesanan mp');
    $builder->select('
                  cp.periode_hari_paketan, COUNT(*) AS pesanan_terjadwal, 
                  (COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) - COUNT(*)) AS sisa_pesanan_paketan
              ');
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan');
    $builder->groupBy('cp.periode_hari_paketan');
    $query = $builder->get();
    return $query;
  }

  public function getPesananPaketanTerkirimBy($idAkun, $idPesanan)
  {
    $builder = $this->db->table('menu_pesanan mp');
    $builder->select("COUNT(DISTINCT dmp.id_menu_pesanan) AS pesanan_terkirim");
    $builder->join('pesanan p', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu');
    $builder->join('menu m', 'm.id_menu = djm.id_menu');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->where('dmp.deleted_at', null);
    $builder->groupBy('mp.id_pesanan');
    // $builder->groupBy('sdmp.id_status_pesanan');
    $query = $builder->get();
    return $query;
  }

  public function totalHargaPesananAkun($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select("SUM(COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) + COALESCE(dmp.qty_infuse, 0) * 10000) AS total_harga");
    // $builder->select("dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu");
    // $builder->select("SUM(COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0)) AS total_harga");
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('paket_menu as pm', 'm.id_paket_menu = pm.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', NULL);
    $query = $builder->get();
    return $query;
  }

  public function pesananByIdAkun($idAkun, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('
                    dmp.id_detail_menu_pesanan, dmp.id_detail_jadwal_menu, dmp.pantangan_pesanan, SUM(dmp.qty_menu) AS qty_menu, SUM(dmp.qty_infuse) AS qty_infuse, dmp.keterangan_pedas, dmp.id_karbo, 
                    jm.tanggal_menu, 
                    m.nama_menu, m.id_pack, m.harga_menu, 
                    pm.nama_paket_menu, pm.harga_paket_menu, 
                    k.nama_karbo,
                    pck.nama_pack');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('karbo as k', 'dmp.id_karbo = k.id_karbo', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu as jm', 'djm.id_jadwal_menu = jm.id_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('pack as pck', 'm.id_pack = pck.id_pack', 'left');
    $builder->join('paket_menu as pm', 'm.id_paket_menu = pm.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('p.id_akun', $idAkun);
    $builder->where('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', NULL);
    $builder->groupBy([
      'm.nama_menu', 'dmp.keterangan_pedas', 'dmp.qty_menu', 'jm.tanggal_menu', 'm.id_pack', 'm.harga_menu', 'pm.nama_paket_menu', 'pm.harga_paket_menu', 'k.nama_karbo', 'dmp.pantangan_pesanan'
    ]);
    $builder->having('(COUNT(DISTINCT dmp.keterangan_pedas) = 1 OR dmp.keterangan_pedas IS NULL)');
    $builder->orderBy('jm.tanggal_menu', 'ASC');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getIdDetailMenuPesanan($idMenuPesanan)
  {
    $builder = $this->db->table('detail_menu_pesanan');
    $builder->select('id_detail_menu_pesanan');
    $builder->where('id_menu_pesanan', $idMenuPesanan);
    $query = $builder->get();
    return $query;
  }

  public function getDetailPesananBiasaBy($idPesanan, $tanggalMenu, $statusPesanan)
  {
    $builder = $this->db->table('pesanan as p');
    $builder->select('
                    dmp.id_detail_menu_pesanan, dmp.id_detail_jadwal_menu, dmp.pantangan_pesanan, SUM(dmp.qty_menu) AS qty_menu, SUM(dmp.qty_infuse) AS qty_infuse, dmp.keterangan_pedas, dmp.id_karbo, 
                    jm.tanggal_menu, 
                    m.nama_menu, m.id_pack, m.harga_menu, 
                    pm.nama_paket_menu, pm.harga_paket_menu, 
                    k.nama_karbo,
                    pck.nama_pack');
    $builder->join('menu_pesanan as mp', 'p.id_pesanan = mp.id_pesanan');
    $builder->join('detail_menu_pesanan as dmp', 'mp.id_menu_pesanan = dmp.id_menu_pesanan', 'left');
    $builder->join('karbo as k', 'dmp.id_karbo = k.id_karbo', 'left');
    $builder->join('detail_jadwal_menu as djm', 'dmp.id_detail_jadwal_menu = djm.id_detail_jadwal_menu', 'left');
    $builder->join('jadwal_menu as jm', 'djm.id_jadwal_menu = jm.id_jadwal_menu', 'left');
    $builder->join('menu as m', 'djm.id_menu = m.id_menu', 'left');
    $builder->join('pack as pck', 'm.id_pack = pck.id_pack', 'left');
    $builder->join('paket_menu as pm', 'm.id_paket_menu = pm.id_paket_menu', 'left');
    $builder->join('status_detail_menu_pesanan as sdmp', 'dmp.id_detail_menu_pesanan = sdmp.id_detail_menu_pesanan', 'left');
    $builder->where('mp.id_pesanan', $idPesanan);
    $builder->where('jm.tanggal_menu', $tanggalMenu);
    $builder->whereIn('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('dmp.deleted_at', NULL);
    $builder->groupBy([
      'm.nama_menu', 'dmp.keterangan_pedas', 'dmp.qty_menu', 'm.id_pack', 'm.harga_menu', 'pm.nama_paket_menu', 'pm.harga_paket_menu', 'k.nama_karbo', 'dmp.pantangan_pesanan'
    ]);
    $builder->having('(COUNT(DISTINCT dmp.keterangan_pedas) = 1 OR dmp.keterangan_pedas IS NULL)');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getDataTransaksiBy($idPesanan, $tanggalMenu, $statusPesanan)
  {
    $builder = $this->db->table('transaksi t');
    $builder->select('
                    t.id_transaksi, t.tanggal_transaksi, mp.id_menu_pesanan, mp.id_jadwal_menu, jm.tanggal_menu, dmp.qty_menu, dmp.qty_infuse, m.harga_menu, pm.harga_paket_menu,
                    SUM(
                      COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
                      COALESCE(dmp.qty_infuse, 0) * 10000
                    ) AS total_harga,
                    (SUM(
                      COALESCE(dmp.qty_menu, 0) * COALESCE(m.harga_menu, pm.harga_paket_menu, 0) +
                      COALESCE(dmp.qty_infuse, 0) * 10000
                    ) + o.biaya_ongkir
                    ) AS total_semua_harga
                ');
    // $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('pesanan p', 'p.id_pesanan = t.id_pesanan');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', $statusPesanan);
    $builder->where('jm.tanggal_menu', $tanggalMenu);
    $builder->where('p.id_pesanan', $idPesanan);
    $builder->where('dmp.deleted_at', NULL);
    // $builder->groupBy('jm.tanggal_menu');
    $query = $builder->get();
    return $query;
  }

  public function getDataLaporan($tanggalAwal = '', $tanggalAkhir = '')
  {
    $subQueryJumlahFamily = $this->db->table('pesanan AS p1')
      ->select('COUNT(pa1.nama_pack)')
      ->join('menu_pesanan AS mp1', 'mp1.id_pesanan = p1.id_pesanan', 'left')
      ->join('jadwal_menu AS jm1', 'jm1.id_jadwal_menu = mp1.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan AS dmp1', 'dmp1.id_menu_pesanan = mp1.id_menu_pesanan', 'left')
      ->join('status_detail_menu_pesanan AS sdmp1', 'sdmp1.id_detail_menu_pesanan = dmp1.id_detail_menu_pesanan', 'left')
      ->join('detail_jadwal_menu AS djm1', 'djm1.id_detail_jadwal_menu = dmp1.id_detail_jadwal_menu', 'left')
      ->join('menu AS m1', 'm1.id_menu = djm1.id_menu', 'left')
      ->join('pack AS pa1', 'pa1.id_pack = m1.id_pack', 'left')
      ->whereIn('sdmp1.id_status_pesanan', [5, 6])
      ->where('pa1.nama_pack', 'family')
      ->where('jm1.tanggal_menu = jm.tanggal_menu', null, false)
      ->groupBy('jm1.tanggal_menu');

    $subQueryJumlahPersonal = $this->db->table('pesanan AS p1')
      ->select('COUNT(pa1.nama_pack)')
      ->join('menu_pesanan AS mp1', 'mp1.id_pesanan = p1.id_pesanan', 'left')
      ->join('jadwal_menu AS jm1', 'jm1.id_jadwal_menu = mp1.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan AS dmp1', 'dmp1.id_menu_pesanan = mp1.id_menu_pesanan', 'left')
      ->join('status_detail_menu_pesanan AS sdmp1', 'sdmp1.id_detail_menu_pesanan = dmp1.id_detail_menu_pesanan', 'left')
      ->join('detail_jadwal_menu AS djm1', 'djm1.id_detail_jadwal_menu = dmp1.id_detail_jadwal_menu', 'left')
      ->join('menu AS m1', 'm1.id_menu = djm1.id_menu', 'left')
      ->join('pack AS pa1', 'pa1.id_pack = m1.id_pack', 'left')
      ->whereIn('sdmp1.id_status_pesanan', [5, 6])
      ->where('pa1.nama_pack', 'personal')
      ->where('jm1.tanggal_menu = jm.tanggal_menu', null, false)
      ->groupBy('jm1.tanggal_menu');

    $builder = $this->db->table('pesanan AS p');
    $builder->select("
            mp.id_menu_pesanan,
            jm.tanggal_menu, 
            o.biaya_ongkir,
            SUM(dmp.qty_menu) AS qty_menu, 
            SUM(dmp.qty_infuse) AS qty_infuse,
            SUM(
                COALESCE(dmp.qty_menu, dmp.qty_infuse, 0) * 
                COALESCE(m.harga_menu, pm.harga_paket_menu, 0) + 
                COALESCE(dmp.qty_infuse, 0) * 10000
            ) AS total_harga,
            ({$subQueryJumlahFamily->getCompiledSelect(false)}) AS jumlah_family,
            ({$subQueryJumlahPersonal->getCompiledSelect(false)}) AS jumlah_personal
        ");
    $builder->join('akun AS a', 'p.id_akun = a.id_akun', 'left');
    $builder->join('pelanggan AS pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi AS t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir AS o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('menu_pesanan AS mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu AS jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan AS dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan AS sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu AS djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu AS m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('paket_menu AS pm', 'pm.id_paket_menu = m.id_paket_menu', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
      $builder->where('jm.tanggal_menu >=', $tanggalAwal);
      $builder->where('jm.tanggal_menu <=', $tanggalAkhir);
    }
    $builder->groupBy('jm.tanggal_menu');
    $builder->orderBy('jm.tanggal_menu', 'DESC');
    $query = $builder->get();
    return $query;
  }

  public function getPelangganWithSisaJadwal()
  {
    $subQueryJumlahTunda = $this->db->table('tunda_pesanan')
      ->select('COUNT(*)')
      ->where('id_pesanan = p.id_pesanan')
      ->groupBy('id_pesanan')
      ->getCompiledSelect();

    $subQueryMenuTerjadwal = $this->db->table('menu_pesanan mp')
      ->select('COUNT(*)')
      ->join('tunda_pesanan tp', 'tp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->where('tp.id_tunda_pesanan IS NULL')
      ->where('mp.id_pesanan = p.id_pesanan')
      ->groupBy('tp.id_tunda_pesanan')
      ->getCompiledSelect();

    $builder = $this->db->table('pesanan p')
      ->select('
            p.id_pesanan, p.id_akun, pel.nama_pelanggan, 
            cp.periode_hari_paketan, cp.periode_hari_baru, 
            cp.id_karbo, cp.pantangan_paketan')
      ->select("({$subQueryJumlahTunda}) AS jumlah_tunda", false)
      ->select("({$subQueryMenuTerjadwal}) AS jumlah_tunda", false)
      ->select("(COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) - ({$subQueryMenuTerjadwal})) AS sisa_jadwal", false)
      ->join('catatan_pesanan cp', 'cp.id_catatan_pesanan = p.id_catatan_pesanan')
      ->join('akun a', 'a.id_akun = p.id_akun')
      ->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan')
      ->where('p.berhenti_paketan IS NULL')
      ->where("(COALESCE(cp.periode_hari_baru, cp.periode_hari_paketan) - ({$subQueryMenuTerjadwal}))", " > 0 ", false);
    $query = $builder->get();
    return $query;
  }

  public function getDataLaporanBulan()
  {
    $builder = $this->db->table('pesanan p')
      ->select('jm.tanggal_menu, DATE_FORMAT(jm.tanggal_menu, "%Y-%m") AS bulan_tahun');

    // Subquery untuk total_harga_family
    $subqueryFamily = $this->db->table('pesanan p')
      ->select('COALESCE(SUM(dmp.qty_menu), SUM(dmp.qty_infuse)) * COALESCE(SUM(m.harga_menu), SUM(pm.harga_paket_menu), 10000)', false)
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('pack pa', 'pa.id_pack = m.id_pack', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('sdmp.id_status_pesanan IN (5,6)')
      ->where('pa.nama_pack', 'family')
      ->where('DATE_FORMAT(jm.tanggal_menu, "%Y-%m") = bulan_tahun')
      ->groupBy('m.nama_menu');
    $builder->selectSubquery($subqueryFamily, 'total_harga_family');

    // Subquery untuk total_harga_personal
    $subqueryPersonal = $this->db->table('pesanan p')
      ->select('COALESCE(SUM(dmp.qty_menu), SUM(dmp.qty_infuse)) * COALESCE(SUM(m.harga_menu), SUM(pm.harga_paket_menu), 10000)', false)
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('pack pa', 'pa.id_pack = m.id_pack', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('sdmp.id_status_pesanan IN (5,6)')
      ->where('pa.nama_pack', 'personal')
      ->where('DATE_FORMAT(jm.tanggal_menu, "%Y-%m") = bulan_tahun')
      ->groupBy('DATE_FORMAT(jm.tanggal_menu, "%Y-%m")');
    $builder->selectSubquery($subqueryPersonal, 'total_harga_personal');

    // Subquery untuk total jumlah personal
    $subQueryJumlahPersonal = $this->db->table('pesanan AS p')
      ->select('SUM(dmp.qty_menu)')
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('pack pa', 'pa.id_pack = m.id_pack', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('sdmp.id_status_pesanan IN (5,6)')
      ->where('pa.nama_pack', 'personal')
      ->where('DATE_FORMAT(jm.tanggal_menu, "%Y-%m") = bulan_tahun')
      ->groupBy('DATE_FORMAT(jm.tanggal_menu, "%Y-%m")');
    $builder->selectSubquery($subQueryJumlahPersonal, 'total_jumlah_personal');

    // Subquery untuk total jumlah family
    $subQueryJumlahPersonal = $this->db->table('pesanan AS p')
      ->select('SUM(dmp.qty_menu)')
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('pack pa', 'pa.id_pack = m.id_pack', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('sdmp.id_status_pesanan IN (5,6)')
      ->where('pa.nama_pack', 'family')
      ->where('DATE_FORMAT(jm.tanggal_menu, "%Y-%m") = bulan_tahun')
      ->groupBy('DATE_FORMAT(jm.tanggal_menu, "%Y-%m")');
    $builder->selectSubquery($subQueryJumlahPersonal, 'total_jumlah_family');

    // Subquery untuk total_harga_infuse
    $subqueryInfuse = $this->db->table('pesanan p')
      ->select('COALESCE(SUM(dmp.qty_menu), SUM(dmp.qty_infuse)) * COALESCE(SUM(m.harga_menu), SUM(pm.harga_paket_menu), 10000)', false)
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left')
      ->join('menu m', 'm.id_menu = djm.id_menu', 'left')
      ->join('paket_menu pm', 'pm.id_paket_menu = m.id_paket_menu', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->where('sdmp.id_status_pesanan IN (5,6)')
      ->where('m.nama_menu IS NULL')
      ->groupBy('m.nama_menu')
      ->orderBy('p.id_akun', 'ASC');
    $builder->selectSubquery($subqueryInfuse, 'total_harga_infuse');

    // Join tabel utama
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->groupBy('bulan_tahun');
    $query = $builder->get();
    return $query;
  }

  public function getTotalHargaOngkirBulan()
  {
    $builder = $this->db->table('pesanan p')
      ->select('jm.tanggal_menu, DATE_FORMAT(jm.tanggal_menu, "%Y-%m") AS bulan_tahun, p.id_akun, o.biaya_ongkir')
      ->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left')
      ->join('ongkir o', 'o.id_ongkir = t.id_ongkir', 'left')
      ->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left')
      ->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left')
      ->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left')
      ->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left')
      ->whereIn('sdmp.id_status_pesanan', [5, 6])  // Menggunakan whereIn untuk filter status pesanan
      ->groupBy(['jm.tanggal_menu', 'p.id_akun'])
      ->orderBy('p.id_akun', 'ASC')
      ->orderBy('jm.tanggal_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }

  public function getJumlahPemesananPelanggan()
  {
    $builder = $this->db->table('pesanan p');
    $builder->select('p.id_akun, pel.nama_pelanggan, COUNT(DISTINCT jm.tanggal_menu) AS jumlah_pemesanan');
    $builder->join('akun a', 'a.id_akun = p.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->groupBy('pel.nama_pelanggan');
    $query = $builder->get();
    return $query;
  }

  public function getDataPemesananPelanggan($idAkun)
  {
    $builder = $this->db->table('pesanan p');
    $builder->select(
      "DATE_FORMAT(jm.tanggal_menu, '%Y-%m') AS bulan_tahun, jm.tanggal_menu, COUNT(DISTINCT jm.tanggal_menu) as jumlah_pemesanan"
    );
    $builder->join('akun a', 'a.id_akun = p.id_akun', 'left');
    $builder->join('pelanggan pel', 'pel.id_pelanggan = a.id_pelanggan', 'left');
    $builder->join('transaksi t', 't.id_pesanan = p.id_pesanan', 'left');
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->where('p.id_akun', $idAkun);
    $builder->groupBy('bulan_tahun');
    $builder->orderBy('bulan_tahun', 'DESC');
    $query = $builder->get();
    return $query;
  }

  public function getJumlahPesananDataMenu()
  {
    $builder = $this->db->table('pesanan p');
    $builder->select("m.nama_menu, SUM(dmp.qty_menu) AS qty_menu, SUM(dmp.qty_infuse) AS qty_infuse");
    $builder->join('menu_pesanan mp', 'mp.id_pesanan = p.id_pesanan', 'left');
    $builder->join('jadwal_menu jm', 'jm.id_jadwal_menu = mp.id_jadwal_menu', 'left');
    $builder->join('detail_menu_pesanan dmp', 'dmp.id_menu_pesanan = mp.id_menu_pesanan', 'left');
    $builder->join('detail_jadwal_menu djm', 'djm.id_detail_jadwal_menu = dmp.id_detail_jadwal_menu', 'left');
    $builder->join('menu m', 'm.id_menu = djm.id_menu', 'left');
    $builder->join('status_detail_menu_pesanan sdmp', 'sdmp.id_detail_menu_pesanan = dmp.id_detail_menu_pesanan', 'left');
    $builder->whereIn('sdmp.id_status_pesanan', [5, 6]);
    $builder->groupBy('m.nama_menu');
    $builder->orderBy('m.nama_menu', 'ASC');
    $query = $builder->get();
    return $query;
  }
}
