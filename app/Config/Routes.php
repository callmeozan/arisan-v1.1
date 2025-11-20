<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'GrupController::index');

$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
});

$routes->get('/register', 'Register::index');
$routes->post('/register/attemptRegister', 'Register::attemptRegister');

$routes->get('/register', 'Auth::register');
$routes->post('/register/save', 'Auth::saveRegister');

$routes->post('/api/set-winner', 'Dashboard::setWinner');

$routes->get('/', 'Dashboard::index');

// API endpoint untuk data arisan
$routes->get('/api/groups', 'Dashboard::apiGroups');

$routes->get('/login', 'Auth::login');
$routes->post('/auth/attemptLogin', 'Auth::attemptLogin');
$routes->get('/logout', 'Auth::logout');
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
});
