<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\Order;

class OrderTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test Data 
     * */
    
    private function orderIdValue(){
        return 123456789123;
    }
    
    
    private function amountValue(){
        return 120;
    }

    private function jsonArrayToTest(){
        
        return array(
            "amount" => $this->amountValue(),
            "orderId" => $this->orderIdValue()
        );
        
    }


    private function orderObject(){
        return new Order( $this->orderIdValue(), $this->amountValue() );
    }

    
     /**
     * Test Data 
     * */
    


    /**
     * Test that the Order Object is well created
     */
    

    public function testOrderObjectCreation(){

        $this->assertInstanceOf( Order::class, $this->orderObject() );

    }

    public function testOrderIdValue(){

        $this->assertEquals( $this->orderIdValue(), $this->orderObject()->getOrderId());

    }
    
    public function testAmountValue(){

        $this->assertEquals( $this->amountValue(), $this->orderObject()->getAmount());

    }


    public function testToJSON(){

        $this->assertEquals( $this->jsonArrayToTest(), json_decode($this->orderObject()->toJSON() , true) );

    }
    
    
    public function testSetters(){
        $orderObj = $this->orderObject();

        $orderObj->setOrderId( "1234" );
        $orderObj->setAmount( "1234" );

        $this->assertEquals( "1234", $orderObj->getOrderId());
        $this->assertEquals( "1234", $orderObj->getAmount());

    }


    
}
