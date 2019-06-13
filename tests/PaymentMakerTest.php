<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\PaymentMaker;
use DGCGroup\MonCashPHPSDK\Order;
use DGCGroup\MonCashPHPSDK\Configuration;
use DGCGroup\MonCashPHPSDK\Credentials;
use DGCGroup\MonCashPHPSDK\PaymentToken;
use DGCGroup\MonCashPHPSDK\PaymentDetails;

class PaymentMakerTest extends \PHPUnit\Framework\TestCase
{
    private function orderObject(){

        return new Order(1234567891234, 150);

    }

    public function clientValue(){
        return "c1bf0a27d6bbb217a599c9e25480c11d";
    }


    public function secretValue(){
        return "oHrr4tbnB1PH0uz6VQNUvVVDNVNvk0WiIXZWBAed4-CBCwilT8yUdS87AZoPrtqN";
    }

    public function credentialsObject (){
        return new Credentials( $this->clientValue(), $this->secretValue() , $this->configArray() );
    }


    private function configArray(){

        return Configuration::getSandboxConfigs();

    }


    private function paymentMakerObject(){
        return new PaymentMaker( $this->orderObject(), $this->credentialsObject(), $this->configArray() );
    }

    private function paymentCreatorResponseFormat(){
        return array(
            "mode" => "val",
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
    /**
     * Test that true does in fact equal true
     */
    // public function testTrueIsTrue()
    // {
    //     $this->assertTrue(true);
    // }


    public function testPaymentMakerObjectCreation(){

        $this->assertInstanceOf( PaymentMaker::class, $this->paymentMakerObject() );

    }

    public function testOrderValue(){
        $orderObject = $this->paymentMakerObject()->getOrderObj();

        $this->assertInstanceOf( Order::class , $orderObject);
        $this->assertEquals( $this->orderObject()->getOrderId(), $orderObject->getOrderId() );
        $this->assertEquals( $this->orderObject()->getAmount(), $orderObject->getAmount() );

    }


    public function testConfigArray(){
        
        $this->assertEquals( $this->configArray(), $this->paymentMakerObject()->getConfigArray());

    }



    public function testMakePayment(){

        $paymentResponse = $this->paymentMakerObject()->makePayment();

        $this->assertArrayHasKey( "mode", $paymentResponse);
        $this->assertArrayHasKey( "path", $paymentResponse);
        $this->assertArrayHasKey( "payment_token", $paymentResponse);
        $this->assertArrayHasKey( "timestamp", $paymentResponse);
        $this->assertArrayHasKey( "status", $paymentResponse);
        $this->assertArrayHasKey( "created", $paymentResponse["payment_token"]);
        $this->assertArrayHasKey( "token", $paymentResponse["payment_token"]);

    }


    public function testStaticMakePaymentRequest(){

        $paymentDetails = PaymentMaker::makePaymentRequest( $this->orderObject(), $this->credentialsObject(), $this->configArray());

        $this->assertInstanceOf( PaymentDetails::class, $paymentDetails);
        $this->assertInstanceOf( PaymentToken::class, $paymentDetails->getPaymentToken() );        

    }



}
