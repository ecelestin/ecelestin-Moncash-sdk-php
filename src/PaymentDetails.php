<?php

namespace DGCGroup\MonCashPHPSDK;

class PaymentDetails
{
    private $mode;
    private $path;
    private $payment_token;
    private $timestamp;
    private $status;
    private $redirect; //Not tested yet

    public function __construct(Array $paymentDetailsArrayValue){
        
        $this->mode = $paymentDetailsArrayValue["mode"];
        $this->path = $paymentDetailsArrayValue["path"];
        $this->payment_token = $paymentDetailsArrayValue["payment_token"];
        $this->timestamp = $paymentDetailsArrayValue["timestamp"];
        $this->status = $paymentDetailsArrayValue["status"];
        $this->redirect = "";
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function getMode(){

        return $this->mode;
        
    }
    
    public function getPath(){

        return $this->path;

    }
    
    
    public function getPaymentToken(){

        return $this->payment_token;

    }
    
    
    public function getTimestamp(){

        return $this->timestamp;

    }
    
    
    public function getStatus(){

        return $this->status;

    }
    
    public function getRedirect(){

        return $this->redirect;

    }
   
    public function setRedirect($redirecValue){

        $this->redirect = $redirecValue;

    }
}
