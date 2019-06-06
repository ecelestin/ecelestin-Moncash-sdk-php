<?php
namespace s2tel\mc_php_sdk;

// Protocol URI
const PROTOCOL_STRING = "http";


//Base REST API URI
const URI_BASE_REST_API = '200.113.192.182:8080/Api';


const URI_BASE_REST_API_2 = '200.113.192.182:8080';

//Auth Token URI
const URI_TOKEN_QUERY = '/oauth/token';

//Make Payment URI
const URI_MAKE_PAYMENT = '/v1/CreatePayment';

//URI for payment redirect to go to MonCash
const URI_PAYMENT_REDIRECT = '/Moncash-middleware/Payment/Redirect';



const HTTTP_ACCEPT_HEADER = 'application/json';


const HTTP_CONTENT_TYPE = 'application/json';




const AUTH_PAYLOAD = 'scope=read,write&grant_type=client_credentials';






