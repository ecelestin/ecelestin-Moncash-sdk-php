<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\PaymentToken;

class PaymentTokenTest extends \PHPUnit\Framework\TestCase
{

    private function paymentTokenArrayValue(){
        return array(
            "expired" => "12Avril1970",
            "created" => "12Avril1971",
            "token" => "CogitoErgoSum",
        );
    }

    private function paymentTokenObject(){
        return new PaymentToken( $this->paymentTokenArrayValue());
    }
    /**
     * Test that true does in fact equal true
     */
    public function testPaymentTokenObjectCreation(){
        
        $this->assertInstanceOf( PaymentToken::class, $this->paymentTokenObject());

    }


    public function testExpiredValue(){
        $this->assertEquals( $this->paymentTokenArrayValue()["expired"], $this->paymentTokenObject()->getExpired() );
    }
    
    
    public function testCreatedValue(){
        $this->assertEquals( $this->paymentTokenArrayValue()["created"], $this->paymentTokenObject()->getCreated() );
    }
    
    
    public function testTokenValue(){
        $this->assertEquals( $this->paymentTokenArrayValue()["token"], $this->paymentTokenObject()->getToken() );
    }
}
