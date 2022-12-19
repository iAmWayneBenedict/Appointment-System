<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SystemController extends BaseController
{
    public function maintenance()
    {

        return view("under-maintenance");
    }
}
