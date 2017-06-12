<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Output extends CI_Output
{
    public static $errorCodes = array(
        'incorrect_response_parameter' => 20002,
        'get_resource_failed' => 20003,
        'access_frequency_restrict' => 20004,
    );
    function jsonpError($error='unkown_error', $errorDescription='Please setting error correctly')
    {
        $errorCode = isset(self::$errorCodes[$error])? self::$errorCodes[$error]: 20001;
        $return = array(
            'error' => $error,
            'error_code' => $errorCode,
            'error_description' => $errorDescription
        );
        $this->jsonpOutput($return);
    }
    function jsonpSuccess($data=null)
    {
        $return = array(
            'error' => 'success',
            'error_code' => 0,
            'error_description' => 'success',
            'data' => $data
        );
        $this->jsonpOutput($return);
    }
    function jsonpOutput($data)
    {
        $json = json_encode($data);
        exit(isset($_GET['callback'])? $_GET['callback'].'('.json_encode($data).')': $json);
    }
}
