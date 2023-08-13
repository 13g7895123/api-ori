<?php
// *****編輯藥品資料*****
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
    MYPDO::$data = [
        'eng_name' => $data['eng_name'],
        'medicine_name' => $data['medicine_name'],
        'ingredient' => $data['ingredient'],
        // 'ingredient_num' => $data['ingredient_num'],
        'specification_quantity' => $data['specification_quantity'],
        'single_compound' => $data['single_compound'],
        'price' => $data['price'],
        'start_and_end' => $data['start_and_end'],
        'medicine_manufacturer' => $data['medicine_manufacturer'],
        'dosage' => $data['dosage'],
        'classification' => $data['classification'],
        'classification_group' => $data['classification_group'],
        'ATC_code' => $data['ATC_code'],
        'remark' => $data['remark'],
    ];
    MYPDO::$where = ['medicine_code' => $data['medicine_code']];
    $update_check = MYPDO::save();

    if ($update_check > 0){
        $return['success'] = true;
    }else{
        $return['success'] = false;
        $return['msg'] = '寫入資料庫錯誤';
    }                
}else{
    $return['success'] = false;
    $return['msg'] = '藥品不存在，請重新確認!';
}

echo json_encode($return);

?>