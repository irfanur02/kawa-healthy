<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalMenu extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Kelola Jadwal Menu',
      'sidebar' => 'kelolaJadwalMenu'
    ];
    return view('admin/jadwalMenu', $data);
  }

  public function createMenuFamily()
  {
    $data = [
      'title' => 'Buat Jadwal Family Pack',
      'sidebar' => 'kelolaJadwalMenu'
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function createMenuPersonal()
  {
    $data = [
      'title' => 'Buat Jadwal Personal Pack',
      'sidebar' => 'kelolaJadwalMenu'
    ];
    return view('admin/jadwalMenuPersonal', $data);
  }

  public function updateMenuFamily($id = '')
  {
    // $id
    $data = [
      'title' => 'Edit Jadwal Family Pack',
      'sidebar' => 'kelolaJadwalMenu'
    ];
    return view('admin/jadwalMenuFamily', $data);
  }

  public function updateMenuPersonal($id = '')
  {
    // $id
    $data = [
      'title' => 'Edit Jadwal Personal Pack',
      'sidebar' => 'kelolaJadwalMenu'
    ];
    return view('admin/jadwalMenuPersonal', $data);
  }
}
