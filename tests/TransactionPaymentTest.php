<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\TransactionPayment;

class TransactionPaymentTest extends \PHPUnit\Framework\TestCase
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
    private function transactionPaymentObject(){
        return new TransactionPayment( $this->paymentArray());
    }

    public function testTransactionPaymentObjectCreation(){

        $this->assertInstanceOf( TransactionPayment::class, $this->transactionPaymentObject() );

    }
    

    public function testReferenceValue(){

        $this->assertEquals( $this->paymentArray()["reference"] , $this->transactionPaymentObject()->getReference() );

    }

    public function testTransactionIdValue(){
        $this->assertEquals( $this->paymentArray()["transaction_id"] , $this->transactionPaymentObject()->getTransactionId() );
    }

    public function testCostValue(){
        $this->assertEquals( $this->paymentArray()["cost"] , $this->transactionPaymentObject()->getCost() );
    }

    public function testMessageValue(){
        $this->assertEquals( $this->paymentArray()["message"] , $this->transactionPaymentObject()->getMessage() );
    }

    public function testPayerValue(){
        $this->assertEquals( $this->paymentArray()["payer"] , $this->transactionPaymentObject()->getPayer() );
    }
}
