<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\TransactionDetails;
use DGCGroup\MonCashPHPSDK\TransactionCaller;
use DGCGroup\MonCashPHPSDK\TransactionPayment;
use DGCGroup\MonCashPHPSDK\Constants;
use DGCGroup\MonCashPHPSDK\Configuration;

class TransactionCallerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Test that true does in fact equal true
     */

    private function orderObject(){

        return new Order(1559794111, 150);

    }
    
    private function transactionID(){

        return 12874819;

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

    private function transactionCallerObject(){
        return new TransactionCaller( $this->orderObject(), $this->credentialsObject(), $this->configArray() );
    }

    public function testTransactionCallerObjectCreation(){
        $this->assertInstanceOf( TransactionCaller::class, $this->transactionCallerObject());
    }

    public function testOrderValue(){
        $orderObject = $this->transactionCallerObject()->getOrderObj();

        $this->assertInstanceOf( Order::class , $orderObject);
        $this->assertEquals( $this->orderObject()->getOrderId(), $orderObject->getOrderId() );
        $this->assertEquals( $this->orderObject()->getAmount(), $orderObject->getAmount() );

    }


    public function testConfigArray(){
        
        $this->assertEquals( $this->configArray(), $this->transactionCallerObject()->getConfigArray());

    }


    public function testGetTransactionDetailsByTransactionId()
    {
        $transactionArray = $this->transactionCallerObject()->getTransactionDetailsByTransactionId($this->transactionId());
        $this->assertArrayHasKey( "path", $transactionArray );
        $this->assertArrayHasKey( "payment", $transactionArray );
        $this->assertArrayHasKey( "timestamp", $transactionArray );
        $this->assertArrayHasKey( "status", $transactionArray );
        $this->assertArrayHasKey( "reference", $transactionArray["payment"] );
        $this->assertArrayHasKey( "transaction_id", $transactionArray["payment"] );
        $this->assertArrayHasKey( "cost", $transactionArray["payment"] );
        $this->assertArrayHasKey( "message", $transactionArray["payment"] );
        $this->assertArrayHasKey( "payer", $transactionArray["payment"] );
    }
   
   
    public function testGetTransactionDetailsByOrderId()
    {
        $transactionArray = $this->transactionCallerObject()->getTransactionDetailsByOrderId();
        $this->assertArrayHasKey( "path", $transactionArray );
        $this->assertArrayHasKey( "payment", $transactionArray );
        $this->assertArrayHasKey( "timestamp", $transactionArray );
        $this->assertArrayHasKey( "status", $transactionArray );
        $this->assertArrayHasKey( "reference", $transactionArray["payment"] );
        $this->assertArrayHasKey( "transaction_id", $transactionArray["payment"] );
        $this->assertArrayHasKey( "cost", $transactionArray["payment"] );
        $this->assertArrayHasKey( "message", $transactionArray["payment"] );
        $this->assertArrayHasKey( "payer", $transactionArray["payment"] );
    }


    public function testStaticGetTransactionDetailsByOrderIdRequest(){
        $transactionDetails = TransactionCaller::getTransactionDetailsByOrderIdRequest( $this->orderObject(), $this->credentialsObject(), $this->configArray());

        $this->assertInstanceOf( TransactionDetails::class, $transactionDetails);
        $this->assertInstanceOf( TransactionPayment::class, $transactionDetails->getPayment() );       

    }
    
    public function testStaticGetTransactionDetailsByTransactionIdRequest(){
        $transactionDetails = TransactionCaller::getTransactionDetailsByTransactionIdRequest( $this->transactionID(), $this->credentialsObject(), $this->configArray());

        $this->assertInstanceOf( TransactionDetails::class, $transactionDetails);
        $this->assertInstanceOf( TransactionPayment::class, $transactionDetails->getPayment() );       

    }
}
