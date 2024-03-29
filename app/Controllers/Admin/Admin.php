<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NotificationsModel;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageAppointmentModel;
use App\Models\UserModel;
use App\Libraries\OnAppNotification;
use App\Models\OnAppNotifModel;
use App\Models\EmployeeModel;

class Admin extends BaseController
{
    protected $notification;
    protected $admin_model;
    protected $session;

    function __construct()
    {
        //instantiate
        $this->notification = new NotificationsModel();
        $this->admin_model = new AdminModel();
        $this->user_model = new UserModel();
        $this->manage_appointment = new ManageAppointmentModel();
        $this->on_app_notif = new OnAppNotification();
        $this->employee_model = new EmployeeModel();
        $this->session = session();
    }

    public function index()
    {
        $approved = $this->manage_appointment->get_approved_appointment();
        $pending = $this->manage_appointment->get_pending_appointment();

        $data['approvedCount'] = count($approved);
        $data['pendingCount'] = count($pending);
        $data['total'] = $data['approvedCount'] + $data['pendingCount'];
        return view('admin/dashboard', $data);
    }

    public function login()
    {
        return view('admin/login');
    }

    /**
     * Function: Aunthentication Check / validation
     * Description: Compare and validate admin input from viewpage
     *              to data from DB for the system can give access to admin
     */
    public function admin_login()
    {

        $admin_password = $this->request->getPost('password');

        $admin_data = $this->admin_model->get_admin();


        foreach ($admin_data as $admin) {
            if ($admin->password == $admin_password) {

                $this->session->set([
                    'admin' => $admin->user_name,
                    'admin_id' => $admin->id,
                    'alogged_in' => TRUE
                ]);

                return redirect()->to('admin/dashboard');
            }
        }

        $this->session->setFlashdata('invalid', 'Invalid Password');
        return redirect()->back();
    }

    public function verify_admin()
    {

        $admin_password = $this->request->getPost('password');

        $admin_data = $this->admin_model->get_admin();

        foreach ($admin_data as $admin) {
            if ($admin->password == $admin_password) {

                return json_encode([
                    "status" => "success",
                ]);
            }
        }

        return json_encode([
            "status" => "error",
        ]);
    }

    //logout and destroy admin session
    public function admin_logout()
    {

        $admin_session = ['admin', 'alogged_in'];

        $this->session->destroy($admin_session);

        return redirect()->to('/admin');
    }

    public function employees()
    {
        return view('admin/employees');
    }

    public function users()
    {
        $response['users'] = $this->user_model->get_all_users();
        return view('admin/users', $response);
    }

    //TODO: ARCHIVE user need to be displayed
    public function archive_users(){
        $response['archive'] = $this->user_model->get_archive_users();
        return view('admin/archive-users', $response);
    }

    public function qr_scanner()
    {
        return view('qr-scanner');
    }

    public function schedule()
    {
        return view('admin/schedule');
    }

    public function sendMessage()
    {
        return view('admin/send-message');
    }

    //display sms contact to viewpage
    public function display_sms_contact()
    {
        $data['user_data'] = $this->notification->get_user_data();

        return view('components/contactSMS-list', $data);
    }

    public function admin_notifications()
    {
        $response['notifications'] = $this->on_app_notif->get_admin_messages();
        return view('admin/notifications', $response);
    }
    public function update_notifications($notification_id)
    {
        $response['notifications'] = $this->on_app_notif->update_admin_is_read($notification_id);
        // return view('admin/notifications', $response);
        return true;
    }

    public function get_notifications()
    {
        $response['notifications'] = $this->on_app_notif->get_notifications();
        return json_encode($response);
    }

    public function get_incharge_employee()
    {
        $response = $this->employee_model->get_all_incharge();
        return json_encode($response);
    }
}
