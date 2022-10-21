<?php

namespace App\Models;

use CodeIgniter\Model;

class OnAppNotifModel extends Model
{
    protected $db_conn;
    protected $table = 'app_notification';

    function __construct()
    {
        $this->db_conn = \Config\Database::connect();
    }

    /**
     * Function: Insert message(send)
     * Description: This is use to insert messages to database table
     * @param array_data : this is the message body to been by clients
     * @return boolean true or false
     */
    public function insert_message(array $data)
    {

        $this->db_conn->table($this->table)
            ->insert($data);
        return true;
    }


    /**
     * Function: Update
     * Description: Update the status of message this will indicate the if the message
     *              is already read or not
     * @param nootification_id : unique number per message
     */
    public function update_status($notification_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $notification_id)
            ->update([
                'status' => 1
            ]);
        return true;
    }

    /**
     * Function: Delete
     * description: This is to permanently delete app notification
     * @param nootification_id : unique number per message
     */
    public function delete_notification($notification_id)
    {

        $this->db_conn->table($this->table)
            ->where('id', $notification_id)
            ->delete();
        return true;
    }

    public function get_notifications($client_id)
    {

        $query = $this->db_conn->table($this->table)
            ->select('*')
            ->where('user_id', $client_id)
            ->get();

        $data = $query->getResultObject();
        return $data;
    }

    /**
     * // TODO: This admin notify
     PART: ADMIN--------------------------------------->
     */

    public function admin_insert_message($message)
    {
        $this->db_conn->table('adminApp_notification')
            ->insert([
                'message' => $message
            ]);

        return true;
    }

    public function admin_get_notification()
    {

        $data = $this->db_conn->table('adminApp_notification')
            ->select('*')
            ->get();

        $messages = $data->getResultObject();
        return $messages;
    }

    public function update_status_admin($notification_id)
    {

        $this->db_conn->table('adminApp_notification')
            ->where('id', $notification_id)
            ->update([
                'is_read' => 1
            ]);

        return true;
    }

    /**
     Function: DELETE ON APP MESSAGES
     * description:  this function delete messages from table that are
     *               30 days old
     */
    public function delete_onapp_messages()
    {

        //delete messages from client side
        $this->db_conn->table($this->table)
            ->where('sent_date < now() - interval 30 DAY')
            ->delete();

        //delete messages from admin side
        $this->db_conn->table('adminApp_notification')
            ->where('c_date < now() - interval 30 DAY')
            ->delete();

        return true;
    }
}
