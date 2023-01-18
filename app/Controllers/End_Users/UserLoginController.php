<?php

/**
 * use for login process 
 */

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserLoginController extends BaseController
{

    protected $userModel;
    protected $session;

    function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index()
    {
        return view('end-user/login');
    }

    /**
     * func: Login process, validate data
     * @return redirect with session flashData for validation message
     * @return redirect to dashboard if login success
     */
    public function login_user()
    {

        $validator = $this->validate([
            'user_id' => [
                'label' => 'User Id',
                'rules' => 'required'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ]);

        if (!$validator) {
            $this->session->setFlashdata('form-error', $this->validator);
            return redirect()->back();
        } else {

            $login_data = [
                'code_id' => $this->request->getPost('user_id'),
                'password' => $this->request->getPost('password')
            ];

            //check if input username is present/existing
            $user_data = $this->userModel->login_users($login_data);

            if (empty($user_data)) {
                $this->session->setFlashdata('invalid', 'User Id not found');
                return redirect()->back();
            }

            //compare input password and password from database
            if (!password_verify($login_data['password'], $user_data->password)) {
                $this->session->setFlashdata('invalid', 'Invalid Password');
                return redirect()->back();
            }

            // create session for filter and accessing dashboard
            $this->session->set([
                'id' => $user_data->id,
                'logged_in' => TRUE
            ]);

            $this->userModel->set_online_user($login_data['code_id']);

            // it should be user dashboard
            return redirect('user/dashboard');
        }
    }

    public function logout_user()
    {

        $user_sessions = ['id', 'logged_in'];

        //set user to inactive before session destroy
        $this->userModel->set_inActive_user($this->session->get('id'));

        $this->session->destroy($user_sessions);

        return redirect()->to('/user/login');
    }

    // update users logtime every 10 seconds, this function is call using ajax
    public function update_users_logtime(){
        $user_id = $this->session->get('id');

        $this->userModel->set_online_user(NULL, $user_id);
    }

    //for cron job
    public function auto_logout_user(){
       $inactive_users = $this->userModel->get_inactive_logtime();

       foreach($inactive_users as $users_logtime){
            $this->userModel->set_inActive_user($users_logtime->id);
       }
    }
}
