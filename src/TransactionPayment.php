<?php

namespace DGCGroup\MonCashPHPSDK;

class TransactionPayment
{
    private $reference;
    private $transactionId;
    private $cost;
    private $message;
    private $payer;
    

    public function __construct(Array $transactionPaymentValue){
        
        $this->reference = $transactionPaymentValue['reference'];
        $this->transactionId = $transactionPaymentValue['transaction_id'];
        $this->cost = $transactionPaymentValue['cost'];
        $this->message = $transactionPaymentValue['message'];
        $this->payer = $transactionPaymentValue['payer'];
    }

    public function getReference(){
        
        return $this->reference;
        
    }
    
    public function getTransactionId(){
        
        return $this->transactionId;

    }
    
    public function getCost(){
        
        return $this->cost;

    }
    
    public function getMessage(){
        
        return $this->message;

    }
    
    public function getPayer(){
        
        return $this->payer;

    }
}
