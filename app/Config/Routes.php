<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('Info/(:num)', 'Main::info/$1');
$routes->get('stages/(:num)', 'Main::stages/$1');
$routes->group('zavod', function($routes) {
    $routes->get('info/(:num)', 'Main::info/$1'); // Pro zobrazení info
    $routes->get('pridej_rocnik/(:num)', 'Main::pridej_rocnik_form/$1'); // Pro formulář
    $routes->post('pridej_rocnik', 'Main::pridej_rocnik'); // Pro zpracování formuláře
});
