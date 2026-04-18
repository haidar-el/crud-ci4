<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/post/create','Post::create');
$routes->get('/post/edit/(:num)','Post::edit/$1');
$routes->get('/post','Post::index');
$routes->post('/post/update/(:num)','Post::update/$1');
$routes->get('/post/delete/(:num)','Post::delete/$1');
$routes->post('/post/store','Post::store');

$routes->get('artikel/index','Artikel::index');
$routes->get('artikel/create','Artikel::create');
$routes->post('artikel/store','Artikel::store');
$routes->get('artikel/edit/(:num)','Artikel::edit/$1');
$routes->post('artikel/update/(:num)','Artikel::update/$1');
$routes->get('artikel/delete/(:num)','Artikel::delete/$1');
$routes->get('artikel/baca/(:segment)','Artikel::show/$1');

// Oprec Routes
$routes->get('oprec', 'Oprec::index');
$routes->post('oprec/store', 'Oprec::store');
$routes->get('oprec/success', 'Oprec::success');
$routes->get('oprec/admin', 'Oprec::admin');
$routes->post('oprec/update_status/(:num)', 'Oprec::update_status/$1');
$routes->delete('oprec/delete/(:num)', 'Oprec::delete/$1');