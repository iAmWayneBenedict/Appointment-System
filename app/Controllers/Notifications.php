<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\OnAppNotification;
use App\Models\OnAppNotifModel;

class Notifcations extends BaseController{

    protected $app_notif;
    protected $notif_model;

    function __construct()
    {
        $this->app_notif = new OnAppNotification();
        $this->notif_model = new OnAppNotifModel;
    }

    /**
     Fucntion: DELETE AFTER 30 DAYS
     * description: Delete messages from database after 30 days
     *              this will help clean tha table for unused data such as 
     *              notifcations
     NOte: This function should call via corn job once a month or every 26th day of month
     * @return message
     */
    public function delete_after_30_days(){

        if($this->notif_model->delete_onapp_messages()){
            return 'Messages Clean';
        }
        
    }
}