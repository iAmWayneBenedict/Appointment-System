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
}
