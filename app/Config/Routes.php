<?php
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('register', 'AccountController::register');
$routes->get('register/admin', 'AccountController::registerAdmin');
$routes->post('register/process', 'AccountController::registerProcess');
$routes->post('login/process', 'AccountController::loginProcess');
$routes->get('logout', 'AccountController::logout');
$routes->get('dpr-data', 'Dpr::view_dpr', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('users', 'AdminController::usersList');
    $routes->get('users/new', 'AdminController::userNew');
    $routes->post('users/create', 'AdminController::userCreate');
    $routes->get('users/edit/(:num)', 'AdminController::userEdit/$1');
    $routes->post('users/update/(:num)', 'AdminController::userUpdate/$1');
    $routes->get('users/delete/(:num)', 'AdminController::userDelete/$1');

    $routes->get('anggota', 'AdminController::anggotaList');
    $routes->get('anggota/new', 'AdminController::anggotaNew');
    $routes->post('anggota/create', 'AdminController::anggotaCreate');
    $routes->get('anggota/edit/(:num)', 'AdminController::anggotaEdit/$1');
    $routes->post('anggota/update/(:num)', 'AdminController::anggotaUpdate/$1');
    $routes->get('anggota/delete/(:num)', 'AdminController::anggotaDelete/$1');

    $routes->get('anggota/gaji/(:num)', 'AdminController::anggotaGaji/$1');
    $routes->post('anggota/gaji/add/(:num)', 'AdminController::anggotaGajiAdd/$1');
    $routes->get('anggota/gaji/remove/(:num)/(:num)', 'AdminController::anggotaGajiRemove/$1/$2');

    $routes->get('komponen', 'AdminController::komponenList');
    $routes->get('komponen/new', 'AdminController::komponenNew');
    $routes->post('komponen/create', 'AdminController::komponenCreate');
    $routes->get('komponen/edit/(:num)', 'AdminController::komponenEdit/$1');
    $routes->post('komponen/update/(:num)', 'AdminController::komponenUpdate/$1');
    $routes->get('komponen/delete/(:num)', 'AdminController::komponenDelete/$1');
    $routes->get('komponen/edit/(:num)', 'AdminController::komponenEdit/$1');
    $routes->post('komponen/update/(:num)', 'AdminController::komponenUpdate/$1');
});

$routes->setAutoRoute(false);