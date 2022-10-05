<?php

namespace App\Controllers\End_Users;

use App\Controllers\BaseController;

use App\Models\UserModel;
use PHPUnit\Util\Json;

class ManageAccount extends BaseController
{

    protected $userModel;
    protected $session;
    protected $encrypter;
    protected $validation;

    function __construct()
    {
        //instantiate
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->encrypter = \Config\Services::encrypter();
        $this->validation = \Config\Services::validation();
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
            'name' => [
                'rules' => 'required'
            ],
            'address' => [
                'label' => 'address',
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
            return json_encode($this->validation->getErrors());
        }

        $user_id = $this->session->get('id');

        $data = [
            'name'           => $this->request->getPost('name'),
            'address'        => $this->request->getPost('address'),
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

    /**
     Function: DEACTIVATE USER ACCOUNT
     * description: instead of permanently deleteling user account, the system retains
     *              user account by just only deactivating it to protect  importtant
     *              information from other table that connected to user.
     */
    function delete_user($user_code_id)
    {
        return $this->userModel->deactivate_admin_side($user_code_id);
    }

    /**
     * Function: Update Password
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
                    'regex_match' => 'Password must atleast 6 characters, include uppercase, lowercase and number'
                ]
            ],
        ]);

        if (!$validate) {
            return json_encode($this->validation->getErrors());
        }

        $user_id = $this->session->get('id');
        $user_data = $this->userModel->get_user_info($user_id);

        $old_password = $this->request->getPost('o_password');
        $new_password = password_hash($this->request->getPost('n_password'), PASSWORD_DEFAULT);

        if (!password_verify($old_password, $user_data->password)) {
            return json_encode('Current password not match');
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
