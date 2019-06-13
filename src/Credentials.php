<?php

namespace DGCGroup\MonCashPHPSDK; 
use DGCGroup\MonCashPHPSDK\Constants; 



class Credentials
{
    /**
     * Create a new Skeleton Instance
     */

    private $client;
    private $secret;
    private $configArray;


    public function __construct( $clientValue , $secretValue, $configArrayValue ){

        $this->client = $clientValue;
        $this->secret = $secretValue;
        $this->configArray = $configArrayValue;
        
    }

    /**
     * Friendly welcome
     *
     * @param string $phrase Phrase to return
     *
     * @return string Returns the phrase passed in
     */
    
    public function setClient($clientValue){
        
        $this->client = $clientValue;
    }


    public function setSecret($secretValue){
        
        $this->secret = $secretValue;

    }
    
    public function setConfigArray($configArrayValue){
        
        $this->configArray = $configArrayValue;

    }

    
    public function getClient(){

        return $this->client;

    }
    
    
    public function getSecret(){

        return $this->secret;

    }
    
    public function getConfigArray(){

        return $this->configArray;

    }


    public function getAuthorizationInformations(){
        $restEndpointSplit = explode( "//", $this->getConfigArray()["rest_api_endpoint"]);
        $httpClient = new \GuzzleHttp\Client();
        try{
            $res = $httpClient->post(
                $restEndpointSplit[0]."//".$this->client.":".$this->secret."@".$restEndpointSplit[1]."".Constants::$OAUTH_TOKEN_URI,
                array(
                    "form_params" => array(
                        "scope"=> "read,write",
                        "grant_type" => "client_credentials"
                    ),
                    "headers" => array(
                        "Accept" => Constants::$HTTP_ACCEPT_HEADER
                    )
                )
                    );
            return  json_decode( $res->getBody()->getContents(), true );

        }catch(\GuzzleHttp\Exception\ClientException $e){
            //Have to create appropriate Exception
            var_dump($e)->getMessage();
        }

        return array();
    }
}
