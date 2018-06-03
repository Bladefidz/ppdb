<?php
// Directory separator is set up here because separators are different on Linux and Windows operating systems
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__FILE__));
define('CONF_PATH', ROOT_DIR.'/config');
define('DEVELOPMENT_ENVIRONMENT', true);

// Import Bootstrap to load configuration and requirements
require_once ROOT_DIR.'/simplex/core/Bootstrap.php';

// Call Route class via namespace
use Core\Router;

// Define routes
// Router::get('login', 'Controllers\User@displayLogin');
Router::any('login', 'Controllers\User@login');
Router::get('logout', 'Controllers\User@logout');
Router::get('pendaftaran', 'Controllers\Pendaftaran@index');
Router::any('pendaftaran/verifikasi', 'Controllers\Pendaftaran@verifikasi');
Router::get('pendaftaran/prestasi/(:any)', 'Controllers\Pendaftaran@prestasi');
Router::post('pendaftaran/daftar', 'Controllers\Pendaftaran@daftar');
Router::get('pendaftaran/gelombang/(:num)', 'Controllers\Pendaftaran@gelombang');
Router::get('pendaftaran/kota/(:any)', 'Controllers\Pendaftaran@kota');
Router::get('pendaftaran/kecamatan/(:any)/(:any)', 'Controllers\Pendaftaran@kecamatan');
Router::get('pendaftaran/kelurahan/(:any)/(:any)/(:any)', 'Controllers\Pendaftaran@kelurahan');
// Router::get('pendaftaran/data/(:num)', 'Controllers\Pendaftaran@data');
Router::get('pendaftaran/data/(:any)', 'Controllers\Pendaftaran@data');
Router::post('pendaftaran/edit', 'Controllers\Pendaftaran@edit');
Router::get('pendaftaran/delete/(:num)/(:num)', 'Controllers\Pendaftaran@delete');
Router::any('pendaftaran/cetak/(:num)/(:num)', 'Controllers\Pendaftaran@cetak');
Router::get('tes', 'Controllers\Tes@index');
Router::get('tes/data/(:num)', 'Controllers\Tes@data');
Router::any('tes/update/(:num)', 'Controllers\Tes@update');
Router::get('seleksi', 'Controllers\Seleksi@index');
Router::get('seleksi/proses/(:num)', 'Controllers\Seleksi@proses');
Router::any('seleksi/keputusan/(:num)/(:num)/(:num)', 'Controllers\Seleksi@keputusan');
Router::get('seleksi/data', 'Controllers\Seleksi@data');
Router::get('seleksi/hasil/(:num)', 'Controllers\Seleksi@hasil');
Router::get('setting', 'Controllers\Setting@index');
Router::get('setting/tahun', 'Controllers\Setting@tahun');
Router::any('setting/tahun/add', 'Controllers\Setting@addTahun');
Router::any('setting/tahun/update/(:num)', 'Controllers\Setting@updateTahun');
Router::get('setting/gelombang', 'Controllers\Setting@gelombang');
Router::any('setting/gelombang/add', 'Controllers\Setting@addGelombang');
Router::any('setting/gelombang/update/(:num)', 'Controllers\Setting@updateGelombang');
Router::get('setting/gelombang/delete/(:num)', 'Controllers\Setting@deleteGelombang');
Router::get('setting/jalur', 'Controllers\Setting@jalur');
Router::any('setting/jalur/add', 'Controllers\Setting@addJalur');
Router::post('setting/jalur/update', 'Controllers\Setting@updateJalur');
Router::get('setting/pagu', 'Controllers\Setting@pagu');
Router::any('setting/pagu/add', 'Controllers\Setting@addPagu');
Router::any('setting/pagu/update/(:num)', 'Controllers\Setting@updatePagu');
Router::get('setting/pagu/delete/(:num)', 'Controllers\Setting@deletePagu');
Router::any('setting/pedoman', 'Controllers\Setting@pedoman');
Router::any('setting/alur', 'Controllers\Setting@alur');
Router::get('setting/kontak', 'Controllers\Setting@kontak');
Router::any('setting/kontak/add', 'Controllers\Setting@addKontak');
Router::any('setting/kontak/update/(:num)', 'Controllers\Setting@updateKontak');
Router::get('setting/kontak/delete/(:num)', 'Controllers\Setting@deleteKontak');
Router::any('setting/pengguna', 'Controllers\Setting@pengguna');
Router::any('setting/pengguna/add', 'Controllers\Setting@addPengguna');
Router::any('setting/pengguna/update/(:num)', 'Controllers\Setting@updatePengguna');
Router::get('setting/pengguna/delete/(:num)', 'Controllers\Setting@deletePengguna');

// Testing mode
// Router::get('testing/ceknisn/(:num)/(:num)/(:num)', 'Controllers\Testing@testWasVerified');
// Router::get('testing/insert/(:num)/(:any)', 'Controllers\Testing@insert');
// Router::get('testing/verify', 'Controllers\Testing@verify');
Router::get('testing/test', 'Controllers\Testing@test');
Router::get('testing/segment', 'Controllers\Testing@testUriSegment');

// if no route found
Router::error('Core\Error@index');

// Turn on old style routing
Router::$fallback = false;

// execute matched routes
Router::dispatch();
