<?php

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Libraries\OneWaySMS;
use PHPUnit\Util\Json;

class ManageAccount extends BaseController
{

    protected $userModel;
    protected $session;
    protected $encrypter;
    protected $validation;
    protected $send_sms;

    function __construct()
    {
        //instantiate
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->encrypter = \Config\Services::encrypter();
        $this->validation = \Config\Services::validation();
        $this->send_sms = new OneWaySMS();
    }

    //display account page with data
    public function account_page()
    {

        $user_id = $this->session->get('id');

        $data['userData'] = $this->userModel->get_user_info($user_id);

        return view('end-user/dashboard/my-account', $data);
    }

    /**
     * Function: Update user basics information 
     */
    public function update_account()
    {

        $validate = $this->validate([
            'fname' => [
                'label' => 'First Name',
                'rules' => 'required|alpha_space'
            ],
            'mname' => [
                'label' => 'Middle Name',
                'rules' => 'required|alpha_space'
            ],
            'lname' => [
                'label' => 'Last Name',
                'rules' => 'required|alpha_space'
            ],
            'municipality' => [
                'label' => 'Municipality',
                'rules' => 'required'
            ],
            'barangay' => [
                'label' => 'Barangay',
                'rules' => 'required'
            ],
            'zone' => [
                'label' => 'Zone / Street',
                'rules' => 'required'
            ],
            'c_number' => [
                'label' => 'Contact Number',
                'rules' => 'required|regex_match[/^(09)\d{9}$/]'
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email'
            ],
            'social_pos' => [
                'label' => 'Social Position',
                'rules' => 'required'
            ],
        ]);

        if (!$validate) {
            return json_encode([
                'code' => 3,
                'msg' => $this->validation->getErrors()
            ]);
        }

        
        $user_id = $this->session->get('id');
        // $user_id = $this->request->getPost('id');

        $data = [
            'fname'          => ucwords($this->request->getPost('fname')),
            'mname'          => ucwords($this->request->getPost('mname')),
            'lname'          => ucwords($this->request->getPost('lname')),
            'municipality'   => ucwords(strtolower($this->request->getPost('municipality'))),
            'barangay'       => ucwords(strtolower($this->request->getPost('barangay'))),
            'zone_street'    => ucwords(strtolower($this->request->getPost('zone'))),
            'contact_number' => $this->request->getPost('c_number'),
            'email'          => $this->request->getPost('email'),
            'social_pos'     => $this->request->getPost('social_pos'),
        ];

        if (!$this->userModel->update_user_info($data, $user_id)) {
            return json_encode([
                'code' => 0,
                'msg' => 'Please try again later!'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => 'Updated Successfuly'
        ]);
    }

    //TODO: Update to server until remove user account fucntion!.
    /**
     Function: DEACTIVATE USER ACCOUNT
     * description: instead of permanently deleteling user account, the system retains
     *              user account by just only deactivating it to protect  importtant
     *              information from other table that connected to user.
     */
    public function deactivate_user($user_code_id)
    {
        $user_data = $this->userModel->get_user($user_code_id);

        $server = base_url();
        $message = "Hello Mr/Ms/Mrs {$user_data->fname} were informing you that your account in {$server} \n";
        $message .= "has been diactivated. Please go to the office and state your code_id or name for Reactivation. \n";
        $message .= "From Agriculrist Office of Bato";

        // TODO: enable this later SMS----------------
        // $this->send_sms->sendSMS($user_data->contact_number, $message);
        return $this->userModel->deactivate_admin_side($user_code_id);
    }

    /**
     Function: RECACTIVATE USER ACCOUNT
     * description: admin can reactivate user account if it is deactivated either admin or user
     */
    function reActivate_user($user_code_id)
    {
        return $this->userModel->activate_user_account($user_code_id);
    }

    /**
     Function: TOTALY DELETE USER ACCOUNT
     * description: admin has only the capality to totaly remove user account in the system
     *              database and it cannot be reactivated.
     */
    function archive_user_account($user_code_id)
    {
        return $this->userModel->archive_account($user_code_id);
    }

    /**
     Function: Update Password
     * Description: Verify current user password and if true update new password
     *              into database
     * @return json: validation errors
     *               code and msg
     */
    public function update_password()
    {

        $validate = $this->validate([
            'o_password' => [
                'label' => 'Current Password',
                'rules' => 'required'
            ],
            'n_password' => [
                'label' => 'New Password',
                'rules' => 'required|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$]',
                'errors' => [
                    'regex_match' => 'New password must atleast 6 characters, include uppercase, lowercase and number'
                ]
            ],
        ]);

        if (!$validate) {
            return json_encode([
                'code' => 3,
                'errors' => $this->validation->getErrors()
            ]);
        }

        $user_id = $this->session->get('id');
        // $user_id = $this->request->getPost('id');
        $user_data = $this->userModel->get_user_info($user_id);

        $old_password = $this->request->getPost('o_password');
        $new_password = password_hash($this->request->getPost('n_password'), PASSWORD_DEFAULT);

        if (!password_verify($old_password, $user_data->password)) {
            return json_encode([
                'code' => 3,
                'errors' => ['error' => 'Current Password Not Match']
            ]);
        }

        if (!$this->userModel->update_user_info(['password' => $new_password], $user_id)) {
            return json_encode([
                'code' => 0,
                'msg' => 'Please try again later!'
            ]);
        }

        return json_encode([
            'code' => 1,
            'msg' => 'Password Updated'
        ]);
    }

    public function deactivate_account()
    {

        $user_id = $this->session->get('id');

        if (!$this->userModel->deactivate($user_id)) {
            return json_encode([
                'code' => 0,
                'msg'  => 'Please try again later'
            ]);
        }

        $user_sessions = ['id', 'logged_in'];
        $this->session->destroy($user_sessions);

        return json_encode([
            'code' => 1
        ]);
    }
}
