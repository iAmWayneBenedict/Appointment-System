<?php

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;
use App\Models\Appointment\UserAppointmentModel;
use App\Models\UserModel;
use App\Models\EmployeeModel;
use CodeIgniter\I18n\Time;
use App\Models\Admin\AdminReportModel;
use App\Models\Admin\ManageAppointmentModel;
use App\Libraries\FilterText;
use App\Libraries\OnAppNotification;

class ClientAppointment extends BaseController
{

    protected $userModel;
    protected $userAppointment;
    protected $session;
    protected $validation;
    protected $time;
    protected $filter;
    protected $app_notif;

    function __construct()
    {
        //instantiate
        $this->userModel = new UserModel();
        $this->userAppointment = new UserAppointmentModel();
        $this->employeeModel = new EmployeeModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->time = new Time();
        $this->filter = new FilterText();
        $this->app_notif = new OnAppNotification;
    }

    public function registered_client()
    {
        $user_id = $this->session->get('id');
        $basic_data['userData'] = $this->userModel->get_user_info($user_id);

        return view('end-user/appointment/registered', $basic_data);
    }

    public function guest_client()
    {
        return view('end-user/appointment/guest');
    }


    public function create_appointment($user_type = false)
    {

        $validate = $this->validate([
            'name' => [
                'label' => 'Name',
                'rules' => 'required'
            ],
            'address' => [
                'label' => 'Complete Address',
                'rules' => 'required'
            ],
            'c_number' => [
                'label' => 'Contact Number',
                'rules' => 'required|regex_match[/^(09)\d{9}$/]',
            ],
            'social_pos' => [
                'label' => 'Social Position',
                'rules' => 'required'
            ],
            'purpose' => [
                'label' => 'Your Purpose',
                'rules' => 'required'
            ],
            'sched' => [
                'label' => 'Appointment Schedule',
                'rules' => 'required|'
            ],
        ]);

        if (!$validate) {
            return json_encode([
                'errors' => $this->validation->getErrors(),
                'code' => 0
            ]);
        }


        //get form data
        $name = $this->request->getPost('name');
        $address = $this->request->getPost('address');
        $contact_number = $this->request->getPost('c_number');
        $social_pos = $this->request->getPost('social_pos');
        $purpose = $this->request->getPost('purpose');
        $schedule = $this->request->getPost('sched');

        //filter remarks
        $remark = $this->request->getPost('remark');
        if (!empty($remark)) {
            $remark = $this->filter->filtertext($remark);
        }


        //get current date
        $now = $this->time->now();
        //parse current and given schendule date to CI time
        $parseTimeNow = $this->time->parse($now);
        $parseTimeSched = $this->time->parse($schedule);

        // subtract 2 hour(s) to sched time and convert to string
        $subTime = $parseTimeSched->subDays(3);
        $subTime = $subTime->toDateTimeString();

        //current date convert to string
        $curTime = $parseTimeNow->toDateString();

        //format date and time with day only
        $subtractedTime = date('Y-m-d', strtotime($subTime));
        $currentTime = date('Y-m-d', strtotime($curTime));

        // return json_encode([$currentTime, $subtractedTime, ]);
        $schedDate = date('Y-m-d', strtotime($parseTimeSched));
        if ($currentTime >= $subtractedTime) {
            return json_encode([
                'code' => 0,
                'errors'  => ['Appointment should be 3 days or more before schedule']
            ]);
        }

        //format date before inserting to database
        $formated_sched = date('Y-m-d H:i:s', strtotime($schedule));

        //identify if guest or registered
        $user_id = NULL;
        $_user = 'Guest'; //default, 000
        if ($user_type == 001) {
            $user_id = $this->session->get('id');
            $_user = 'Registered';
        }

        //organize data for easy inserting to database
        $data = [
            'user_id' => $user_id,
            'name' => $name,
            'address' => $address,
            'contact_number' => $contact_number,
            'social_pos' => $social_pos,
            'purpose' => $purpose,
            'schedule' => $formated_sched,
            'remarks'   => $remark,
            'user_type' => $_user
        ];

        $response = $this->userAppointment->insert_appointment($data);
        if (!$response['bool']) {
            return json_encode([
                'code' => 0,
                'errors' => 'Sorry!, Please make a try later, Something went worng in our server'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => "Appointment Sent\nPlease wait for a Text message for an update on your appointment \n Appointment ID: {$response['id']}"
        ]);
    }

    /**
     Fucntion: DELETE APPOINTMENT
     * Description: appointment that ony pending can be fully remove in the DB
     */
    public function delete_appointment($appointment_id)
    {

        $mng = new ManageAppointmentModel();
        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'pending canceled'
        ];

        AdminReportModel::insert_report($data);
        $mng->removed_pending_appointment($appointment_id);


        session()->setFlashdata('success', 'Appointment Removed');
        return redirect('user/dashboard');
    }

    /**
     Function: Retrieve Client's Pending Appointment
     * Description : client can view pending appointment 
     */
    public function get_pending_appointment()
    {

        $user_id = $this->session->get('id');
        $data['myAppointment'] = $this->userAppointment->get_pending($user_id);

        $data['allIncharge'] = $this->employeeModel->get_all_incharge();

        return $data;
    }

    /**
     Function: Retrieve Client's Pending Appointment
     * Description : client can view pending appointment 
     */
    public function pending_appointment()
    {
        $data['pending'] = $this->get_pending_appointment();
        return view('end-user/dashboard/pending-appointments', $data);
    }

    /**
     Function: Retrieve Client's Approved Appointment
     * Description : client can view pending appointment 
     */
    public function get_approved_appointment()
    {

        $user_id = $this->session->get('id');
        $data['myAppointment'] = $this->userAppointment->get_approved($user_id);
        $data['allIncharge'] = $this->employeeModel->get_all_incharge();

        return $data;
    }

    public function approved_appointment()
    {

        $data['approved'] = $this->get_approved_appointment();

        return view('end-user/dashboard/approved-appointments', $data);
    }

    /**
     Function: Edit Appointment
     * Description: Cliet can only edit pending or unapproved, but in edit theirs only
     *              Data client can modify such as schedule, purpose and contact Number
     * @return json:respone 
     */

    public function edit_appointment()
    {

        $validate = $this->validate([
            'c_number' => [
                'label' => 'Contact Number',
                'rules' => 'required|regex_match[/^(09)\d{9}$/]',
            ],
            'purpose' => [
                'label' => 'Your Purpose',
                'rules' => 'required'
            ],
            'sched' => [
                'label' => 'Appointment Schedule',
                'rules' => 'required|'
            ],
        ]);

        if (!$validate) {
            return json_encode([
                'errors' => $this->validation->getErrors(),
                'code' => 0
            ]);
        }

        //get form data
        $contact_number = $this->request->getPost('c_number');
        $purpose = $this->request->getPost('purpose');
        $schedule = $this->request->getPost('sched');
        $id = $this->request->getPost('id');

        //filter remarks
        $remark = $this->request->getPost('remark');
        if (!empty($remark)) {
            $remark = $this->filter->filtertext($remark);
        }

        //get current date
        $now = $this->time->now();
        //parse current and given schendule date to CI time
        $parseTimeNow = $this->time->parse($now);
        $parseTimeSched = $this->time->parse($schedule);

        // subtract 2 hour(s) to sched time and convert to string
        $subTime = $parseTimeSched->subDays(3);
        $subTime = $subTime->toDateTimeString();

        //current date convert to string
        $curTime = $parseTimeNow->toDateString();

        //format date and time with day only
        $subtractedTime = date('Y-m-d', strtotime($subTime));
        $currentTime = date('Y-m-d', strtotime($curTime));

        if ($currentTime >= $subtractedTime) {
            return json_encode([
                'code' => 0,
                'errors'  => 'Appointment should be 3 days or more before schedule'
            ]);
        }

        $current_user = $this->session->get('id');
        $formated_sched = date('Y-m-d H:i:s', strtotime($schedule));

        $data = [
            'contact_number' => $contact_number,
            'purpose' => $purpose,
            'schedule' => $formated_sched,
            'remarks'  => $remark
        ];

        $response = $this->userAppointment->update_appointment($id, $data);
        if (!$response['bool']) {
            return json_encode([
                'code' => 0,
                'errors' => 'Sorry!, Please make a try later, Something went worng in our server'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => "Appointment Updated\nPlease wait for a Text message for an update on your appointment \n Appointment ID: {$response['id']}"
        ]);
    }

    //get and display passed appointments
    public function get_passed_appointment()
    {
        $user_id = $this->session->get('id');
        $data['myAppointment'] = $this->userAppointment->get_passed_appointment($user_id);
        return view('end-user/dashboard/passed-appointment', $data);
    }

    /**
     Function: Reschedule
     * Description: Recieve and process the new appointment schedule
     * @return json response
     */
    public function reschedule_appointment()
    {

        $appointment_id = $this->request->getPost('id');
        $new_sched = $this->request->getPost('new_sched');

        //get current date
        $now = $this->time->now();
        //parse cur date to CI time
        $parseTimeNow = $this->time->parse($now);
        $parseTimeSched = $this->time->parse($new_sched);

        // subtract 2 hour(s) to sched time
        $subTime = $parseTimeSched->subDays(3);
        $subTime = $subTime->toDateTimeString();

        //current data
        $curTime = $parseTimeNow->toDateString();

        //format date and time with day only
        $subtractedTime = date('Y-m-d', strtotime($subTime));
        $currentTime = date('Y-m-d', strtotime($curTime));

        if ($currentTime >= $subtractedTime) {
            return json_encode([
                'code' => 0,
                'msg'  => 'Appointment should be 3 days or more before schedule'
            ]);
        }

        $formated_sched = date('Y-m-d H:i:s', strtotime($new_sched));

        if (!$this->userAppointment->reschedule_appointment($appointment_id, $formated_sched)) {
            return json_encode([
                'code' => 500,
                'msg'  => 'Our System is having an issue please try again later'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg'  => 'Appointment has been Resheduled'
        ]);
    }

    //delete appointment base from ID
    public function delete_passed_apointment($appointment_id = NULL)
    {
        $mng = new ManageAppointmentModel();
        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'passed'
        ];

        AdminReportModel::insert_report($data);
        $mng->remove_approved_appointment($appointment_id);

        session()->setFlashdata('success', 'Passed Appointment Removed');
        return redirect('user/dashboard');
    }

    //delete appointment base from ID if it is already done and insert it on report table
    public function delete1_passed_apointment($appointment_id = NULL)
    {

        $mng = new ManageAppointmentModel();
        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'done'
        ];

        AdminReportModel::insert_report($data);
        $mng->remove_approved_appointment($appointment_id);

        session()->setFlashdata('success', 'Passed Appointment Removed');
        return redirect('user/dashboard');
    }

    /**
     Function: CANCEL APPOINTMENT
     * Description: client appointment cancel approved
     *              appointment, if the client cancel the appointment it will remove 
     *              from approved table and  include it on report
     * @param appointment_id : appointment unique identification
     * @return session : flash reminder
     */
    public function cancel_appointment($appointment_id = NULL)
    {
        $notify_admin = "";
        $approved = $this->userAppointment->get_approved_appointment($appointment_id);

        foreach ($approved as $data) {
            $date = date_create($data->schedule);
            $sched = date_format($date, 'F d, Y g:i A');

            $notify_admin .= "{$data->name} has been canceled the appointment ";
            $notify_admin .= "Schedule on: {$sched} with appointment id : {$data->id}";
        }

        $this->app_notif->notify_admin($notify_admin);

        $mng = new ManageAppointmentModel();
        $data = [
            'appointment_id'  => $appointment_id,
            'state'           => 'approved canceled'
        ];

        AdminReportModel::insert_report($data);
        $mng->remove_approved_appointment($appointment_id);

        session()->setFlashdata('success', 'Appointment Canceled');
        return redirect('user/dashboard');
    }

    public function appointment_details($id)
    {
        $approved = $this->userAppointment->get_approved_appointment($id);
        $pending = $this->userAppointment->get_pending_appointment($id);

        $data['allIncharge'] = $this->employeeModel->get_all_incharge();

        if ($pending) {
            $data['pending'] = $pending;
            return view('end-user/dashboard/appointment-details', $data);
        } else {
            $data['approved'] = $approved;
            return view('end-user/dashboard/appointment-details', $data);
        }
    }
}
