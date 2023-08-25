<?php
include_once(__DIR__ . '/../../__Class/ClassLoad.php');
include_once(__DIR__ . './tools.php');

if (isset($_GET['action'])){
    switch($_GET['action']){
        case 'sendCode':
            if (isset($_POST['phone'])){

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