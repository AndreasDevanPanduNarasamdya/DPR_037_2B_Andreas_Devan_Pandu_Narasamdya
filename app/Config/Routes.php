<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Public Routes ---
// The login page is the homepage
$routes->get('/', 'Home::index');

// Registration Flow
$routes->get('register', 'AccountController::register');
$routes->get('registerasadmin', 'AccountController::registerasadmin');
$routes->post('register/process', 'AccountController::registerProcess');

// Login and Logout Flow
$routes->post('login/process', 'AccountController::loginProcess');
$routes->get('logout', 'AccountController::logout');


// --- Protected Routes (Pages that require login) ---
// Any route in this group will first run the 'auth' filter.
// This is how you protect the DPR table view.
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    $routes->get('dpr-gaji', 'Dpr::index');
    // You can add more protected pages here in the future
    
});

// Disable auto-routing for better security
$routes->setAutoRoute(false);