<?php
#xiaobo
#https://www.xiaobo.love
@$context = $_GET['openaiContext'];
@$userKey = $_GET['userKey'];
@$maxTokens = (int)$_GET['maxTokens']||$_POST['maxTokens'];
if ($maxTokens <= 0) {
    $maxTokens = 200;
}
if (strlen($context) <= 0) {
    echo 'openaiContext为空<br>请使用GET方法传入参数！';
} else {
    if (strlen($userKey) <= 0) {
        echo 'userKey为空<br>请使用GET方法传入参数！<br>';
    } else {
        $curl = curl_init();
        $url = "https://api.openai.com/v1/completions";
        $curlData = array(
            "model" => "text-davinci-003",
            "prompt" => $context,
            "temperature" => 0,
            "max_tokens" => $maxTokens
        );
        $curlDataJson = json_encode($curlData);
        $httpHeaders = array(
            "Content-Type:application/json",
            "Authorization: Bearer " . strval($userKey)
        );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlDataJson);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $retureData = curl_exec($curl);
        curl_close($curl);
        echo $retureData;
    }
}


?>