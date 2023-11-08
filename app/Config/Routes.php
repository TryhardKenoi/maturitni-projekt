<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('ss', 'Home::index');
$routes->get('pokus', 'Home::method2');
$routes->get('kosmonaut', 'Pokus::pokus');
$routes->get('/organizace/(:num)', 'Pokus::cards/$1');
//$routes->get('skupina/(:num)/raketa', 'Pokus::raketa/$1');
//$routes->get('skupina/(:num)/posadka', 'Pokus::posadka/$1');
//$routes->get('skupina/(:num)/program', 'Pokus::program/$1');
$routes->get('zeme', 'Pokus::zeme');
$routes->get('zeme/(:num)', 'Pokus::vesmzeme/$1');
$routes->get('organizace', 'Pokus::organizace');
$routes->get('/', 'Pokus::default');
$routes->get('kosmonaut/(:num)', 'Pokus::getKosByRak/$1');
$routes->get('useless', 'Pokus::useless');
$routes->match(['get', 'post'],'useless/aer', 'Pokus::aer');
$routes->get('useless/page', 'Pokus::pagination');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
