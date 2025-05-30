<?php

if (!function_exists('formatTanggal')) {
  function formatTanggal($date, $hanyaTanggal = false, $hanyaBulan = false, $standart = false)
  {
    // Daftar hari dan bulan dalam bahasa Indonesia
    $hari = [
      'Sunday'    => 'Minggu',
      'Monday'    => 'Senin',
      'Tuesday'   => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday'  => 'Kamis',
      'Friday'    => 'Jumat',
      'Saturday'  => 'Sabtu'
    ];

    $bulan = [
      1  => 'Januari',
      2  => 'Februari',
      3  => 'Maret',
      4  => 'April',
      5  => 'Mei',
      6  => 'Juni',
      7  => 'Juli',
      8  => 'Agustus',
      9  => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    ];

    // Mengubah string tanggal menjadi objek DateTime
    $tanggal = new DateTime($date);

    // Format hari dan tanggal
    $hariDalamBahasa = $hari[$tanggal->format('l')];
    $tanggalIndo = $tanggal->format('j');
    $bulanDalamBahasa = $bulan[(int)$tanggal->format('n')];
    $tahun = $tanggal->format('Y');

    // Menggabungkan format yang diinginkan
    if ($hanyaTanggal) {
      return $tanggalIndo;
    } elseif ($hanyaBulan) {
      return $bulanDalamBahasa;
    } elseif ($standart) {
      return $tanggalIndo . ' ' . $bulanDalamBahasa . ' ' . $tahun;
    } else {
      return $hariDalamBahasa . ', ' . $tanggalIndo . ' ' . $bulanDalamBahasa;
    }
  }
}

if (!function_exists('formatRupiah')) {
  function formatRupiah($angka)
  {
    return "Rp. " . number_format($angka, 0, ',', '.');
  }
}

if (!function_exists('setSession')) {
  function setSession($session, $idAkun)
  {
    $loginAkun = [
      'id_akun' => $idAkun,
      'logged_in' => true,
    ];

    $session->set($loginAkun);
  }
}

if (!function_exists('cekSession')) {
  function cekSession($session)
  {
    if ($session->get('logged_in')) {
      return true;
    } else {
      return false;
    }
  }
}

if (!function_exists('kirim_email')) {
  function kirim_email($to, $fromEmail, $fromName, $subject, $message)
  {
    $email = \Config\Services::email();
    $email->setFrom($fromEmail, $fromName);
    $email->setTo($to);
    $email->setSubject($subject);
    $email->setMessage($message);

    return $email->send();
  }
}