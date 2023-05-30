<?php

namespace DGCGroup\MonCashPHPSDK;


use DGCGroup\MonCashPHPSDK\Credentials;
use DGCGroup\MonCashPHPSDK\Configuration;


class CredentialsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Class dummy data 
     * */
    public function clientValue(){
        return "";
    }


    public function secretValue(){
        return "";
    }


    public function credentialsObject (){
        return new Credentials( $this->clientValue(), $this->secretValue() , $this->configArray() );
    }

    public function configArray(){
        return Configuration::getSandboxConfigs();
    }

    public function authResponseFormat(){
        return array(
            "access_token" => "val",
            "token_type" => "val",
            "expires_in" => "val",
            "scope" => "val",
            "jti" => "val"
        );
    }

    /**
     * Class dummy data 
     * */


    /**
     * Test that Credentials Object is created the right way
     */
    public function testCredentialsObjectCreation()
    {
        $this->assertInstanceOf( Credentials::class, $this->credentialsObject());
    }


    /**
     * Test that Credentials client set while the  Object is created 
     */
    public function testClientValue(){
        $this->assertEquals( $this->clientValue(), $this->credentialsObject()->getClient());
    }


    /**
     * Test that Credentials secret set while the  Object is created 
     */
    public function testSecretValue(){
        $this->assertEquals( $this->secretValue(), $this->credentialsObject()->getSecret());
    }


    /**
     * Test that Credentials configValue set while the  Object is created 
     */
    public function testConfigValue(){
        $this->assertEquals( $this->configArray(), $this->credentialsObject()->getConfigArray());
    }



    /**
     * Test that Credentials setters are working properly 
     */
    public function testSettersClass(){
        $credObj = $this->credentialsObject();

        $credObj->setClient( "abcd" );
        $credObj->setSecret( "abcd" );
        $credObj->setConfigArray( array("abcd","abcd","abcd") );

        $this->assertEquals( "abcd" , $credObj->getClient());
        $this->assertEquals( "abcd" , $credObj->getSecret());
        $this->assertEquals( array("abcd","abcd","abcd") , $credObj->getConfigArray());
    }

    public function testGetAuthorizationInformations(){
        $credObj = $this->credentialsObject();

        $this->assertArrayHasKey("access_token", $credObj->getAuthorizationInformations());
        $this->assertArrayHasKey("token_type", $credObj->getAuthorizationInformations());
        $this->assertArrayHasKey("expires_in", $credObj->getAuthorizationInformations());
        $this->assertArrayHasKey("scope", $credObj->getAuthorizationInformations());
        $this->assertArrayHasKey("jti", $credObj->getAuthorizationInformations());
    }
}
