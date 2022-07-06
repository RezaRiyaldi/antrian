<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Auth
$routes->get('admin/login', 'Auth::login');
$routes->post('login', 'Auth::process_login');
$routes->get('admin/register', 'Auth::register');
$routes->post('register', 'Auth::process_register');
$routes->get('admin/logout', 'Auth::logout');

// Pelayanan
$routes->get('pelayanan', 'Pelayanan::index');
$routes->get('pelayanan/tambah', 'Pelayanan::tambah_pelayanan');
$routes->post('tambah-pelayanan', 'Pelayanan::proses_tambah_pelayanan');

$routes->get('pelayanan/ubah/(:num)', 'Pelayanan::edit_pelayanan/$1');
$routes->post('ubah-pelayanan/(:num)', 'Pelayanan::proses_edit_pelayanan/$1');

$routes->get('pelayanan/hapus/(:num)', 'Pelayanan::delete_pelayanan/$1');

// Loket
$routes->get('loket', 'Loket::index');
$routes->get('loket/detail/(:num)/(:num)', 'Loket::detail_loket/$1/$2');
$routes->get('loket/tambah', 'Loket::tambah_loket');

$routes->post('tambah-loket', 'Loket::proses_tambah_loket');

$routes->get('loket/ubah/(:num)', 'Loket::edit_loket/$1');
$routes->post('ubah-loket/(:num)', 'Loket::proses_edit_loket/$1');

$routes->get('loket/hapus/(:num)', 'Loket::delete_loket/$1');

// Antrian
$routes->get('antrian', 'Antrian::index');
$routes->get('antrian/get/(:num)/(:num)', 'Antrian::ambil_antrian/$1/$2');

$routes->get('antrian/panggil/(:num)', 'Antrian::panggil/$1');
$routes->get('antrian/selesai/(:num)', 'Antrian::selesai/$1');
$routes->get('antrian/selesai-danger', 'Antrian::selesai_paksa');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
