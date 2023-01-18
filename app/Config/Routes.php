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
$routes->get('/maintenance', 'SystemController::maintenance');

// if maintenance
$routes->group("", ['filter' => 'maintenanceFilter'], static function ($routes) {

    $routes->get('/', 'Home::home');
    // $routes->get('/test-pdf', 'Home::index');
    // $routes->post('/test-sms', 'Home::test_sms');


    $routes->get('/employee-incharge', 'Admin\Admin::get_incharge_employee');


    $routes->group('user', static function ($routes) {
        $routes->get('register', 'End_Users\UserController::index');
        $routes->get('login', 'End_Users\UserLoginController::index', ['filter' => 'userIsLoggedIn']);
        $routes->get('reminder/(:any)', 'End_Users\UserController::display_reminder_information/$1');
        $routes->match(['get', 'post'], 'generate-id', 'End_Users\UserController::generate_user_id');
        $routes->post('register-user', 'End_Users\UserController::register_user');
        $routes->post('login-user', 'End_Users\UserLoginController::login_user');

        $routes->get('all-appointments', 'Admin\ManageAppointment::get_set_appointments');
        $routes->get('get-incharge-employee/(:any)', 'Employee\Employee::get_incharge_employee/$1');

        $routes->group('dashboard', ['filter' => 'userLoginFilter'], static function ($routes) {
            // $routes->group('dashboard', static function ($routes) {
            // $routes->group('dashboard', static function ($routes) {
            $routes->get('/', 'End_Users\UserController::dashboard');
            $routes->get('employee-status', 'End_Users\UserController::employee_status');
            $routes->get('logout', 'End_Users\UserLoginController::logout_user');
            $routes->get('set-appointment', 'End_Users\ClientAppointment::registered_client');
            $routes->get('passed-appointment', 'End_Users\ClientAppointment::get_passed_appointment');
            $routes->post('reschedule-appointment', 'End_Users\ClientAppointment::reschedule_appointment');
            $routes->get('delete-passed-appointment/(:any)', 'End_Users\ClientAppointment::delete_passed_apointment/$1');
            $routes->get('delete1-passed-appointment/(:any)', 'End_Users\ClientAppointment::delete1_passed_apointment/$1');
            $routes->get('appointment-details/(:any)', 'End_Users\ClientAppointment::appointment_details/$1');

            $routes->match(['get', 'post'], 'cancel-appointment/(:any)', 'End_Users\ClientAppointment::cancel_appointment/$1');
            $routes->post('edit-appointment', 'End_Users\ClientAppointment::edit_appointment');
            $routes->get('pending-appointment', 'End_Users\ClientAppointment::pending_appointment');
            $routes->get('approved-appointment', 'End_Users\ClientAppointment::approved_appointment');
            $routes->get('appointment-summary/(:num)', 'End_Users\ClientAppointment::approved_appointment/$1');
            $routes->get('remove-appointment/(:any)', 'End_Users\ClientAppointment::delete_appointment/$1');

            $routes->get('stocks-monitor', 'Admin\StocksController::stocks_monitor');
            $routes->get('get-all-release-dates', 'Admin\StocksController::get_all_release_dates');

            $routes->get('notifications', 'End_Users\UserController::notifications');
            $routes->get('get-notifications', 'End_Users\UserController::get_notifications');
            $routes->get('already-read/(:num)', 'End_Users\UserController::already_read/$1');

            //logtime
            $routes->get('online-stats', 'End_Users\UserLoginController::update_users_logtime');
        });
        $routes->group('my-account', ['filter' => 'userLoginFilter'], static function ($routes) {
            // $routes->group('my-account', static function ($routes) {
            $routes->get('/', 'End_Users\ManageAccount::account_page');
            $routes->post('update', 'End_Users\ManageAccount::update_account');
            $routes->post('password-update', 'End_Users\ManageAccount::update_password');
            $routes->get('deactivate-account', 'End_Users\ManageAccount::deactivate_account');
        });
    });

    //appointment routes
    $routes->group('appointments', static function ($routes) {
        $routes->get('guest-user', 'End_Users\ClientAppointment::guest_client');
        $routes->post('(:num)/submit-appointment', 'End_Users\ClientAppointment::create_appointment/$1');
    });

    $routes->group('admin', static function ($routes) {
        $routes->get('/', 'Admin\Admin::login');
        $routes->post('admin-login', 'Admin\Admin::admin_login');
        $routes->post('verify-admin', 'Admin\Admin::verify_admin');
        $routes->get('get-holidays', 'Admin\HolidaysController::get_holidays');

        $routes->group('dashboard', ['filter' => 'adminLoginFilter'],  static function ($routes) {
            // $routes->group('dashboard', static function ($routes) {
            $routes->get('/', 'Admin\Admin::index');
            $routes->get('employees', 'Admin\Admin::employees');
            $routes->get('send-message', 'Admin\Admin::sendMessage');

            //users
            $routes->get('users', 'Admin\Admin::users');
            $routes->get('deactivate-user/(:num)', 'End_Users\ManageAccount::deactivate_user/$1');
            $routes->get('reactivate-user/(:num)', 'End_Users\ManageAccount::reActivate_user/$1');
            $routes->get('archive-user/(:num)', 'End_Users\ManageAccount::archive_user_account/$1');
            $routes->get('archive', 'Admin\Admin::archive_users');
            $routes->get('users-summary', 'End_Users\UserController::get_realtime_users');

            //notifications
            $routes->get('sms-contact', 'Admin\Admin::display_sms_contact');
            $routes->post('send-sms', 'Admin\SendNotifications::send_sms');
            $routes->get('send-all-sms', 'Admin\SendNotifications::send_bulk_sms'); //this should be post(get for testing)
            $routes->post('send-email', 'Admin\SendNotifications::send_email');
            $routes->get('notifications', 'Admin\Admin::admin_notifications');
            $routes->get('already-read/(:num)', 'Admin\Admin::update_notifications/$1');
            $routes->get('get-notifications', 'Admin\Admin::get_notifications');
            $routes->get('upcoming-appointment', 'Admin\ManageAppointment::notify_admin_appointments');

            //logout
            $routes->get('logout', 'Admin\Admin::admin_logout');

            //manage appointments
            $routes->get('pending-appointments', 'Admin\ManageAppointment::pending_appointments');
            $routes->get('approved-appointments', 'Admin\ManageAppointment::approved_appointments');
            $routes->get('approved-appointments/schedule', 'Admin\Admin::schedule');
            $routes->get('get-appointment-details/(:num)', 'Admin\ManageAppointment::get_appointment_details/$1');
            $routes->get('get-all-approved-appointments', 'Admin\ManageAppointment::get_all_approved_appointments');
            $routes->get('get-all-pending-appointments', 'Admin\ManageAppointment::get_all_pending_appointments');
            $routes->get('get-all-events', 'Admin\ManageAppointment::get_all_events');
            $routes->get('(:any)/review', 'Admin\ManageAppointment::review_appointment/$1');
            $routes->post('approve', 'Admin\ManageAppointment::approve_appointment');
            $routes->post('reject', 'Admin\ManageAppointment::reject_appointment');
            $routes->get('complete/(:any)', 'Admin\ManageAppointment::mark_as_done/$1');
            $routes->post('insert-walkin', 'Admin\ManageAppointment::insert_walkin_appointment');

            //employee
            $routes->post('add-employee', 'Employee\EmployeeScanner::add_employee');
            $routes->get('get-employee/(:num)', 'Employee\Employee::get_employee/$1');
            $routes->post('update-employee', 'Employee\EmployeeScanner::update_employee');
            $routes->get('delete-employee/(:num)', 'Employee\EmployeeScanner::delete_employee/$1');
            $routes->get('get-all-incharge-to', 'Employee\Employee::get_all_incharge_to');

            //stocks
            $routes->get('stock-management', 'Admin\StocksController::index');
            $routes->post('add-stock', 'Admin\StocksController::add_stock');
            $routes->get('get-all-stocks', 'Admin\StocksController::get_all_stocks');
            $routes->get('get-all-stock', 'Admin\StocksController::get_all_stock');
            $routes->get('get-a-stock/(:any)', 'Admin\StocksController::display_update_form/$1');
            $routes->post('update-a-stock', 'Admin\StocksController::update_stock');
            $routes->get('delete-a-stock/(:any)', 'Admin\StocksController::delete_stock/$1');
            $routes->get('display-release/(:any)', 'Admin\StocksController::display_release/$1');
            $routes->get('get-all-release-dates', 'Admin\StocksController::get_all_release_dates');
            $routes->post('set-release-date', 'Admin\StocksController::set_release');
            $routes->post('update-release-date', 'Admin\StocksController::update_release');
            $routes->get('display-claim/(:any)', 'Admin\StocksController::display_claim_form/$1');
            $routes->post('insert-claimer', 'Admin\StocksController::insert_availer');


            //report
            $routes->get('report', 'Admin\AdminReport::report_template');
            $routes->post('preview', 'Admin\AdminReport::display_preview');
            $routes->post('generate-pdf', 'Admin\AdminReport::create_pdf');
            $routes->post('spreview', 'Admin\AdminReport::sdisplay_preview');
            $routes->post('sgenerate-pdf', 'Admin\AdminReport::screate_pdf');
            $routes->get('get-subcats', 'Admin\StocksController::display_stocks');


            // holidays
            $routes->post('set-holiday', 'Admin\HolidaysController::set_holidays');
            $routes->get('remove-holidays/(:num)', 'Admin\HolidaysController::remove_holidays/$1');
        });
    });

    //dedicated page for employee scanner
    $routes->group('scanner', static function ($routes) {
        $routes->get('/', 'Admin\Admin::qr_scanner');
        $routes->post('track-employee', 'Employee\EmployeeScanner::track_employee');
        $routes->match(['get', 'post'], 'get-employee-status', 'Employee\EmployeeScanner::get_employee_status');
        $routes->match(['get', 'post'], 'get-employee-status-user', 'Employee\EmployeeScanner::get_employee_status_user');
        $routes->match(['get', 'post'], 'get-employee', 'Employee\EmployeeScanner::get_employee');
    });
});



/**
   TITLE: CRON JOB CALLS
 * description: this routes below will be use for cronjob it each of them has 
 *              assigned time to be exuted from cron
 * always monitor your cron jobs
 * 
 * client-incoming-appointment : every 1 hour
 * removed-passed-appointment: every 12 am
 * check-reschedule-appointment: every 1 hour
 * delete-messages : once a month or every 26th of the month
 * 
 */
$routes->get('client-incoming-appointment', 'Admin\ManageAppointment::sms_incoming_appointment');
$routes->get('removed-passed-appointment', 'Admin\ManageAppointment::removed_passed_appointments');
$routes->get('check-reschedule-appointment', 'Admin\ManageAppointment::check_resched_appointment');
$routes->get('delete-messages', 'Notifications::delete_after_30_days');
$routes->get('auto-logout', 'End_Users\UserLoginController::auto_logout_user');

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
