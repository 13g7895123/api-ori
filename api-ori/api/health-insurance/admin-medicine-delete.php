<?php
// *****刪除藥品資料*****
include_once('./admin-header-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

// CHECK MEDICINE EXIST OR NOT
MYPDO::$table = 'medicine_items';
MYPDO::$where = [
    'medicine_code' => $data['medicine_code'],
];
$result = MYPDO::first();

if (!empty($result)){

    MYPDO::$table = 'medicine_items';
    MYPDO::$where = ['medicine_code' => $data['medicine_code']];
    $del_check = MYPDO::del();

    if ($del_check > 0){
        $return['success'] = true;
        $return['del_check'] = $del_check;
    }else{
        $return['success'] = false;
        $return['msg'] = '寫入資料庫錯誤';
    }                
}else{
    $return['success'] = false;
    $return['msg'] = '藥品不存在';
}

echo json_encode($return);

?>