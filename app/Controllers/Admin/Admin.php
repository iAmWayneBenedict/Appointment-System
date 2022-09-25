<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NotificationsModel;
use App\Models\Admin\AdminModel;
use App\Models\Admin\ManageAppointmentModel;
use App\Models\UserModel;

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

        if ($admin_data->password == $admin_password) {

            $this->session->set([
                'admin' => $admin_data->user_name,
                'logged_in' => TRUE
            ]);

            return redirect()->to('admin/dashboard');
        }

        $this->session->setFlashdata('invalid', 'Invalid Password');
        return redirect()->back();
    }

    public function verify_admin()
    {

        $admin_password = $this->request->getPost('password');

        $admin_data = $this->admin_model->get_admin();

        if ($admin_data->password == $admin_password) {

            return json_encode([
                "status" => "success",
            ]);
        }

        return json_encode([
            "status" => "error",
        ]);
    }

    //logout and destroy admin session
    public function admin_logout()
    {

        $admin_session = ['admin', 'user_name'];

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
}
