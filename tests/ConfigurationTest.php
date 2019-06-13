<?php

namespace DGCGroup\MonCashPHPSDK;

use DGCGroup\MonCashPHPSDK\Constants;
use DGCGroup\MonCashPHPSDK\Configuration;


class ConfigurationTest extends \PHPUnit\Framework\TestCase
{

    public function prodConfigArray(){
        return array(
            "config_type" => Constants::$LIVE,
            "redirect" => Constants::$LIVE_REDIRECT,
            "rest_api_endpoint" => Constants::$REST_LIVE_ENDPOINT,
        );
    }


    public function sanboxConfigArray(){
        return array(
            "config_type" => Constants::$SANDBOX,
            "redirect" => Constants::$SANDBOX_REDIRECT,
            "rest_api_endpoint" => Constants::$REST_SANDBOX_ENDPOINT,
        );
    }

    /**
     * Test that the rights informations for the Production 
     *  SDK configurations are retured
     */
    public function testGetProdConfigs()
    {
        $this->assertArrayHasKey('config_type', $this->prodConfigArray());
        $this->assertArrayHasKey('redirect', $this->prodConfigArray());
        $this->assertArrayHasKey('rest_api_endpoint', $this->prodConfigArray());


        $this->assertEquals($this->prodConfigArray()['config_type'], Configuration::getProdConfigs()['config_type']);
        $this->assertEquals($this->prodConfigArray()['redirect'], Configuration::getProdConfigs()['redirect']);
        $this->assertEquals($this->prodConfigArray()['rest_api_endpoint'], Configuration::getProdConfigs()['rest_api_endpoint']);
    }
    
    

    /**
     * Test that the rights informations for the Sandbox 
     *  SDK configurations are retured
     */
    public function testGetSandboxConfigs()
    {
        $this->assertArrayHasKey('config_type', $this->sanboxConfigArray());
        $this->assertArrayHasKey('redirect', $this->sanboxConfigArray());
        $this->assertArrayHasKey('rest_api_endpoint', $this->sanboxConfigArray());


        $this->assertEquals($this->sanboxConfigArray()['config_type'], Configuration::getSandboxConfigs()['config_type']);
        $this->assertEquals($this->sanboxConfigArray()['redirect'], Configuration::getSandboxConfigs()['redirect']);
        $this->assertEquals($this->sanboxConfigArray()['rest_api_endpoint'], Configuration::getSandboxConfigs()['rest_api_endpoint']);
    }
}
