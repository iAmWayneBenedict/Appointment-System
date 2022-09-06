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
    public $itextMo_url = 'https://www.itexmo.com/php_api/api.php';


    /**
     * description: onewaysms config settings
     */

    // api user given from the account
    public $api_username = '';

    //api password from the account
    public $api_password = '';

    //from it can be (sender name or sender number)
    public $sms_from = '';

    //MT URL port 10001
    public $gw_url = 'http://gateway.onewaysms.ph:10001/api.aspx?';

    //MT URL (port 80) 	 
    public $gw_url2 = 'http://gateway80.onewaysms.ph/api2.aspx?';

    //MT URL (port 443) 	
    public $gw_url3 = 'https://sgateway.onewaysms.com/apis10.aspx?';


    /**
     * semaphore sms
     */

}
