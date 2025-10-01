<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- Public Routes ---
// The login page is the homepage.
$routes->get('/', 'Home::index');

// Registration Flow
$routes->get('register', 'AccountController::register'); // Shows public registration form
$routes->get('register_admin', 'AccountController::registerAdmin'); // Shows admin registration form
$routes->post('register/process', 'AccountController::registerProcess'); // Handles BOTH form submissions

// Login and Logout Flow
$routes->post('login/process', 'AccountController::loginProcess');
$routes->get('logout', 'AccountController::logout');


// --- Protected Routes (Pages that require login) ---
// Any route in this group will first run the 'auth' filter (our "bouncer").
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    $routes->get('dpr-gaji', 'Dpr::index');
    // You can add more protected pages here in the future
    
});

// Disable auto-routing for better security.
$routes->setAutoRoute(false);