<?php

class myUrlClient 
{
    private $client ;
    private $headers  = array('POST /websamples.countryinfo/CountryInfoService.wso HTTP/1.1',
    'Host: webservices.oorsprong.org',
    'Content-Type: text/xml; charset=utf-8',
    'Content-Length: ');
    
    function __construct()
    {
       
    }

    function __destruct()
    {
        
    }

    private function curl_exec($xml_post_string)
    {

        $this->client = curl_init("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");

        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($this->client, CURLOPT_USERPWD, $soapUser.":".$soapPassword); // username and password - declared at the top of the doc
        curl_setopt($this->client, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($this->client, CURLOPT_TIMEOUT, 10);
        curl_setopt($this->client, CURLOPT_POST, true);

        $headers = $this->headers;
        $headers[3] .= strlen($xml_post_string);
        curl_setopt($this->client, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->client, CURLOPT_POSTFIELDS, $xml_post_string);

        $response = curl_exec($this->client); 
        curl_close($this->client);

        $response1 = str_replace("<soap:Body>","",$response);
        $response2 = str_replace("</soap:Body>","",$response1);

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response2);

        $xml = new SimpleXMLElement($response);     

        return $xml;
    }
    
    public Function CapitalCity($sCountryISOCode)
    {
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>'.
        '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">'.
        '  <soap:Body>'.
        '    <CapitalCity xmlns="http://www.oorsprong.org/websamples.countryinfo">'.
        '      <sCountryISOCode>'.$sCountryISOCode.'</sCountryISOCode>'.
        '    </CapitalCity>'.
        '  </soap:Body>'.
        '</soap:Envelope>';

    
        $xml = $this->curl_exec($xml_post_string);
        return  $xml->mCapitalCityResponse->mCapitalCityResult;
    }

    public Function CountryFlag($sCountryISOCode)
    {
        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>'.
        '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">'.
        '  <soap:Body>'.
        '    <CountryFlag xmlns="http://www.oorsprong.org/websamples.countryinfo">'.
        '      <sCountryISOCode>'.$sCountryISOCode.'</sCountryISOCode>'.
        '    </CountryFlag>'.
        '  </soap:Body>'.
        '</soap:Envelope>';

        $xml = $this->curl_exec($xml_post_string);
        return $xml->mCountryFlagResponse->mCountryFlagResult;
    }
}
