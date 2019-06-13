<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\TransactionDetails;
use DGCGroup\MonCashPHPSDK\TransactionPayment;

class TransactionDetailsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test that true does in fact equal true
     */

    private function paymentArray(){

        return array(
            "reference" => "1559796839",
            "transaction_id"=> "12874820",
            "cost" => 10,
            "message" => "successful",
            "payer" => "50937007294"
        );

    }
    
    private function transactionPayment(){
        return new TransactionPayment( $this->paymentArray());
    }

    private function transactionDetailsArray(){
        return array(
            "path" => "/v1/RetrieveTransactionPayment",
            "payment" => $this->transactionPayment(),
            "timestamp" => 1560029360970,
            "status"  => 200
        );
    }


    private function transactionDetailsObject(){
        return new TransactionDetails($this->transactionDetailsArray());
    }



    public function testTransactionDetailsObjectCreation(){
        $this->assertInstanceOf( TransactionDetails::class, $this->transactionDetailsObject());
    }
    

    public function testPathValue(){
        $this->assertEquals( $this->transactionDetailsArray()["path"], $this->transactionDetailsObject()->getPath());
    }

    public function testPaymentValue(){
        $this->assertInstanceOf( TransactionPayment::class, $this->transactionDetailsObject()->getPayment());

        $this->assertEquals( $this->transactionDetailsArray()["payment"]->getReference(), $this->transactionDetailsObject()->getPayment()->getReference());
        $this->assertEquals( $this->transactionDetailsArray()["payment"]->getTransactionId(), $this->transactionDetailsObject()->getPayment()->getTransactionId());
        $this->assertEquals( $this->transactionDetailsArray()["payment"]->getCost(), $this->transactionDetailsObject()->getPayment()->getCost());
        $this->assertEquals( $this->transactionDetailsArray()["payment"]->getMessage(), $this->transactionDetailsObject()->getPayment()->getMessage());
        $this->assertEquals( $this->transactionDetailsArray()["payment"]->getPayer(), $this->transactionDetailsObject()->getPayment()->getPayer());
    }

    public function testTimestampValue(){
        $this->assertEquals( $this->transactionDetailsArray()["timestamp"], $this->transactionDetailsObject()->getTimestamp());
    }
    
    public function testStatusValue(){
        $this->assertEquals( $this->transactionDetailsArray()["status"], $this->transactionDetailsObject()->getStatus());
    }
}
