<?php

include 'Telegram.php';

$telegram = new Telegram('6325872501:AAFOh3M4TG-7MKx84huQiTda64BYuZGJRNc');

// result request body{}
$result = $telegram->getData();

$chat_id = $telegram->ChatID();
$text    = $telegram->Text();

$myCommands = false;

if($text == "/start") {
    $option = array(
        //First row
        array($telegram->buildInlineKeyBoardButton("شروع😎", '', '/home')),
   );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "سلام خوبی؟ به ربات سبزلرن خوش اومدی!");
    $telegram->sendMessage($content);
}

if($text == "/home" || $text == "شروع😎" || $text == "بازگشت🔙") {
    // true myCommands (bool)
    $myCommands = true;

    // send welcome mesasage& create keyboard
    $option = array(
        //First row
//        array($telegram->buildInlineKeyBoardButton("شروع😎", '', '/start')),
        //Second row
        array($telegram->buildInlineKeyBoardButton("اطلاعات ربات🤖", '', '/info'), $telegram->buildInlineKeyBoardButton("اطلاعات شخصی🧑‍🦲", '', '/me')),
        array($telegram->buildInlineKeyBoardButton("سایت سبزلرن💚", 'https://sabzlearn.ir'), $telegram->buildInlineKeyBoardButton("دوره ربات تلگرام🔵", 'https://sabzlearn.ir/course/telegram-bot-php/')),
        );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "سلام خوبی؟ به ربات سبزلرن خوش اومدی!",  'message_id'=> $result['callback_query']['message']['message_id']);
    $telegram->editMessageText($content);
}

if($text == "/info" || $text == "اطلاعات ربات🤖") {
    $myCommands = true;
    $option = array(
        //First row
        array($telegram->buildInlineKeyBoardButton("بازگشت🔙", '', '/home')),
   );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $myResult = $telegram->getMe()['result']['first_name'];
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $myResult, 'message_id'=> $result['callback_query']['message']['message_id']);
    $telegram->editMessageText($content);
}

if($text == "/me" || $text == "اطلاعات شخصی🧑‍🦲") {
    $myCommands = true;

    $option = array(
        //First row
        array($telegram->buildInlineKeyBoardButton("بازگشت🔙", '', '/home')),
    );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $myResult = $telegram->Chat()['first_name'];
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $myResult, 'message_id'=> $result['callback_query']['message']['message_id']);
    $telegram->editMessageText($content);
}


//$content = array('chat_id' => $chat_id, 'text' => $text);
//$telegram->sendMessage($content);