<?php
require_once 'client.php';

// URL to WSDL file
$wsdl = 'https://cairtraining.cdph.ca.gov/CATRN-WS/IISService?WSDL';

try {

    //Initialize SoapServer with WSDL
    $server = new SoapServer($wsdl);

    // Set the class that implements the web service method
    $server->setClass('client.php');

    // Handle SOAP request
    $server->handle();

} catch (SoapFault $fault) {
    // Handle any exceptions
    echo "Error: {$fault->faultcode}, {$fault->faultstring}";
}  
?>