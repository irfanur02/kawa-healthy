<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// ROUTES ADMIN
$routes->get('/dadmin', 'Admin\Auth::index'); 
$routes->get('/dadmin/dashboard', 'Admin\Dashboard::index'); 
$routes->get('/dadmin/pesanan', 'Admin\Pesanan::index'); 
$routes->get('/dadmin/pesananDetail', 'Admin\Pesanan::pesananDetail'); 
$routes->get('/dadmin/pesananBatal', 'Admin\Pesanan::pesananBatal'); 
$routes->get('/dadmin/pesananRiwayat', 'Admin\Pesanan::pesananRiwayat'); 
$routes->get('/dadmin/review', 'Admin\Review::index'); 
$routes->get('/dadmin/menu', 'Admin\Menu::index'); 
$routes->get('/dadmin/createMenu', 'Admin\Menu::createMenu'); 
$routes->get('/dadmin/updateMenu/(:num)', 'Admin\Menu::updateMenu/$1'); 
$routes->get('/dadmin/paketMenu', 'Admin\PaketMenu::index'); 
$routes->get('/dadmin/jadwalMenu', 'Admin\JadwalMenu::index'); 
$routes->get('/dadmin/jadwalMenu/family', 'Admin\JadwalMenu::createMenuFamily'); 
$routes->get('/dadmin/jadwalMenu/personal', 'Admin\JadwalMenu::createMenuPersonal'); 
$routes->get('/dadmin/jadwalMenu/(:num)/family', 'Admin\JadwalMenu::updateMenuFamily/$1'); 
$routes->get('/dadmin/jadwalMenu/(:num)/personal', 'Admin\JadwalMenu::updateMenuPersonal/$1'); 
$routes->get('/dadmin/biayaOngkir', 'Admin\BiayaOngkir::index'); 
$routes->get('/dadmin/laporan', 'Admin\Laporan::index'); 
// ROUTES ADMIN


// ROUTES USER
$routes->get('/daftar', 'Daftar::index');
$routes->get('/', 'Homepage::index');
$routes->get('/daftarPesanan', 'Pesanan::daftarPesanan');
$routes->get('/pesananKu', 'Pesanan::pesananku');
$routes->get('/pesananDetailPaketan/(:num)', 'Pesanan::detailPesananPaketan/$1');
$routes->get('/pesananDetailBiasa/(:num)', 'Pesanan::detailPesananBiasa/$1');
$routes->get('/pesananDatang', 'Pesanan::pesananDatang');
$routes->get('/pesananSelesai', 'Pesanan::pesananSelesai');
// ROUTES USER