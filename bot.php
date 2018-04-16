<?php

require('parser.php');

define('BOT_TOKEN', 'YOUR TOKEN');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

function processMessage($message) {

    $message_id = $message['message_id'];
    $chat_id = $message['chat']['id'];
    
    if (isset($message['text'])) {
        $text = $message['text'];

        if (strpos($text, "/start") === 0) {
            sendMessage("sendMessage", array('chat_id' => $chat_id, 'text' => 'Olá, eu sou um bot que informa o cardápio do dia no Restaurante Universitário da UFSCar, para ver o cardápio me envie o comando /getmenu ou /cardapio'));
        } else if ((strpos($text, "/getmenu") === 0) || (strpos($text, "/cardapio") === 0)) {
            sendMessage("sendMessage", array('chat_id' => $chat_id, 'text' => getResult()));
        } else {
            sendMessage("sendMessage", array('chat_id' => $chat_id, 'text' => 'Desculpe, mas não entendi sua mensagem.'));
        }
    }
}

function sendMessage($method, $parameters) {
    $options = array(
        'http' => array('method'  => 'POST','content' => json_encode($parameters),'header'=>  "Content-Type: application/json\r\n" ."Accept: application/json\r\n")
    );

    $context = stream_context_create($options);
    file_get_contents(API_URL.$method, false, $context);
}

/*
$update_response = file_get_contents(API_URL."getupdates");
$response = json_decode($update_response, true);
$length = count($response["result"]);
$update = $response["result"][$length-1];
*/

$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);

if (isset($update["message"])) {
    processMessage($update["message"]);
}

?>  
