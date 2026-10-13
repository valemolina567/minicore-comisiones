<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('vendedores', 'Vendedores::index');
$routes->get('vendedores/nuevo', 'Vendedores::nuevo');
$routes->post('vendedores/guardar', 'Vendedores::guardar');

$routes->get('ventas', 'Ventas::index');
$routes->get('ventas/nuevo', 'Ventas::nuevo');
$routes->post('ventas/guardar', 'Ventas::guardar');
$routes->get('reportes', 'Reportes::index');
