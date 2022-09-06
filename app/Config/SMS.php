<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class SMS extends BaseConfig
{

    /**
     * description: twillo configuration settings
     */


    // Mode 
    public $mode = 'sandbox';

    // Account SID
    public $account_sid = '';

    // Auth Token 
    public $auth_token = '';

    // Api Version
    public $api_version = '2010-04-01';

    // Purchased / or twillo account registered number +63 10digit
    public $number = '+15735334219';


    /**
     * description: I text mo sms config settings
     */

    //itext mo api register api code
    public $api_code = "TR-WAYNE891000_TI2CL";


    public $itextMo_password = "BLackMama447";

    //itext mo api url (send sms)
    public $itextMo_url = "https://www.itexmo.com/php_api/api.php";
}
