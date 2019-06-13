<?php

namespace DGCGroup\MonCashPHPSDK;

class Order
{
   
    private $orderId;
    private $amount;


    public function __construct( $orderIdValue, $amountValue ){
        
        $this->orderId = $orderIdValue;
        $this->amount = $amountValue;
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    public function getOrderId(){

        return $this->orderId;
        
    }
    
    public function getAmount(){

        return $this->amount;

    }

    public function setOrderId( $orderIdValue ){

        $this->orderId = $orderIdValue;

    }
    
    
    public function setAmount( $amountValue ){

        $this->amount = $amountValue;

    }

    public function toJSON(){
        return json_encode(
            array(
                "amount" => $this->getAmount(),
                "orderId" => $this->getOrderId()
            )
        );
    }
}
