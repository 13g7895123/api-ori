<?php
// *****新增會員資料*****
include_once('./admin-header-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

// CHECK ACCOUNT EXIST OR NOT
MYPDO::$table = 'member';
MYPDO::$where = [
    'account' => $data['account'],
    'switch' => 1
];
$result = MYPDO::first();

if (empty($result)){
    MYPDO::$table = 'member';
    MYPDO::$data = [
        'account' => $data['account'],
        'password' => hash('sha512', $data['password']),
        'user_name' => $data['user_name'],
        'phone' => $data['phone'],
        'mail' => $data['mail'],
        'address_country' => $data['address_country'],
        'address_area' => $data['address_area'],
        'address_detail' => $data['address_detail'],
        'medical_institution_code' => $data['medical_institution_code'],
        'medical_institution_name' => $data['medical_institution_name'],
        'medical_institution_cate' => $data['medical_institution_cate']
    ];
    $insert_check = MYPDO::insert();

    if ($insert_check > 0){
        $return['success'] = true;
    }else{
        $return['success'] = false;
        $return['msg'] = '寫入資料庫錯誤';
    }                
}else{
    $return['success'] = false;
    $return['msg'] = '帳號已存在，請重新確認!';
}

echo json_encode($return);

?>