<?php

namespace s2tel\mc_php_sdk;
require_once "Constants.php";

use s2tel\mc_php_sdk\PaymentExceptions;



class PaymentClass
{
    private $client;
    private $secret;


    /**
     * Create a new Skeleton Instance
     */

    public function __construct($client = "", $secret = ""){
        $this->client = $client;
        $this->secret = $secret;
    }



    /**
     * This method is created in order to grab the token needed for the authentication while requesting for payment
     *
     * @param No parameters is needed;
     *
     * @return json Returns a JSON object that contains the needed token
     */


    public function getAuthorizationInformations(){
        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                PROTOCOL_STRING."://".$this->client.":".$this->secret."@".URI_BASE_REST_API."".URI_TOKEN_QUERY,
                array(
                    "form_params" => array(
                        "scope"=> "read,write",
                        "grant_type" => "client_credentials"
                    ),
                    "headers" => array(
                        "Accept" => HTTTP_ACCEPT_HEADER
                    )
                )
                    );
            return $res->getBody()->getContents();

        }catch(Exception $e){
            //Have to catch errors like connection and other errors
            var_dump($e);
        }

        return json_encode(array());
    }


    /**
     * This method make the request to the API for the payement
     *
     * @param float $amount The sum of all purshased items
     * @param float $orderId The order ID generated on your side in order to identify each order. Remember that the order must be UNIQUE accross all your app
     *
     * @return string Returns the redirecte URI
     */


    public function makePaymentRequest($amount,$orderId){
        $authInfos = $this->getAuthorizationInformations();
        $authInfos = json_decode($authInfos, true);

        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                PROTOCOL_STRING."://".URI_BASE_REST_API."".URI_MAKE_PAYMENT,
                array(
                    "body" => json_encode(array(
                        "amount"=> $amount,
                        "orderId" => $orderId
                    )),
                    "headers" => array(
                        "Accept" => HTTTP_ACCEPT_HEADER,
                        "Authorization" => "Bearer ".$authInfos["access_token"],
                        "Content-Type" => HTTP_CONTENT_TYPE
                    )
                )
            );
            $payement_token = json_decode($res->getBody()->getContents(),true)["payment_token"]["token"];
            return PROTOCOL_STRING."://".URI_BASE_REST_API_2."".URI_PAYMENT_REDIRECT."?token=".$payement_token;

        }catch(Exception $e){
            //Have to catch errors like connection and other errors
            throw new PaymentExceptions($e->getMessage());
        }catch(\GuzzleHttp\Exception\ClientException $e){
            throw new PaymentExceptions($e->getMessage());
        }
        return "";
    }

}
