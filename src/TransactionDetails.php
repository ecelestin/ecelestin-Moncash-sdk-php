<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\TransactionPayment;

class TransactionDetails
{
    private $path;
    private $payment;
    private $timestamp;
    private $status;

    public function __construct( Array $transactionDetailsValue){
        
        $this->path = $transactionDetailsValue["path"];
        $this->payment = $transactionDetailsValue["payment"];
        $this->timestamp = $transactionDetailsValue["timestamp"];
        $this->status = $transactionDetailsValue["status"];
    }

    
    public function getPath(){

        return $this->path;
        
    }
    
    
    public function getPayment(){

        return $this->payment;

    }
    
    public function getTimestamp(){

        return $this->timestamp;

    }
    
    public function getStatus(){

        return $this->status;

    }
}
