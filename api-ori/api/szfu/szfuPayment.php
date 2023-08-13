<?php

include_once(__DIR__ . '/szfuClass.php');
header("Access-Control-Allow-Origin: http://172.105.126.85:9052");

// 基礎資訊
$env = 'test';
if ($env == 'test'){
    $hashId = 'DABUDYFWABTHP449';
    $hashKey = '04cb0721464090de2f05dfb3785ae8aa';
    $apiUrl = 'https://skpts.skysatisfyp.asia';
}else{
    $hashId = 'BKOJMUUZPKTRH839';
    $hashKey = 'ab210861c82fd87c2b6cf8a28fc9d044';
    $apiUrl = 'https://skp.skysatisfyp.asia';
}

// 整理傳入數值
if (isset($_POST['paytype'])) {
    $paytype = $_POST['paytype'];
} else {
    api::err_responce('請輸入交易方式');
}
if (isset($_POST['price'])) {
    $price = $_POST['price'];
} else {
    api::err_responce('請輸入交易金額');
}

// 存入要給API的變數中
$Value['HashID'] = $hashId;         // HashID
if ($paytype == 'CVS') $Value['MerBanks'] = 'IBONS';
$Value['MerProductID'] = 'A10';     // 商品代號
$Value['MerTradeID'] = '1683728799';  // 自定义定单编号
$Value['MerUserID'] = '10';         // 消費者 ID
$Value['PayType'] = $paytype;       // 支付類型 ATM CVS BARCODE
$Value['Price'] = $price ;          // 支付金額

$validation = szfu::validate($Value, $hashId, $hashKey);
$Value['Validate'] = $validation;   // 安全檢查碼

// echo json_encode($validation['02']);
// return;

echo szfu::post($apiUrl, $Value);
?>

