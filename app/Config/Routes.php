<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Public Routes ---
$routes->get('/', 'Home::index'); // Shows the Login page
$routes->post('login/process', 'AccountController::loginProcess'); // Correctly handles login data
$routes->get('logout', 'AccountController::logout');
$routes->get('register', 'AccountController::register');
$routes->get('register/admin', 'AccountController::registerAdmin');
$routes->post('register/process', 'AccountController::registerProcess');


// --- Protected Routes ---
// These routes require a user to be logged in.

// This is the page for Public users to see the DPR data.
// The 'auth' filter just checks if they are logged in.
$routes->get('dpr-data', 'Dpr::view_dpr', ['filter' => 'auth']);

// The 'admin' filter checks if they are logged in AND are an Admin.
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
//$routes->setAutoRoute(false);