<?php
include_once(__DIR__ . '/../../__Class/ClassLoad.php');
include_once('./config.php');
include_once('./tools.php');

if (isset($_GET['action'])){
    switch($_GET['action']){
        case 'sendCode':
            // 取得 POST DATA
            $json_data = file_get_contents('php://input');  // string
            $post_data = json_decode($json_data, true);          // string轉array

            if (isset($post_data['phone'])){
                // 發送驗證碼
                $phone = $post_data['phone'];

                $validation_code = tools::validation_code();
                $msg = "【遊戲帳號註冊】您的驗證碼為「".$validation_code."」，10分鐘內有效；驗證碼提供給他人可能導致帳號被盜，請勿泄露，謹防被騙。";
                $sms_result = json_decode(tools::omgms($phone, $msg), true);

                // =====驗證簡訊是否傳送成功=====
                if ($sms_result['StatusCode']){     // 回傳狀態碼成功
                    // 驗證資料存入DB
                    MYPDO::$table = 'phone_validation';
                    MYPDO::$data = [
                        'phone' => $phone,
                        'validation_code' => $validation_code,
                        'destination' => $sms_result['Result']['destination'],
                        'status' => $sms_result['Result']['status'],
                        'desc' => $sms_result['Result']['desc'],
                        'messageId' => $sms_result['Result']['messageId'],
                    ];
                    $insertId = MYPDO::insert();
                    
                    // 確認寫入成功
                    if ($insertId > 0){
                        $return['success'] = true;
                    }else{
                        $return['success'] = false;
                        $return['msg'] = 'API傳送有誤';
                    }
                }else{
                    $return['success'] = false;
                    $return['msg'] = '寫入資料庫錯誤';
                }
            }else{
                $return['success'] = false;
                $return['msg'] = '手機號碼有誤';
            }
            break;
        case 'varify_validation_code':
            break;
    }
}





?>