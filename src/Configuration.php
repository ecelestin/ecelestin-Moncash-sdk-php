<?php

namespace DGCGroup\MonCashPHPSDK;

use DGCGroup\MonCashPHPSDK\Constants;

class Configuration
{
   /**
     * Static function returning the required config variables and uri for Production environment welcome
     *
     * @param string no params
     *
     * @return string Returns the associative array that returns the required values
     */

    public static function getProdConfigs(){
        return array(
            "config_type" => Constants::$LIVE,
            "redirect" => Constants::$LIVE_REDIRECT,
            "rest_api_endpoint" => Constants::$REST_LIVE_ENDPOINT,
        );
    }


    
    /**
     * Static function returning the required config variables and uri for Sanbox environment welcome
     *
     * @param string no params
     *
     * @return string Returns the associative array that returns the required values
     */

    public static function getSandboxConfigs(){


        return array(
            "config_type" => Constants::$SANDBOX,
            "redirect" => Constants::$SANDBOX_REDIRECT,
            "rest_api_endpoint" => Constants::$REST_SANDBOX_ENDPOINT,
        );
    }
}
