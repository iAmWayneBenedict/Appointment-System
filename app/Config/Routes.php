<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::home');
$routes->get('/test-sms', 'Home::index');
$routes->post('/test-sms', 'Home::test_sms');


$routes->get('/scanner', 'Employee\EmployeeScanner::index');
$routes->post('/track-employee', 'Employee\EmployeeScanner::track_employee');
$routes->post('/add-employee', 'Employee\EmployeeScanner::add_employee');
$routes->match(['get', 'post'], '/get-employee-status', 'Employee\EmployeeScanner::get_employee_status');
$routes->match(['get', 'post'], '/get-employee-status-user', 'Employee\EmployeeScanner::get_employee_status_user');
$routes->match(['get', 'post'], '/get-employee', 'Employee\EmployeeScanner::get_employee');

$routes->group('user', static function ($routes) {
    $routes->get('register', 'End_Users\UserController::index');
    $routes->get('login', 'End_Users\UserLoginController::index');
    $routes->get('reminder/(:any)', 'End_Users\UserController::display_reminder_information/$1');
    $routes->match(['get', 'post'], 'generate-id', 'End_Users\UserController::generate_user_id');
    $routes->post('register-user', 'End_Users\UserController::register_user');
    $routes->post('login-user', 'End_Users\UserLoginController::login_user');

    $routes->group('dashboard', ['filter' => 'userLoginFilter'], static function ($routes) {
        $routes->get('/', 'End_Users\UserController::dashboard');
        $routes->get('employee-status', 'End_Users\UserController::employee_status');
        $routes->get('logout', 'End_Users\UserLoginController::logout_user');
    });
});

$routes->group('admin', static function ($routes) {
    $routes->get('login', 'Admin\Admin::login');
    $routes->get('dashboard', 'Admin\Admin::index');
    $routes->get('employees', 'Admin\Admin::employees');
    $routes->get('qr-scanner', 'Admin\Admin::qr_scanner');
    $routes->get('send-message', 'Admin\Admin::sendMessage');

    $routes->group('dashboard', static function ($routes) {
        $routes->get('sms-contact', 'Admin\Admin::display_sms_contact');
        $routes->post('send-sms', 'Admin\SendNotifications::send_sms');
        $routes->get('send-all-sms', 'Admin\SendNotifications::send_bulk_sms');//this should be post(get for testing)
    });
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
