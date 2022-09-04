<?php

namespace App\Controllers\Employee;

use App\Controllers\BaseController;

class Employee extends BaseController
{


    public function index()
    {
        return view('employee/index');
    }

    public function qr_generator()
    {
        return view('employee/qr-generator');
    }
}
