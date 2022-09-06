<?php

/**
 * use for login process 
*/

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserLoginController extends BaseController{

    protected $userModel;
    protected $session;

    function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function index(){
        return view('end-user/login');
    }

    /**
     * func: Login process, validate data
     * @return redirect with session flashData for validation message
     * @return redirect to dashboard if login success
     */
    public function login_user(){

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

        if(!$validator) {
            $this->session->setFlashdata('form-error', $this->validator);
            return redirect()->back();
        }
        else {

            $login_data = [
                'code_id' => $this->request->getPost('user_id'),
                'password' => $this->request->getPost('password')
            ];

            $user_data = $this->userModel->login_users($login_data);

            if(empty($user_data)){
                $this->session->setFlashdata('invalid', 'User Id not found');
                return redirect()->back();
            }

            //compare input password and password from database
            if(!password_verify($login_data['password'], $user_data->password)){
                $this->session->setFlashdata('invalid', 'Invalid Password');
                return redirect()->back();
            }

            // create session for filter and accessing dashboard
            $this->session->set([
                'id' => $user_data->id,
                'logged_in' => TRUE
            ]);

            // it should be user dashboard
            return redirect('user/dashboard');

        }
    }

    public function logout_user(){
    
        $user_sessions = ['id', 'logged_in'];
        $this->session->destroy($user_sessions);

        return redirect()->to('/user/login'); 
    }
}