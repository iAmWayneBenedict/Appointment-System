<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NotificationsModel;

class Admin extends BaseController
{
    protected $notification;

    function __construct()
    {
        //instantiate
        $this->notification = new NotificationsModel();
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

    public function qr_scanner()
    {
        return view('admin/qr-scanner');
    }

    public function sendMessage()
    {
        return view('admin/send-message');
    }

    public function display_sms_contact(){
        $data['user_data'] = $this->notification->get_user_data();

        return view('components/contactSMS-list', $data);
    }
}
