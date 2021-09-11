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
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');

//Authentication
$routes->get('/logout', 'Auth/LoginController::logout');
$routes->group('/', ['filter' => 'guest'], function ($routes) {
    $routes->get('register', 'Auth\RegisterController::showRegisterForm');
    $routes->post('register', 'Auth\RegisterController::register');
    $routes->get('login', 'Auth\LoginController::showLoginForm');
    $routes->post('login', 'Auth\LoginController::login');
    $routes->get('password/reset', 'Auth\ResetPasswordController::showLinkRequestForm');
    $routes->post('password/reset', 'Auth\ResetPasswordController::sendResetLinkEmail');
    $routes->get('password/reset/(:any)', 'Auth\ResetPasswordController::showResetForm/$1');
    $routes->post('password/reset/(:any)', 'Auth\ResetPasswordController::resetPassword/$1');
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
