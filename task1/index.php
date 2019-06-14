<?php
include_once "./libs/mySoapClient.php";
include_once "./libs/myUrlClient.php";

$msg = array();

$msg[] = "****************************";
$msg[] = "SOAP server function";
$msg[] = "****************************";
$client = new mySoapClient;

$result = $client->CapitalCity('AD');
$msg[] =  'City: '.$result;
$result = $client->CountryFlag('AD');
$msg[] =  '<img src="'.$result.'">';

$result = $client->CapitalCity('BS');
$msg[] =  'City: '.$result;
$result = $client->CountryFlag('BS');
$msg[] =  '<img src="'.$result.'">';

$msg[] = "<br>****************************";
$msg[] = "SOAP (cURL) server function";
$msg[] = "****************************";
$client = new myUrlClient;

$result = $client->CapitalCity('AF');
$msg[] =  'City: '.$result;
$result = $client->CountryFlag('AF');
$msg[] =  '<img src="'.$result.'">';

$result = $client->CapitalCity('UA');
$msg[] =  'City: '.$result;
$result = $client->CountryFlag('UA');
$msg[] =  '<img src="'.$result.'">';

include_once "./templates/index.php";