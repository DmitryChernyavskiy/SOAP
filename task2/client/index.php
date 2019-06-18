<?php

include_once 'config.php';
include_once 'libs/Controller.php';
include_once 'libs/View.php';
include_once 'libs/Model.php';

try
{
  $obj = new Controller();
}
catch(Exception $e)
{
  echo $e->getMessage();	           
}


