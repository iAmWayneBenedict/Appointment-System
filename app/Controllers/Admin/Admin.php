<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NotificationsModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $notification;
    private $user_model;

    function __construct()
    {
        //instantiate
        $this->notification = new NotificationsModel();
        $this->user_model = new UserModel();
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function login()
    {
        return view('admin/login');
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
        return view('admin/qr-scanner');
    }

    public function sendMessage()
    {
        return view('admin/send-message');
    }

    public function display_sms_contact()
    {
        $data['user_data'] = $this->notification->get_user_data();

        return view('components/contactSMS-list', $data);
    }
}
