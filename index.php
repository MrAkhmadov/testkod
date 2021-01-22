<?php 
    define('API_KEY', '1552197392:AAGKN5quXP--VsACTr9q7jGS21lcBs_nl0o');

    function del($nomi) {
        array_map('unclink', glob("step/$nomi.*"));
    }
    function put($fayl, $nima) {
        file_put_contents("$fayl", "$nima");
    }
    
    function pstep($cid, $zn) {
        file_put_contents("step/$cid.step", $zn);
    }

    function step($cid) {
        $step = file_get_contents("step/$cid.step");
        $step += 1;
        file_put_contents("step/$cid.step", $step);
    }

    function nextTx($cid, $txt) {
        $step = file_get_contents("step/$cid.txt");
        file_put_contents("step/$cid.txt", "$step\n$txt");
    }

    function ty($ch) {
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    function ACL($callbackQueryId, $text = null, $showAlert = false) {
        return bot ('answerCallbackQuery', [
            'calback_query_id' => $callbackQueryId,
            'text' => $text,
            'show_alert' => $showAlert,
        ]);
    }

    function bot($method, $datas=[])
    {
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
    }

    $update = json_decode(file_get_contents('php://input'));
    $message = $update->message;
    $cid = $message->chat->id;
    $cidtyp = $message->chat->type;
    $miid = $message->message_id;
    $name = $message->chat->first_name;
    $user = $message->from->username;
    $tx = $message->text;
    $callback = $update->callback_query;
    $mmid = $callback->inline_message_id;
    $mes = $callback->message;
    $mid = $mes->message_id;
    $cmtx = $mes->text;
    $idd = $callback->message->chat->id;
    $cbid = $callback->from->id;
    $cbuser = $callback->from->username;
    $data = $callback->data;
    $ida = $callback->id;
    $cqib = $update->callback_query->id;
    $cbins = $callback->chat_instance;
    $cbchtyp = $callback->message->chat->type;
    $step = file_get_contents("step/$cid.step");
    $menu = file_get_contents("step/$cid.menu");
    $stepe = file_get_contents("step/$cbid.step");
    $menue = file_get_contents("step/$cbid.menu");
    mkdir("step");

    $cencel  = "Bekor qilish";

    $keys = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Kurslar"],],
            [['text' => "Biz haqimizda"], ['text' => "Aloqa"],],
            [['text' => "Manzil"], ['text' => "Ro`yxatdan o`tish"],],
        ]
    ]);

    $otmen  = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "$cencel"],],
        ]
    ]);

    $manzil = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "Awesome", 'text' => "Awesome"], ['callback_data' => "So-SO", 'text' => "So-so"],],
        ]    
    ]);

    $kurs = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Front End"], ['text' => "Back End"],],
            [['text' => "Python"], ['text' => "Go lang"],],
            [['text' => "orqaga qaytish"]],
        ]
    ]);

    $tasdiq = json_encode(
        ['inline_keyboard' => [
        [['callback_data' => "ok", 'text' => "ha"], ['callback_data' => "clear", 'text' => "yo`q"],],
            ]
        ]);

    if (isset($tx)) {
        ty($cid);
    }

    if ($tx == "/start") {
        bot ('sendMessage', [
            'chat_id' => $cid,
            'text' => "*Assalomu alaykum, $name!* Sizga qanday yordam bera olishim mumkin?",
            'parse_mode' => 'markdown',
            'reply_markup' => $keys,
        ]);
    }

if ($tx == "Biz haqimizda") {
    bot ('sendMessage', [
        'chat_id' => $cid,
        'text' => "Salom bu yerga biz haqimizdagi matnlar yoziladi",
        'parse_mode' => 'markdown',
        'reply_markup' => $keys,
    ]);   
}

if ($tx == "Aloqa") {
    bot('sendMessage', [
        'chat_id' => $cid,
        'text' => "+998 93 906 99 14",
        'parse_mode' => 'markdown',
        'reply_markup' => $keys,
    ]);
}

if ($tx == "Manzil") {
    bot('sendLocation', [
        'chat_id' => $cid,
        'latitude' => 41.326387,
        'longitude' => 69.229802,
        'reply_markup' => $keys,
    ]);
}

if ($tx == "Kurslar") {
    bot ('sendMessage', [
        'chat_id' => $cid,
        'text' => "*Aynan qaysi yo'nalishdagi kurslarimiz haqida ma'lumot kerak*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "Front End") {
    bot ('sendMessage', [
        'chat_id' => $cid, 
        'text' => "*Bu yerga Front End bo'yicha kurslar haqida ma'lumot olishingiz mumkin*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "Back End") {
    bot ('sendMessage', [
        'chat_id' => $cid, 
        'text' => "*Bu yerga Back End bo'yicha kurslar haqida ma'lumot olishingiz mumkin*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "Python") {
    bot ('sendMessage', [
        'chat_id' => $cid, 
        'text' => "*Bu yerga Python bo'yicha kurslar haqida ma'lumot olishingiz mumkin*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "Go lang") {
    bot ('sendMessage', [
        'chat_id' => $cid, 
        'text' => "*Bu yerga Go lang bo'yicha kurslar haqida ma'lumot olishingiz mumkin*",
        'parse_mode' => 'markdown',
        'reply_markup' => $kurs,
    ]);
}

if ($tx == "orqaga qaytish") {
    bot ('sendMessage', [
        'chat_id' => $cid,
        'text' => "Sizga qanday yordam bera olishim mumkin",
        'parse_mode' =>  'markdown',
        'reply_markup' => $keys,
    ]);
 }

// Register start

  

?>