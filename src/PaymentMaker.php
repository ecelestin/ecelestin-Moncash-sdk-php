<?php

namespace DGCGroup\MonCashPHPSDK;
use DGCGroup\MonCashPHPSDK\Order;
use DGCGroup\MonCashPHPSDK\Configuration;
use DGCGroup\MonCashPHPSDK\Credentials;
use DGCGroup\MonCashPHPSDK\Constants;
use DGCGroup\MonCashPHPSDK\PaymentToken;
use DGCGroup\MonCashPHPSDK\PaymentDetails;

class PaymentMaker
{
    private $orderObj;
    private $authObj; //Not tested Yet
    private $configArray;
    

    public function __construct( Order $orderObjValue, Credentials $authObjValue,$configArrayValue ){
        
        $this->orderObj = $orderObjValue;
        $this->authObj = $authObjValue;
        $this->configArray = $configArrayValue;

    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
   
    public function getOrderObj(){

        return $this->orderObj;
        
    }
    
    
    public function getAuthObj(){  //Not tested Yet

        return $this->authObj;
        
    }
    
    public function getConfigArray(){

        return $this->configArray;

    }

    public function makePayment(){
        $authInfos = $this->authObj->getAuthorizationInformations();
        $restEndpointSplit = explode( "//", $this->getConfigArray()["rest_api_endpoint"]);
        // var_dump($authInfos);
        
        //$authInfos = json_decode($authInfos, true);

        
        // exit;

        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                $restEndpointSplit[0]."//".$restEndpointSplit[1]."".Constants::$PAYMENT_CREATOR_URI,
                array(
                    "body" => json_encode(array(
                        "amount"=> $this->orderObj->getAmount(),
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
        }

        return array();
    }

    public static function makePaymentRequest( Order $orderObjValue, Credentials $authObjValue,$configArrayValue ){
        $paymentObj =new PaymentMaker($orderObjValue, $authObjValue, $configArrayValue);
        $paymentInfos = $paymentObj->makePayment();
        $paymentToken = new PaymentToken($paymentInfos["payment_token"]);

        $paymentDetails = new PaymentDetails(array(
            "mode" => $paymentInfos["mode"],
            "path" => $paymentInfos["path"],
            "payment_token" => $paymentToken,
            "timestamp" => $paymentInfos["timestamp"],
            "status" => $paymentInfos["status"]
        ));

        $paymentDetails->setRedirect($configArrayValue["redirect"]."".Constants::$GATE_WAY_URI."?token=".$paymentToken->getToken());

        return $paymentDetails;
        // var_dump($paymentObj->makePayment());
    }
}
