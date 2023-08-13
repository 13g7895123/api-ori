<?php

// echo '123';

include_once('./bonus-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

// // $json_data = file_get_contents('php://input');  // string
// // $data = json_decode($json_data);                // string轉object
// // $data = json_decode($json_data, true);          // string轉array

MYPDO::$table = 'ass_bonus_summary';
$results = MYPDO::select();

// if (!empty($results)){
//     $return['success'] = true;
//     $return['data'] = $results;
// }else{
//     $return['success'] = false;
//     $return['msg'] = '查無資料!';
// }
// echo json_encode($return);

?>