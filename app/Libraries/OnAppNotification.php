<?php

namespace App\Libraries;

use App\Models\OnAppNotifModel;

class OnAppNotification {

    protected $notif_model;

    function __construct()
    {
        $this->notif_model = new OnAppNotifModel();
    }

    /**
     * Function: Get and process message(send)
     * Description: This is use to insert messages to database table
     * @param to_id : clinet who will recieve the message
     * @param message : this is the message body to been by clients
     * @return boolean true or false
     */
    public function sent_app_notification($to_id, $message){

        $data = [
            'user_id' => $to_id,
            'message' => $message
        ];

        return $this->notif_model->insert_message($data);

    }

    public function send_bulk_notification(array $to_ids, $message){

        foreach($to_ids as $id){
            $data = [
                'user_id' => $id,
                'message' => $message
            ];

            $this->notif_model->insert_message($data);
        }
       

        return true;

    }

    public function already_read($notification_id){
        $this->notif_model->update_status($notification_id);
    }

    public function delete_message($notification_id){
        $this->notif_model->delete($notification_id);
    }

    public function get_client_notification($client_id = NULL){

        $data['notifications'] = $this->notif_model->get_notifications($client_id);

       // return view('notification page or something', $data);
                        //OR return data only
        // return $data;

    }

    //TODO : admin notification

    public function notify_admin($message){
        return $this->notif_model->admin_insert_message($message);
    }

    public function get_admin_messages(){
        $data_msg = $this->notif_model->admin_get_notification();
        return $data_msg;
    }
    
}