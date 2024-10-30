<?php

// URL to WSDL file
$wsdl = 'https://cairtraining.cdph.ca.gov/CATRN-WS/IISService?WSDL';

try {
    // Initialize SoapClient with the WSDL 
    $client = new SoapClient($wsdl, array('soap_version' => SOAP_1_2));

    // Define custom parameters for the request
    $body = array('echoBack' => '');

    // Call the SOAP method
    $response = $client->__soapCall('connectivityTest', array($body));
    
    // Output response
    print_r($response);

    // View request and response XML
    // echo "Request :\n" . $client->__getLastRequest() . "\n";
    // echo "Response :\n" . $client->__getLastResponse() . "\n";

} catch (SoapFault $fault) {
    // Handle any exceptions
    echo "Error: {$fault->faultcode}, {$fault->faultstring}";
}  
?>