<?php
include_once(__DIR__ . '/../../__Class/ClassLoad.php');
include_once(__DIR__ . './tools.php');

if (isset($_GET['action'])){
    switch($_GET['action']){
        case 'sendCode':
            if (isset($_POST['phone'])){

                $phone = $_POST['phone'];
                $validation_code = tools::validation_code();
                $msg = "【遊戲帳號註冊】您的驗證碼為「".$validation_code."」，10分鐘內有效；驗證碼提供給他人可能導致帳號被盜，請勿泄露，謹防被騙。";
                tools::omgms($phone, $msg)

                // =====驗證簡訊是否傳送成功=====

                MYPDO::$table = 'phone_validation';
                MYPDO::$data = [
                    'phone' => $_POST['phone'],
                    'validation_code' => tools::validation_code();
                ];
                $insertId = MYPDO::insert();
            
                if ($insertId > 0){
                    $return['success'] = true;
                }else{
                    $return['success'] = false;
                    $return['msg'] = '寫入資料庫錯誤';
                }
            }else{
                $return['success'] = false;
                $return['msg'] = '手機號碼有誤';
            }
            break;
    }
}





?>