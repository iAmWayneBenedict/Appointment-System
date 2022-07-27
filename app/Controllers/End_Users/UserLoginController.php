<?php

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserLoginController extends BaseController{

    public function index(){
        return view('end-user/login');
    }

    public function login_user(){
        $validators = \Config\Services::validation();
        $session = session();
        $user_model = new UserModel();

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

        if(!$validator){
            $session->setFlashdata('form-error', $this->validator);
            return redirect()->back();
        }
        else{
            $login_data = [
                'user_id' => $this->request->getPost('user_id'),
                'password' => $this->request->getPost('password')
            ];

            $user_data = $user_model->login_users($login_data);

            if(empty($user_data)){
                $session->setFlashdata('invalid', 'User Id not found');
                return redirect()->back();
            }

            if(!password_verify($login_data['password'], $user_data->password)){
                $session->setFlashdata('invalid', 'Invalid Password');
                return redirect()->back();
            }

            return redirect('user/register');


        }
    }
}