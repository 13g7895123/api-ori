<?php
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

// DB
MYPDO::$db = 'db_assistant';
// MYPDO::$user = 'assistant_remote';
MYPDO::$user = 'root';
// MYPDO::$pwd = '820820';
MYPDO::$pwd = 'germit0035';

MYPDO::$table = 'ass_bonus_summary';
MYPDO::$where = ['id' => 1];
$results = MYPDO::select();

echo json_encode($results);

$url_arr = [
    'http://172.105.126.85:9053',
    'http://139.162.15.125:9053',
    '*'
];

$http_origin = $_SERVER['HTTP_ORIGIN'];

if (in_array($http_origin, $url_arr)){
    header("Access-Control-Allow-Origin: $http_origin");
}

header('Access-Control-Allow-Headers: Content-Type');

?>