<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require('autoload.php');
$result = [];
$result["token"] = "12345";
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);