<?php
// *****取得所有會員資料*****
include_once('./admin-header-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

MYPDO::$table = 'member';
$results = MYPDO::select();

foreach ($results as $key => $val){
    unset($results[$key]['password'] );     // 移除密碼
}

if (!empty($results)){
    $return['success'] = true;
    $return['data'] = $results;
    $return['test'] = $test;
}else{
    $return['success'] = false;
    $return['msg'] = '查無會員資料!';
}
echo json_encode($return);

?>