<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\TransactionPayment;
use DGCGroup\MonCashPHPSDK\TransactionDetails;
use DGCGroup\MonCashPHPSDK\Order;

class TransactionCaller
{
    private $orderObj;
    private $authObj; //Not tested Yet
    private $configArray;

    public function __construct( Order $orderObjValue, Credentials $authObjValue, $configArrayValue  ){
        
        $this->orderObj = $orderObjValue;
        $this->authObj = $authObjValue;
        $this->configArray = $configArrayValue;
    }

    public function getOrderObj(){

        return $this->orderObj;
        
    }
    
    
    public function getAuthObj(){  //Not tested Yet

        return $this->authObj;
        
    }
    
    public function getConfigArray(){

        return $this->configArray;

    }

    public function getTransactionDetailsByTransactionId( $transactionId){
        $authInfos = $this->authObj->getAuthorizationInformations();
        $restEndpointSplit = explode( "//", $this->getConfigArray()["rest_api_endpoint"]);
        
        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                $restEndpointSplit[0]."//".$restEndpointSplit[1]."".Constants::$PAYMENT_TRANSACTION_URI,
                array(
                    "body" => json_encode(array(
                        "transactionId" => $transactionId
                    )),
                    "headers" => array(
                        "Accept" => Constants::$HTTP_ACCEPT_HEADER,
                        "Authorization" => "Bearer ".$authInfos["access_token"],
                        "Content-Type" => Constants::$HTTP_APPLICATION_JSON
                    )
                )
            );
            return json_decode( $res->getBody()->getContents(), true);

        }catch(\GuzzleHttp\Exception\ClientException $e){
            var_dump($e->getMessage());
        }

        return array();
    }
    
    public function getTransactionDetailsByOrderId(){
        $authInfos = $this->authObj->getAuthorizationInformations();
        $restEndpointSplit = explode( "//", $this->getConfigArray()["rest_api_endpoint"]);
        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                $restEndpointSplit[0]."//".$restEndpointSplit[1]."".Constants::$PAYMENT_ORDER_URI,
                array(
                    "body" => json_encode(array(
                        "orderId" => $this->orderObj->getOrderId()
                    )),
                    "headers" => array(
                        "Accept" => Constants::$HTTP_ACCEPT_HEADER,
                        "Authorization" => "Bearer ".$authInfos["access_token"],
                        "Content-Type" => Constants::$HTTP_APPLICATION_JSON
                    )
                )
            );
            return json_decode( $res->getBody()->getContents(), true);

        }catch(\GuzzleHttp\Exception\ClientException $e){
            var_dump($e->getMessage());
        
        }catch(\GuzzleHttp\Exception\ConnectException $e){
            var_dump($e);
        }

        return array();
    }


    public static function getTransactionDetailsByOrderIdRequest(Order $orderObjValue, Credentials $authObjValue, $configArrayValue ){
        $callerObj = new TransactionCaller( $orderObjValue, $authObjValue, $configArrayValue );
        $transactionRep  =  $callerObj->getTransactionDetailsByOrderId();

        if( !empty($transactionRep) ){
            $transactPayment = new TransactionPayment( $transactionRep["payment"]);
            $trasanctDetails = new TransactionDetails(array(
                "path" => $transactionRep["path"],
                "payment" => $transactPayment,
                "timestamp" => $transactionRep["timestamp"],
                "status" => $transactionRep["status"],
            ));

            return $trasanctDetails;
        }

        return null;
        
        
        
    }
    
    
    public static function getTransactionDetailsByTransactionIdRequest( $transactionId, Credentials $authObjValue, $configArrayValue ){
        $callerObj = new TransactionCaller( new Order("",""), $authObjValue, $configArrayValue );
        $transactionRep  =  $callerObj->getTransactionDetailsByTransactionId( $transactionId );

        $transactPayment = new TransactionPayment( $transactionRep["payment"]);
        $trasanctDetails = new TransactionDetails(array(
            "path" => $transactionRep["path"],
            "payment" => $transactPayment,
            "timestamp" => $transactionRep["timestamp"],
            "status" => $transactionRep["status"],
        ));

        return $trasanctDetails;
        
    }


}
