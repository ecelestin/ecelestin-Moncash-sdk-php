<?php


namespace s2tel\mc_php_sdk;
use s2tel\mc_php_sdk\PaymentClass;

class PaymentClassTest extends \PHPUnit\Framework\TestCase
{
    /**
     *
     */

    public function clientCredentialsInformations(){
        return array(
            "client" => "c1bf0a27d6bbb217a599c9e25480c11d",
            "secret" => "oHrr4tbnB1PH0uz6VQNUvVVDNVNvk0WiIXZWBAed4-CBCwilT8yUdS87AZoPrtqN"
        );
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


    public function paymentCreatorResponseFormat(){
        return array(
            "path" => "val",
            "payment_token" => array(
                "expired" => "val",
                "created" => "val",
                "token" => "val",
            ),
            "timestamp" => "val",
            "status" => "val"
        );
    }


    public function paymentDetails(){
        return array(
            "amount" => 100,
            "orderId" => 123456
        );
    }


    public function testAuthResponse(){
        $paymentOBJ = new PaymentClass($this->clientCredentialsInformations()["client"], $this->clientCredentialsInformations()["secret"]);

        $authoInfos = $paymentOBJ->getAuthorizationInformations();
        $authoInfos = json_decode($authoInfos, true);


        $this->assertArrayHasKey("access_token", $authoInfos);
        $this->assertArrayHasKey("token_type", $authoInfos);
        $this->assertArrayHasKey("expires_in", $authoInfos);
        $this->assertArrayHasKey("scope", $authoInfos);
        $this->assertArrayHasKey("jti", $authoInfos);

    }



    public function testPaymentCreatorResponse(){
        $paymentOBJ = new PaymentClass($this->clientCredentialsInformations()["client"], $this->clientCredentialsInformations()["secret"]);

        $paymentCreator = $paymentOBJ->makePaymentRequest($this->paymentDetails()["amount"], $this->paymentDetails()["orderId"]);

        $this->assertStringStartsWith("http",$paymentCreator);
    }
}