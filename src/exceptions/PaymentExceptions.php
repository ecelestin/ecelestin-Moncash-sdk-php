<?php


namespace s2tel\mc_php_sdk;


class MCPaymentExceptions extends \Exception
{
    public function __construct($message, $code = 0, $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


    public function getErrorToJSON(){
        return json_encode(array(
            "message" => this->getMessage(),
            "code" => this->getCode(),
            "file" => this->getFile(),
            "line" => this->getLine(),
            "trace" => this->getTrace(),
            "previous" => this->getPrevious(),
            "traceAsString" => this->getTraceAsString()
        ));
    }

}