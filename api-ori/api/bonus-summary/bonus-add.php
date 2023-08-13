<?php
include_once('./bonus-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

MYPDO::$table = 'ass_bonus_summary';
MYPDO::$data = [
    'name' => $data['name'],
    'cate' => $data['cate'],
    'status' => $data['status'],
    'amount' => $data['amount'],
    'start_contact_date' => $data['start_contact_date']
];
$insert_id = MYPDO::insert();

if ($insert_id > 0){
    $return['success'] = true;
}else{
    $return['success'] = false;
    $return['msg'] = '寫入資料庫錯誤!';
}
echo json_encode($data);

?>