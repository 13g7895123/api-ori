<?php
include_once(__DIR__ . '/../../__Class/ClassLoad.php');
include_once('./config.php');
include_once('./tools.php');

if (isset($_GET['action'])){
    switch($_GET['action']){
        case 'login':
            // 取得 POST DATA
            $json_data = file_get_contents('php://input');  // string
            $post_data = json_decode($json_data, true);     // string轉array

            MYPDO::$table = 'player_user';
            $results = MYPDO::select();

            if (empty($results)){
                $return['success'] = false;
                $return['msg'] = '目前無資料!';
            }else{
                $return['success'] = true;
                $return['data'] = $results;
            }

            echo json_encode($return);
            break;
    }
}
?>