<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('Info/(:num)', 'Main::info/$1');
$routes->get('stages/(:num)', 'Main::stages/$1');

