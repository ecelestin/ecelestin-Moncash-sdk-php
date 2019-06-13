<?php

namespace DGCGroup\MonCashPHPSDK;

class PaymentToken
{
    private $expired;
    private $created;
    private $token;


    public function __construct( Array $paymentTokenValue){
        
        $this->expired = $paymentTokenValue["expired"];
        $this->created = $paymentTokenValue["created"];
        $this->token = $paymentTokenValue["token"];

    }

    public function getExpired(){

        return $this->expired;
        
    }
    
    public function getCreated(){

        return $this->created;

    }
    
    public function getToken(){

        return $this->token;

    }
}
