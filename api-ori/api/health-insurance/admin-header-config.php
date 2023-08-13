<?php

include_once(__DIR__ . '/../../__Class/ClassLoad.php');

// DB
MYPDO::$user = 'bonus_health_insurance_remote';
MYPDO::$pwd = '820820';
MYPDO::$db = 'db_bonus_health_insurance';

// CORS
$url_arr = [
    'http://172.105.126.85:9054',
    'http://139.162.15.125:9054',
    'http://health-insurance-admin.mercylife.cc'
];

$http_origin = $_SERVER['HTTP_ORIGIN'];

if (in_array($http_origin, $url_arr)){
    header("Access-Control-Allow-Origin: $http_origin");
}

header('Access-Control-Allow-Headers: Content-Type');

?>