<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\PaymentDetails;
use DGCGroup\MonCashPHPSDK\PaymentToken;

class PaymentDetailsTest extends \PHPUnit\Framework\TestCase{

    private function paymentTokenArrayValue(){
        return array(
            "expired" => "12Avril1970",
            "created" => "12Avril1971",
            "token" => "CogitoErgoSum",
        );
    }

    private function paymentTokenObject(){

        return new PaymentToken($this->paymentTokenArrayValue());

    }

    private function paymentDetailsArrayValue(){

        return array(
            "mode" => "sanbox",
            "path" => "/Api/v1/CreatePayment",
            "payment_token" => $this->paymentTokenObject(),
            "timestamp" => 1560215766826,
            "status" => 202
        );
    }


    private function payementDetailsObject(){
        return new PaymentDetails($this->paymentDetailsArrayValue());
    }
    /**
     * Test that true does in fact equal true
     */

    
    public function testPaymentDetailsObjectCreation(){
        $this->assertInstanceOf( PaymentDetails::class, $this->payementDetailsObject() );
    }


    public function testModeValue(){

        $this->assertEquals( $this->paymentDetailsArrayValue()["mode"], $this->payementDetailsObject()->getMode());
        
    }
    
    public function testPathValue(){

        $this->assertEquals( $this->paymentDetailsArrayValue()["path"], $this->payementDetailsObject()->getPath());

    }
    
    public function testTimeStampValue(){

        $this->assertEquals( $this->paymentDetailsArrayValue()["timestamp"], $this->payementDetailsObject()->getTimeStamp());

    }
    
    
    public function testStatusValue(){

        $this->assertEquals( $this->paymentDetailsArrayValue()["status"], $this->payementDetailsObject()->getStatus());

    }
    
    
    public function testPaymentTokenValue(){

        $this->assertInstanceOf( PaymentToken::class, $this->payementDetailsObject()->getPaymentToken());
        $this->assertEquals( $this->paymentDetailsArrayValue()["payment_token"]->getExpired(), $this->payementDetailsObject()->getPaymentToken()->getExpired());
        $this->assertEquals( $this->paymentDetailsArrayValue()["payment_token"]->getCreated(), $this->payementDetailsObject()->getPaymentToken()->getCreated());
        $this->assertEquals( $this->paymentDetailsArrayValue()["payment_token"]->getToken(), $this->payementDetailsObject()->getPaymentToken()->getToken());

    }
}
