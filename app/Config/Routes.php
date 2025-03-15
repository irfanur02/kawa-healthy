<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ROUTES ADMIN
// login
$routes->get('/dadmin', 'Admin\Auth::index');
$routes->post('/dadmin/authLogin', 'Admin\Auth::authLogin');

// pesanan
$routes->get('/dadmin/dashboard', 'Admin\Dashboard::index');
$routes->get('/dadmin/pesanan', 'Admin\Pesanan::pesananPembayaran');
$routes->post('/dadmin/pesanan/approved', 'Admin\Pesanan::pesananApproved');
$routes->post('/dadmin/pesanan/notApproved', 'Admin\Pesanan::pesananNotApproved');
$routes->post('/dadmin/pesanan/detailPembayaran', 'Admin\Pesanan::pesananDetailPembayaran');
$routes->post('/dadmin/pesanan/kembalikanUang', 'Admin\Pesanan::kembalikanUangPesanan');
$routes->post('/dadmin/pesanan/kirim', 'Admin\Pesanan::kirimPesanan');
$routes->get('/dadmin/pesanan/(:any)', 'Admin\Pesanan::pesananDetail/$1');
$routes->get('/dadmin/pesananMasuk', 'Admin\Pesanan::pesananMasuk');
$routes->get('/dadmin/pesananPembayaran', 'Admin\Pesanan::pesananPembayaran');
$routes->get('/dadmin/pesananBatal', 'Admin\Pesanan::pesananBatal');
$routes->get('/dadmin/pesananRiwayat', 'Admin\Pesanan::pesananRiwayat');

// review
$routes->get('/dadmin/review', 'Admin\Review::index');

// menu
$routes->get('/dadmin/menu', 'Admin\Menu::index');
$routes->post('/dadmin/menu/halaman/(:num)', 'Admin\Menu::pageMenu/$1');
$routes->get('/dadmin/createMenu', 'Admin\Menu::createMenu');
$routes->get('/dadmin/menu/edit/(:num)', 'Admin\Menu::editMenu/$1');
$routes->post('/dadmin/menu/save', 'Admin\Menu::save');
$routes->post('/dadmin/menu/update/', 'Admin\Menu::update');
$routes->post('/dadmin/menu/delete/(:num)', 'Admin\Menu::delete/$1');
$routes->post('/dadmin/menu/cari', 'Admin\Menu::cari');
$routes->post('/dadmin/menu/getDetailPencarian/(:any)', 'Admin\Menu::getDetailPencarian/$1');

// paket menu
$routes->get('/dadmin/paketMenu', 'Admin\PaketMenu::index');
$routes->post('/dadmin/paketMenu/save', 'Admin\PaketMenu::save');
$routes->post('/dadmin/paketMenu/update/(:num)', 'Admin\PaketMenu::update/$1');
$routes->post('/dadmin/paketMenu/delete/(:num)', 'Admin\PaketMenu::delete/$1');
$routes->post('/dadmin/paketMenu/cari/', 'Admin\PaketMenu::cari');
$routes->post('/dadmin/paketMenu/getDetailPencarian/(:any)', 'Admin\PaketMenu::getDetailPencarian/$1');

// jadwal Menu
$routes->get('/dadmin/jadwal', 'Admin\Jadwal::index');
$routes->post('/dadmin/jadwal/viewJadwal', 'Admin\Jadwal::viewJadwal');
$routes->get('/dadmin/jadwal/family', 'Admin\Jadwal::createMenuFamily');
$routes->get('/dadmin/jadwal/personal', 'Admin\Jadwal::createMenuPersonal');
$routes->post('/dadmin/jadwal/cariMenu', 'Admin\Jadwal::cariMenu');
$routes->post('/dadmin/jadwal/save/family', 'Admin\Jadwal::saveJadwalFamily');
$routes->post('/dadmin/jadwal/save/personal', 'Admin\Jadwal::saveJadwalPersonal');
$routes->post('/dadmin/jadwal/update/family', 'Admin\Jadwal::updateJadwalFamily');
$routes->post('/dadmin/jadwal/update/personal', 'Admin\Jadwal::updateJadwalPersonal');
$routes->get('/dadmin/jadwal/(:num)/family', 'Admin\Jadwal::editMenuFamily/$1');
$routes->get('/dadmin/jadwal/(:num)/personal', 'Admin\Jadwal::editMenuPersonal/$1');

// ongkir
$routes->get('/dadmin/biayaOngkir', 'Admin\BiayaOngkir::index');
$routes->post('/dadmin/biayaOngkir/getAllOngkir', 'Admin\BiayaOngkir::getAllOngkir');
$routes->post('/dadmin/biayaOngkir/save', 'Admin\biayaOngkir::save');
$routes->post('/dadmin/biayaOngkir/update/(:num)', 'Admin\BiayaOngkir::update/$1');
$routes->post('/dadmin/biayaOngkir/delete/(:num)', 'Admin\BiayaOngkir::delete/$1');
$routes->post('/dadmin/biayaOngkir/cari/', 'Admin\BiayaOngkir::cari');
$routes->post('/dadmin/biayaOngkir/getDetailPencarian/(:any)', 'Admin\BiayaOngkir::getDetailPencarian/$1');

// laporan
$routes->get('/dadmin/laporan', 'Admin\Laporan::index'); // banar
// $routes->get('/dadmin/laporan', 'Admin\Laporan::laporanByPelanggan'); // tes
$routes->post('/dadmin/laporanByPeriode', 'Admin\Laporan::laporanByPeriode');
$routes->post('/dadmin/laporanByBulan', 'Admin\Laporan::laporanByBulan');
$routes->post('/dadmin/laporanByPelanggan', 'Admin\Laporan::laporanByPelanggan');
$routes->post('/dadmin/laporanByDetailPelanggan', 'Admin\Laporan::laporanByDetailPelanggan');
$routes->post('/dadmin/laporanByMenu', 'Admin\Laporan::laporanByMenu');
// ROUTES ADMIN
#
#
#
#
#
// ROUTES USER
// homepage
// $routes->get('/daftar', 'Daftar::index');
$routes->get('/', 'Homepage::index');

// auth
$routes->post('/authLogin', 'AuthUser::login');
$routes->post('/authLogout', 'AuthUser::logout');
$routes->post('/cekUsername', 'AuthUser::cekUsername');
$routes->post('/cekEmail', 'AuthUser::cekEmail');

// profil
$routes->post('/profil/getProfil', 'Profil::getProfil');
$routes->post('/profil/update', 'Profil::update');

// daftar akun
$routes->get('/daftarAkun', 'Daftar::index');
$routes->post('/daftarAkun/save', 'Daftar::save');


$routes->post('/tambahDaftarPesanan', 'Pesanan::tambahDaftarPesanan');
$routes->get('/daftarPesanan', 'Pesanan::daftarPesanan');
$routes->post('/daftarPesanan/hapusMenu', 'Pesanan::hapusMenuPesanan');
// $routes->get('/daftarPesanan', 'Pesanan::bayarPesanan'); //tes
$routes->post('/pesanan/terima', 'Pesanan::terimaPesanan');
$routes->post('/pesanan/bayar', 'Pesanan::bayarPesanan');
$routes->post('/pesanan/batal', 'Pesanan::batalPesanan');
$routes->post('/pesanan/berhentiPaketan', 'Pesanan::berhentiPaketan');
$routes->post('/pesanan/gantiMasaHariPaketan', 'Pesanan::gantiMasaHariPaketan');
$routes->post('/pesanan/tundaPesanan', 'Pesanan::tundaPesanan');
$routes->post('/pesananPaketan/bayar', 'Pesanan::bayarPesananPaketan');

$routes->post('/review/reviewPesanan', 'Review::reviewPesanan');

$routes->get('/pesananKu', 'Pesanan::pesananku');
$routes->get('/pesananDetailPaketan/(:num)', 'Pesanan::detailPesananPaketan/$1');
$routes->get('/pesananDetailBiasa/(:num)/(:num)', 'Pesanan::detailPesananBiasa/$1/$2');
$routes->get('/pesananDetailBiasa/selesai/(:num)/(:num)', 'Pesanan::detailPesananBiasaSelesai/$1/$2');
$routes->get('/pesananDatang', 'Pesanan::pesananDatang');
$routes->get('/pesananSelesai', 'Pesanan::pesananSelesai');
// ROUTES USER