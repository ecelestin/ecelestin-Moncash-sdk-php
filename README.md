# Mon Cash PHP SDK

This is the PHP SDK that allows php's developers to interract with the MonCash payment facility on their website. 

## Structure

We habe used the following industry bes practices for structuring for this SDK.

```
src/
tests/
vendor/
samle/
```


## Install

Via Composer

``` bash
# No packegist repository has been created yet. Please contact MonCash for informations on downloading the library.
```

## Usage

```
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
echo $rep;

```

## Testing

``` bash
$ phpunit --bootstrap vendor/autoload.php tests/PaymentClassTest.php
```


## Security

If you discover any security related issues, please email rulxphilome.alexis@gmail.com instead of using the issue tracker.

## Credits

- [Rulx Philome ALEXIS][ http://www.linkedin.com/in/rpalexis]
- [Emmanuel SUY][http://www.linkedin.com/in/emmanuel.suy]

## License

To be filled by MonCash
