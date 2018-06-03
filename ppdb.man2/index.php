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
Router::any('login', 'Controllers\PPDBOnline@login');
Router::get('logout', 'Controllers\PPDBOnline@logout');
Router::any('ppdbonline/daftar', 'Controllers\PPDBOnline@daftar');
Router::get('ppdbonline/kota/(:any)', 'Controllers\PPDBOnline@Kota');
Router::get('ppdbonline/kecamatan/(:any)/(:any)', 'Controllers\PPDBOnline@Kecamatan');
Router::get('ppdbonline/kelurahan/(:any)/(:any)/(:any)', 'Controllers\PPDBOnline@Kelurahan');
Router::get('ppdbonline/cetak', 'Controllers\PPDBOnline@cetak');
Router::any('pengumuman', 'Controllers\PPDBOnline@pengumuman');
Router::get('pantau', 'Controllers\PPDBOnline@pantau');
Router::any('pedoman', 'Controllers\Info@showPedoman');
Router::any('alur', 'Controllers\Info@showAlur');
Router::any('jadwal', 'Controllers\Jadwal@getJadwal');
Router::any('kontak', 'Controllers\Contact@getContact');

// if no route found
Router::error('Core\Error@index');

// Turn on old style routing
Router::$fallback = false;

// execute matched routes
Router::dispatch();
