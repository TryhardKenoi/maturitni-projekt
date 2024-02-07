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

$routes->get('/phpinfo', function() {phpinfo();});
$routes->get('/', 'Home::index');
$routes->get('/pridejEvent','Home::addEvent', ['filter'=>'auth']);
$routes->post('/create', 'Home::create');
$routes->get('/profil', 'Home::profil/');
$routes->get('/register', 'Home::register');
$routes->post('/auth/register', 'Home::createUser');
$routes->get('/create_group', 'Home::group');
$routes->post('/auth/create_group', 'Home::createGroup');
$routes->get('/group/(:num)', 'Home::showGroup/$1');
$routes->get('/group/remove/(:num)/(:num)', 'Home::removeFromGroup/$1/$2');
$routes->get('/event/(:num)','Home::getEvent/$1');
$routes->get('/events','Home::getEvents');
$routes->get('/event/edit/(:num)', 'Home::getEventEdit/$1');
$routes->post('/event/edit/(:num)', 'Home::editEvent/$1');
$routes->post('/group/addUser/(:num)', 'Home::addUserToGroup/$1');
$routes->post('/login/email', 'Home::checkUser');
$routes->post('register-email', 'Home::registerEmail');

// 
$routes->group('admin', function($routes) {
	$routes->get('users', 'Home::getUsers', ['filter'=>'admin']);
	$routes->get('groups', 'Home::getGroups', ['filter'=>'admin']);	
	$routes->get('groups/(:num)', 'Home::getGroupsById', ['filter'=>'admin']);
	$routes->get('groups/del/(:num)', 'Home::delGroup/$1', ['filter'=>'admin']);
	$routes->get('users/del/(:num)', 'Home::delUser/$1', ['filter' => 'admin']);
	$routes->get('users/edit/(:num)', 'Home::getUser/$1', ['filter' => 'admin']);
	$routes->post('user/edit/(:num)', 'Home::editUserById/$1', ['filter' => 'admin']);
});

$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	$routes->add('forgot_password', 'Auth::forgot_password');
  $routes->get('/', 'Auth::index');
  $routes->add('create_user', 'Auth::create_user');
	// $routes->add('edit_user/(:num)', 'Auth::edit_user/$1');
	 //$routes->add('create_group', 'Auth::create_group');
	// $routes->get('activate/(:num)', 'Auth::activate/$1');
	// $routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2');
	// $routes->add('deactivate/(:num)', 'Auth::deactivate/$1');
	//$routes->get('reset_password/(:hash)', 'Auth::reset_password/$1');
	//$routes->post('reset_password/(:hash)', 'Auth::reset_password/$1');
	// ...
});
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
