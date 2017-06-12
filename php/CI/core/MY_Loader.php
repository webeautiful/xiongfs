<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Loader extends CI_Loader {

    //service path
    protected $_ci_services_paths = array(APPPATH);

    //service class
    protected $_ci_services = array();



    public function __construct() {
        parent::__construct ();
    }

    /**
    * Service Loader
    *
    * This function lets users load and instantiate classes.
    * It is designed to be called from a user's app controllers.
    *
    * @param    string  the name of the class
    * @param    mixed   the optional parameters
    * @param    string  an optional object name
    * @return   object
    */
    public function service($service = '', $params = NULL, $object_name = NULL)
    {
        if (empty($service))
        {
            return $this;
        }
        else if(is_array($service))
        {
            //Is the service is an array?If so,load every key
            foreach ($service as $key => $value)
            {
                is_int($key) ? $this->service($value, '', $object_name) : $this->service($key, $value, $object_name);
            }

            return $this;
        }

        $path = '';

        // Is the service in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($service, '/')) !== FALSE)
        {
            // The path is in front of the last slash
            $path = substr($service, 0, ++$last_slash);

            // And the service name behind it
            $service = substr($service, $last_slash);
        }

        if (empty($object_name))
        {
            $object_name = $service;
        }

        $object_name = strtolower($object_name);
        if (in_array($object_name, $this->_ci_services, TRUE))
        {
            return $this;
        }

        $CI =& get_instance();
        if (isset($CI->$object_name))
        {
            throw new RuntimeException('The service name you are loading is the name of a resource that is already being used: '.$object_name);
        }

        //load MY_Service
        $class = config_item('subclass_prefix').'Service';
        $app_path = APPPATH.'core'.DIRECTORY_SEPARATOR;

        if(!class_exists($class, FALSE))
        {
            if (file_exists($app_path.$class.'.php'))
            {
                require_once($app_path.$class.'.php');
                if (!class_exists($class, FALSE))
                {
                    throw new RuntimeException($app_path.$class.".php exists, but doesn't declare class ".$class);
                }
            }
        }

        $service = ucfirst($service);
        if (!class_exists($service, FALSE))
        {
            //load service files
            foreach ($this->_ci_services_paths as $service_path)
            {
                if ( ! file_exists($service_path.'services/'.$path.$service.'.php'))
                {
                    continue;
                }
                //default path application/services/
                include_once($service_path.'services/'.$path.$service.'.php');

                $CI = &get_instance();

                if($params !== NULL)
                {
                    $CI->$object_name = new $service($params);
                }
                else
                {
                    $CI->$object_name = new $service();
                }

                $this->_ci_services[] = $object_name;

                if (!class_exists($service, FALSE))
                {
                    throw new RuntimeException($service_path."services/".$path.$service.".php exists, but doesn't declare class ".$service);
                }

                break;
            }

        }

        return $this;
    }
}
