<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\HolidayModel;

class HolidaysController extends BaseController
{
    protected $session;

    function __construct()
    {
        //instantiate
        $this->session = session();
        $this->holiday_model = new HolidayModel();
    }

    // TODO : update to server
    public function set_holidays()
    {
        $current_admin = $this->session->get('admin_id');

        $holiday_from = $this->request->getPost('holiday_from');
        $holiday_to = $this->request->getPost('holiday_to');
        $description = $this->request->getPost('description');

        if(empty($holiday_from) || empty($description)){
            return json_encode([
                'code' => 1,
                'msg' => "Holiday from and Description is Required"
            ]);
        }

        if (!empty($holiday_to)) {
            $holiday_to = date_format(date_create($holiday_to), 'Y-m-d H:i:s');
        } else {
            $holiday_to = "";
        }

        $holiday_from = date_format(date_create($holiday_from), 'Y-m-d H:i:s');

        if ($this->holiday_model->set_holidays($current_admin, $holiday_from, $holiday_to, $description)) {
            return json_encode([
                'code' => 1,
                'msg' => "Success"
            ]);
        }
    }

    public function get_holidays()
    {
        $result = $this->holiday_model->get_holidays();

        return json_encode($result);
    }
}
