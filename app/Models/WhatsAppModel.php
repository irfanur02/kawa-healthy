<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Config\WhatsApp;

class WhatsAppModel extends Model
{
  protected $config;

  public function __construct()
  {
    parent::__construct();
    $this->config = new WhatsApp();
  }

  public function sendWhatsAppMessage($to, $message)
  {
    $url = $this->config->apiUrl . $this->config->phoneNumberId . "/messages";
    $token = $this->config->accessToken;

    $data = [
      "messaging_product" => "whatsapp",
      "to" => $to, // Nomor tujuan dengan format internasional, contoh: 6281234567890
      "type" => "text",
      "text" => ["body" => $message]
    ];

    $headers = [
      "Authorization: Bearer $token",
      "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
  }
}
