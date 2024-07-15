<?php

include_once("./includes/crud.php");
include_once("./includes/custom-functions.php");
include_once("./library/shiprocket.php");

$shiprocket = new Shiprocket();

echo " Token : " . $token = $shiprocket->generate_token();
// echo " Credentials : " . print_r($shiprocket->get_credentials());
