<?php

class tool
{
    // 歐買尬
    public static function omgms()
    {
        // $api_token = base64_encode('90339cff-6d61-4b85-a123-b03a090635ef');
        $api_token = '90339cff-6d61-4b85-a123-b03a090635ef';
        $url = 'https://api.omgms.com.tw ';
        $data = array(
            'Destination' => '0903706726',
            'SmsBody' => 'test',
            // 'SmsType'  => 'OTP',
            'SmsType'  => 'SYSTEM',
        );
        
        $curl = curl_init();
        $header = array();
        $header[] = 'Content-type: application/x-www-form-urlencoded';
        $header[] = 'Authorization: '.$api_token;

        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        // 執⾏
        $output = curl_exec($curl);
        curl_close($curl);
        echo $output;
    }

    // 三竹
    public static function mitake()
    {
        $curl = curl_init();
        // url
        $url = 'https://sms.mitake.com.tw/b2c/mtk/SmSend?';
        $url .= 'CharsetURL=UTF-8';
        // parameters
        $data = 'username=0903706726';
        $data .= '&password=germit0035';
        $data .= '&dstaddr=0903706726';
        $data .= '&smbody=簡訊SmSend測試';
        // 設定curl網址
        curl_setopt($curl, CURLOPT_URL, $url);
        // 設定Header
        curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/x-www-form-urlencoded")
        );
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HEADER,0);

        // 執⾏
        $output = curl_exec($curl);
        curl_close($curl);
        echo $output;
    }

    public static function test()
    {
        echo 'test123';
    }
}

tool::omgms();
// tool::test();

?>