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
$routes->get('/dadmin/pesanan', 'Admin\Pesanan::index');
$routes->get('/dadmin/pesananDetail', 'Admin\Pesanan::pesananDetail');
$routes->get('/dadmin/pesananBatal', 'Admin\Pesanan::pesananBatal');
$routes->get('/dadmin/pesananRiwayat', 'Admin\Pesanan::pesananRiwayat');

// review
$routes->get('/dadmin/review', 'Admin\Review::index');

// menu
$routes->get('/dadmin/menu', 'Admin\Menu::index');
$routes->get('/dadmin/createMenu', 'Admin\Menu::createMenu');
$routes->get('/dadmin/menu/edit/(:num)', 'Admin\Menu::editMenu/$1');
$routes->post('/dadmin/menu/save', 'Admin\Menu::save');
$routes->post('/dadmin/menu/update/(:num)', 'Admin\Menu::update/$1');
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
$routes->get('/dadmin/jadwal/(:num)/family', 'Admin\Jadwal::editMenuFamily/$1');
$routes->get('/dadmin/jadwal/(:num)/personal', 'Admin\Jadwal::editMenuPersonal/$1');

// ongkir
$routes->get('/dadmin/biayaOngkir', 'Admin\BiayaOngkir::index');
$routes->post('/dadmin/biayaOngkir/save', 'Admin\biayaOngkir::save');
$routes->post('/dadmin/biayaOngkir/update/(:num)', 'Admin\biayaOngkir::update/$1');
$routes->post('/dadmin/biayaOngkir/delete/(:num)', 'Admin\biayaOngkir::delete/$1');
$routes->post('/dadmin/biayaOngkir/cari/', 'Admin\biayaOngkir::cari');
$routes->post('/dadmin/biayaOngkir/getDetailPencarian/(:any)', 'Admin\biayaOngkir::getDetailPencarian/$1');

// laporan
$routes->get('/dadmin/laporan', 'Admin\Laporan::index');
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

// profil
$routes->post('/profil/getProfil', 'Profil::getProfil');
$routes->post('/profil/update', 'Profil::update');

// daftar akun
$routes->get('/daftarAkun', 'Daftar::index');
$routes->post('/daftarAkun/save', 'Daftar::save');


$routes->get('/daftarPesanan', 'Pesanan::daftarPesanan');
$routes->get('/pesananKu', 'Pesanan::pesananku');
$routes->get('/pesananDetailPaketan/(:num)', 'Pesanan::detailPesananPaketan/$1');
$routes->get('/pesananDetailBiasa/(:num)', 'Pesanan::detailPesananBiasa/$1');
$routes->get('/pesananDatang', 'Pesanan::pesananDatang');
$routes->get('/pesananSelesai', 'Pesanan::pesananSelesai');
// ROUTES USER