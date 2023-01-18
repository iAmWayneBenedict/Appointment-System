<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code_id',
        'fname',
        'mname',
        'lname',
        'municipality',
        'barangay',
        'zone_street',
        'contact_number',
        'email',
        'social_pos',
        'password'
    ];

    protected $db_conn;

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
        Function: Get all User in Database
     * Description: Use to retrieve all registered user in the database this is for 
     *              admin only to monitor or view all office clients that are registered
     *              to the system
     * @return array : clients data
     */
    public function get_all_users()
    {
        $query = $this->db_conn->table($this->table)
            ->where('account_stats !=', 2)
            ->get();


        return $query->getResultArray();
    }

    /**
        GET USERS TO ARCHIVE
     *  Description: user it not deleted permanently but set it as archive
     *  and it can viewed by admin for record
     */
    public function get_archive_users() {
        $query = $this->db_conn->table($this->table)
            ->where('account_stats', 2)
            ->get();

        return $query->getResultArray();
    }

    /**
       Function : GENERATE UNIQUE ID
     * Description: auto generate unique id using 4 digit number concatinate to prev id from
     *              data 
     * @return int:genrated_id
     */
    public function generated_unique_id()
    {
        /**
         * func: generate unique id(serve as user name) base on previous id in database
         * @return int 4 to up digits number
         */

        $generated_id = null;

        $query = $this->db_conn->table($this->table)
            ->select('id')
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get()
            ->getRowArray();

        if (empty($query)) {
            $generated_id = mt_rand(1000, 9999) . 1;
        } else {
            $id = $query['id'];
            $add_one = $id + 1;
            $generated_id = mt_rand(1000, 9999) . $add_one;
        }

        return $generated_id;
    }

    /**
        Function: GET USER INFO
     * Description : Get users information from database and return to controller
     *               get user info base from user'd id
     */
    public function get_user_info($user_id)
    {

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where('id', $user_id)
            ->get();

        $data = $query->getRow(); //object

        return $data;
    }

     /**
        Function: GET USER INFO by user Code id
     * Description : Get users information from database and return to controller
     *               get user info base from user'd id
     */
    public function get_user($user_code_id)
    {

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where('code_id', $user_code_id)
            ->get();

        $data = $query->getRow(); //object

        return $data;
    }

    /**
     * Function: Update Data
     * Description: Udate user's data in database 
     * @param array $data: collection of uuser information
     * @return bool : indicates if update is success or not
     */
    public function update_user_info(array $data, $user_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $user_id)
            ->update($data);

        return true;
    }

    public function delete_user($user_code_id)
    {

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->delete();

        return true;
    }

    /**
        Function: LOGIN USERS
     * get the user information for login process
     * return 1 single row(array) data of user
     */
    public function login_users($data_arr)
    {

        $query = $this->db_conn->table($this->table)
            ->select('id, code_id, password')
            ->where('code_id', $data_arr['code_id'])
            ->where('account_stats', 1)
            ->get();
        $data = $query->getRow(); //object
        return $data;
    }

    //set user online stats to 1 = indicating active/online
    public function set_online_user($code_id, $user_id = NULL){

        //get current time
        $formatted_date = date("Y-m-d H:i:s", strtotime('now'));

        if($user_id != NULL AND $code_id == NULL){ 
            $this->db_conn->table($this->table)
                ->where('id', $user_id)
                ->update([
                    'online_stats' => 1,
                    'log_time' => $formatted_date
                ]);
        }
        else{
            $this->db_conn->table($this->table)
                ->where('code_id', $code_id)
                ->update([
                    'online_stats' => 1,
                    'log_time' => $formatted_date
                ]);
        }


       
    }

    //set user to logout state or inactive state
    public function set_inActive_user($user_id){
        $query = $this->db_conn->table($this->table)
            ->where('id', $user_id)
            ->update([
                'online_stats' => 0
        ]);
    }

    //get user in the database that have a log_time of less than 1 minute in current time
    public function get_inactive_logtime(){
        //get current date then subtract to 1 minute
        $time =  date('Y-m-d H:i', strtotime('-1 minute'));

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where("DATE_FORMAT(log_time, '%Y-%m-%d %H:%i') <=", $time)
            ->where('online_stats', 1)
            ->get();

        $inactive_logtime = $query->getResultObject();
        return $inactive_logtime;
    }
    /**
        MANAGE ACCOUNT SECTION
     */
    
    public function deactivate($user_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $user_id)
            ->update([
                'account_stats' => 0
            ]);

        return true;
    }

    public function deactivate_admin_side($user_code_id)
    {

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->update([
                'account_stats' => 0
            ]);

        return true;
    }

    public function activate_user_account($user_code_id)
    {

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->update([
                'account_stats' => 1
            ]);

        return true;
    }

    /**
     Archive user
     * instead of permanent deleting the user account the system retain it as an archive
     * but the account is not active anymore for logging in
     * 2 = archive
     */
    public function archive_account($user_code_id){

        $this->db_conn->table($this->table)
            ->where('code_id', $user_code_id)
            ->update([
                'account_stats' => 2
            ]);
        
            return true;
    }

    //count all registered users
    public function count_all_users(){
        
        $query = $this->db_conn->table($this->table)->countAllResults();
        
        return $query;
    }

    //count all active users account
    public function count_active_users(){
        
        $query = $this->db_conn->table($this->table)
            ->where('account_stats', 1)
            ->countAllResults();
        
        return $query;
    }

    //count all currently online users
    public function count_online_users(){
        
        $query = $this->db_conn->table($this->table)
            ->where('account_stats', 1)
            ->where('online_stats', 1)
            ->countAllResults();
        
        return $query;
    }
}
