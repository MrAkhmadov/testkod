<?php 
    define('API_KEY', '1552197392:AAGKN5quXP--VsACTr9q7jGS21lcBs_nl0o');

    function bot($method, $datas=[]) {
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
        $res = curl_exec($ch);
        if (curl_exec($ch)){
            var_dump(curl_error($ch));
        }else {
            return json_decode($res);
        }
    }

    function typing($ch) {
        return bot('sendChatAction',[
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    $update = json_decode(file_get_contents('php://input'));
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;

    if (isset($text)) {
        typing($chat_id);
    }   
    
    $button = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Biz haqimizda"], ['text' => "Manzil"],],
        ]
    ]);    

    if($text == "/start") {
        bot('sendMessage',[
            'chat_id' => $chat_id,
            'text' => "Assalomu alaykum",
            'pars_mode' => 'markdown',
            'reply_markub' => $button,
        ]);
    }

?>
