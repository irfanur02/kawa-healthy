<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PackModel;

class Pack extends BaseController
{

  protected $packModel;

  public function __construct()
  {
    $this->packModel = new PackModel();
  }

  public function getPackById($id = '')
  {
    $data = $this->packModel->getPackById($id);
    dd($data);
    return $data;
  }

  public function getAllPack()
  {
    $data = $this->packModel->getAllPack()->getResultArray();
    return $data;
  }
}
