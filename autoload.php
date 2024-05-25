<?php
spl_autoload_register(function($class){
    $path = str_replace('\\','/',$class);
    $path = str_replace('OSJ', '', $path);
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src' . $path.'.php');
});