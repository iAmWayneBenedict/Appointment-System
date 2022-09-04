<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Admin extends BaseController
{


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
}
