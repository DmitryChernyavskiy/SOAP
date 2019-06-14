<?php

class mySoapClient 
{
    private $client ;
    
    function __construct()
    {
        $this->client = new SoapClient("http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL");
    }
    
    public Function CapitalCity($sCountryISOCode)
    {
        $res = $this->client->CapitalCity(array('sCountryISOCode' => $sCountryISOCode));
        return $res ->CapitalCityResult;
    }

    public Function CountryFlag($sCountryISOCode)
    {
        $res = $this->client->CountryFlag(array('sCountryISOCode' => $sCountryISOCode));
        return $res ->CountryFlagResult;
    }

}
