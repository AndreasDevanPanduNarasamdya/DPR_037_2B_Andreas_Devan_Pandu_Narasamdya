<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Public Routes ---
$routes->get('/', 'Home::index'); // Login page
$routes->post('login/process', 'AccountController::loginProcess');
$routes->get('logout', 'AccountController::logout');
$routes->get('register', 'AccountController::register');
$routes->get('register/admin', 'AccountController::registerAdmin'); // Corrected from your previous file
$routes->post('register/process', 'AccountController::registerProcess');

// --- Protected Public User Dashboard ---
// This route is for logged-in users, but not necessarily admins.
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);


// --- Protected Admin Routes ---
// This entire group is protected. Only logged-in Admins can access these URLs.
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('users', 'AdminController::usersList');
    $routes->get('users/new', 'AdminController::userNew');
    $routes->post('users/create', 'AdminController::userCreate');
    $routes->get('users/delete/(:num)', 'AdminController::userDelete/$1');
    $routes->get('anggota', 'AdminController::anggotaList');
    $routes->get('anggota/delete/(:num)', 'AdminController::anggotaDelete/$1');
});


// Disable auto-routing for better security.
$routes->setAutoRoute(false);