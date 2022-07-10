<?php
require('VoltericCloud.php');

$api_id = "api_";
$api_token = "api_";

$volteric = new VoltericCloud();
$volteric->login($api_id, $api_token);

print_r($volteric->get("/cloud/templates"));
