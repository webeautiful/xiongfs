<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Service
{
    public function __construct()
    {
        log_message('info', "Service Class Initialized");
    }

    function __get($key)
    {
        $CI = & get_instance();
        return $CI->$key;
    }
}
