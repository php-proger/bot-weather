<?php

include 'config.php';
$token = TOKEN;
$idBot = ID_BOT;

$getQuery = array(
    "chat_id" 	=> $idBot,
    "text"  	=> "Новое сообщение из формы",
    "parse_mode" => "html",
);
$url = "https://api.telegram.org/bot";
$method = "/sendMessage?";



function sendMessage($url, $method, $params, $token) 
{
    $ch = curl_init($url. 
    $token .$method . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    $resultQuery = curl_exec($ch);
    curl_close($ch);

    return json_decode($resultQuery, true);
}

function replayMessage($url, $method, $query, $token, $responseMess)
{
    $query['reply_to_message_id'] = $responseMess['result']['message_id'];
    $query['text'] = 'ответ на сообщение';
    $ch = curl_init($url. 
    $token .$method . http_build_query($query));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);


    $resultQuery = curl_exec($ch);
    curl_close($ch);
}

$responseMessage = sendMessage($url, $method, $getQuery, $token);
replayMessage($url, $method, $getQuery, $token, $responseMessage);