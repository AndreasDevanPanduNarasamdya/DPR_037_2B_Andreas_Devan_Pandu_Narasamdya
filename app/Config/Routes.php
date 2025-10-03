<?php
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

$routes->get('register', 'AccountController::register');
$routes->get('register-admin', 'AccountController::registerAdmin');
$routes->post('register/process', 'AccountController::registerProcess');
$routes->post('login/process', 'AccountController::loginProcess');
$routes->get('logout', 'AccountController::logout');

$routes->get('dpr-data', 'Dpr::view_dpr', ['filter' => 'auth']);

$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('users', 'AdminController::usersList');
    $routes->get('users/new', 'AdminController::userNew');
    $routes->post('users/create', 'AccountController::userCreate'); // Corrected to AccountController if that's where the logic is
    $routes->get('users/delete/(:num)', 'AdminController::userDelete/$1');
    $routes->get('anggota', 'AdminController::anggotaList');
    $routes->get('anggota/delete/(:num)', 'AdminController::anggotaDelete/$1');
});

$routes->setAutoRoute(false);