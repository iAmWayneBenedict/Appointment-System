<?php

namespace App\Controllers\End_Users;
use App\Models\UserModel;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index(){
        return view('end-user/register');
    }

    public function display_reminder_information($user_id = false){
        //add filter for this controller 
        //do not continue if current_url is not in register page
        $user_model = new UserModel();

        $data['user_informations'] = $user_model->get_user_info($user_id);

        return view('end-user/reminder', $data);
    }

    public function generate_user_id(){
        /**
         * Func: make unique user_id for users when registering
         * return: 6 digit number.
         */
        return UserModel::generated_unique_id();
    }

    public function register_user(){
        $validation = \Config\Services::validation();

        $validate = $this->validate([
            'user_id' => [
                'label' => 'User Id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'This is important'
                ]
            ],
            'name' => [
                'rules' => 'required|alpha_space'
            ],
            'address' => [
                'rules' => 'required'
            ], 
            'number' => [
                'rules' => 'required|regex_match[/^(09)\d{9}$/]',
            ],
            'identity' => [
                'rules' => 'required'
            ],
            'password' => [
                'rules' => 'required|min_length[6]'
            ]
        ]);

        if(!$validate){
            //return array of errors to ajax
            return json_encode([
                'code' => 0,
                'errors' => $validation->getErrors()
            ]);
        }
        else{

            $user_model = new UserModel();
            $generated_code = $this->request->getPost('user_id');
            $user_data = [
                'user_id'   => $this->request->getPost('user_id'),
                'name'      => $this->request->getPost('name'),
                'email'     => $this->request->getPost('email'),
                'number'    => $this->request->getPost('number'),
                'identity'  => $this->request->getPost('identity'),
                'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) 
            ];

            if($user_model->insert($user_data)){
                return json_encode([
                    'code' => 1,
                    'user_id' => $generated_code
                ]);
            }
            else{
                // internal error
                return json_encode([
                    'code' => 500
                ]);
            }
        }
    }
}