<?php


// Leave only for debuging purposes
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';
use s2tel\mc_php_sdk\PaymentClass;

// Instanciation of the payment class
$client = "c1bf0a27d6bbb217a599c9e25480c11d";
$secret = "oHrr4tbnB1PH0uz6VQNUvVVDNVNvk0WiIXZWBAed4-CBCwilT8yUdS87AZoPrtqN";

$test = new PaymentClass($client, $secret);

// Call to the payment request

$amount = 90;
$orderId = 123456789;

$rep = $test->makePaymentRequest($amount,$orderId);

// Echoing the redirection's URI to the payment middleware of MONCASH
echo "<a href='".$rep."' target='_blank'><img src='https://moncashbutton.digicelgroup.com/Moncash-middleware/resources/assets/images/MC_button.png' ></a>";
