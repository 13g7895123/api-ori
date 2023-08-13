<?php
include_once('./admin-header-config.php');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');  // string
// $data = json_decode($json_data);                // string轉object
$data = json_decode($json_data, true);          // string轉array

MYPDO::$table = 'admin';
MYPDO::$where = ['account' => $data['email']];
$results = MYPDO::select();

$return['success'] = true;
if (!empty($results)){
    $return['success'] = false;
    $return['msg'] = '帳戶已存在!';
}else{
    MYPDO::$table = 'admin';
    MYPDO::$data = [
        'account' => $data['email'],
        'name' => $data['name'],
        'password' => hash('sha512', $data['password']),
    ];
    $ins_id = MYPDO::insert();

    if ($ins_id <= 0){
        $return['success'] = false;
        $return['msg'] = '建立帳號異常!';
    }
}
echo json_encode($return);

?>