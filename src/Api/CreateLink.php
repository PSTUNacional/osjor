<?php
require('../../autoload.php');

$link = new OSJ\Service\LinkService;

$url = $_POST['url'];
$result = [];
$token = $link->registerLink($url);

$result["token"] = $token;

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);