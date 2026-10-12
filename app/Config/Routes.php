<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'Pages::index');
$routes->get('/about', 'Pages::about');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::attempt');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->post('logout', 'Auth::logout');

    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::create');
    $routes->post('customers', 'Customers::store');
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1');
    $routes->post('customers/(:num)', 'Customers::update/$1');

    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::create');
    $routes->post('users', 'Users::store');
    $routes->get('users/(:num)/edit', 'Users::edit/$1');
    $routes->post('users/(:num)', 'Users::update/$1');
});