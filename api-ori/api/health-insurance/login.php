<?php

header("Access-Control-Allow-Origin: http://172.105.126.85:9053");
header('Access-Control-Allow-Headers: Content-Type');
include_once(__DIR__ . '/../../__Class/ClassLoad.php');

$json_data = file_get_contents('php://input');
$data = json_decode($json_data);    // 轉object

$account = $data->account;
$password = $data->password;

MYPDO::$table = 'member';
MYPDO::$where = [
    'account' => $account,
    'password' => hash('sha512', $password),
    'switch' => 1
];
$result = MYPDO::first();

if (empty($result)){
    $return['success'] = false;
    $return['msg'] = '帳號密碼不存在，請重新確認!';
}else{
    // 設置登入SESSION
    // $_SESSION['mi_id'] = SYSAction::SQL_Data('member', 'account', $_POST['account'], 'id');
    $return['success'] = true;
}

echo json_encode($return);

?>