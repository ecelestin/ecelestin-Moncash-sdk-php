<?php


// Leave only for debuging purposes
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';
use DGCGroup\MonCashPHPSDK\Credentials;
use DGCGroup\MonCashPHPSDK\Configuration;
use DGCGroup\MonCashPHPSDK\PaymentMaker;
use DGCGroup\MonCashPHPSDK\Order;
use DGCGroup\MonCashPHPSDK\TransactionCaller;

// Instanciation of the payment class
$client = "c1bf0a27d6bbb217a599c9e25480c11d";
$secret = "oHrr4tbnB1PH0uz6VQNUvVVDNVNvk0WiIXZWBAed4-CBCwilT8yUdS87AZoPrtqN";
$configArray = Configuration::getSandboxConfigs();

$test = new Credentials($client, $secret, $configArray);

// Call to the payment request

$amount = 90;
$orderId = 1559796839;

$theOrder = new Order( $orderId, $amount );

// $transact = new TransactionCaller( $theOrder, $test, $configArray );
// $rep = $transact->getTransactionDetailsByOrderId();

$var = TransactionCaller::getTransactionDetailsByOrderIdRequest( $theOrder, $test, $configArray );
var_dump($var);exit;
// $paymentObj = new PaymentMaker( $theOrder, $test, $configArray );
// $paymentObj = PaymentMaker::makePaymentRequest( $theOrder, $test, $configArray );
// $rep = $paymentObj->makePayment();

// var_dump($paymentObj);
var_dump($rep);
exit;


// Echoing the redirection's URI to the payment middleware of MONCASH
// echo "<a href='".$paymentObj->getRedirect()."' target='_blank'><img src='https://moncashbutton.digicelgroup.com/Moncash-middleware/resources/assets/images/MC_button.png' ></a>";
