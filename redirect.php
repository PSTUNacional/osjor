<?php
require('autoload.php');

$link = new \OSJ\Service\LinkService;
$url = $link->getURL($_GET['q']);
if(strpos($url, "http") !== 0){
    $url = "http://".$url;
}
header("Location: ".$url);
die();