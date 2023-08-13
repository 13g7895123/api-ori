<?php
// *****編輯會員資料*****
include_once('./admin-header-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

// CHECK PASSWORD MATCH
if ($data['password'] !== $data['passwordCheck']){
    $return['success'] = false;
    $return['msg'] = '密碼不相符';
    echo json_encode($return);
    return;
}

// CHECK ACCOUNT EXIST OR NOT
MYPDO::$table = 'member';
MYPDO::$where = [
    'account' => $data['account'],
    'switch' => 1
];
$result = MYPDO::first();

if (!empty($result)){

    // 確認密碼需要修改
    if ($data['password'] != ''){
        MYPDO::$table = 'member';
        MYPDO::$data = ['password' => hash('sha512', $data['password'])];
        MYPDO::$where = ['account' => $data['account']];
        MYPDO::save();
    }

    MYPDO::$table = 'member';
    MYPDO::$data = [
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
    MYPDO::$where = ['account' => $data['account']];
    $update_check = MYPDO::save();

    if ($update_check > 0){
        $return['success'] = true;
    }else{
        $return['success'] = false;
        $return['msg'] = '寫入資料庫錯誤';
    }                
}else{
    $return['success'] = false;
    $return['msg'] = '帳號不存在';
}

echo json_encode($return);

?>