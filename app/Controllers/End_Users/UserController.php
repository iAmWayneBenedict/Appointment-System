<?php

namespace App\Controllers\End_Users;
use App\Models\UserModel;
use App\Libraries\NumberFormater;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    protected $user_model;
    protected $validation;
    protected $number_formater;

    function __construct()
    {
        $this->user_model = new UserModel();
        $this->validation = \Config\Services::validation();
        //$this->number_formater = new NumberFormater();
    }
 
    public function index(){
        return view('end-user/register');
    }

    public function display_reminder_information($user_id = false){
        //add filter for this controller 
        //do not continue if current_url is not in register pag

        $data['user_informations'] = $this->user_model->get_user_info($user_id);

        return view('end-user/reminder', $data);
    }

    public function generate_user_id(){
        /**
         * Func: make unique user_id for users when registering
         * @return int : 6 digit number.
         */
        return UserModel::generated_unique_id();
    }

    public function register_user(){

        $validate = $this->validate([
            'user_id' => [
                'label' => 'User Id',
                'rules' => 'required',
                'errors' => [
                    'required' => 'This is important'
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email|is_unique[users.email]'
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
            // return array of errors to ajax
            return json_encode([
                'code' => 0,
                'errors' => $this->validation->getErrors()
            ]);
        }


        $generated_code = $this->request->getPost('user_id');
        $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        
        
        //number formater if need to start +63
        // $formated_number = $this->number_formater
        //         ->format_number($this->request->getPost('number'));
        
        // get the inputed data from the register form page 
        // arranged to an array for inserting to database

        $user_data = [
            'code_id'           => $this->request->getPost('user_id'),
            'name'              => $this->request->getPost('name'),
            'address'           => $this->request->getPost('address'),
            'contact_number'    => $this->request->getPost('number'),
            'email'             => $this->request->getPost('email'),
            'identity'          => $this->request->getPost('identity'),
            'password'          => $password
        ];

        if(!$this->user_model->insert($user_data)){
            // internal error
            return json_encode([
                'code' => 500
            ]);
        }
       
        // code 1 indicates true or successful inserted into database
        return json_encode([
            'code' => 1,
            'user_id' => $generated_code
        ]);
    }
}