<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'auth:beforeLogin'], function ($routes) {
    $routes->get('/', 'AuthController::index');
    $routes->post('/login', 'AuthController::login');
});
$routes->group('', ['filter' => 'auth:afterLogin'], function ($routes) {
    $routes->get('/logout', 'AuthController::logout');
    $routes->get('/dashboard', 'dashboardController::index');
});
