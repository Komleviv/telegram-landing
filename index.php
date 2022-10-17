<?php
include 'libs/madeline/madeline_scripts.php';

$source = '';
   
$messages = get_messages('btca_ru', 190, 10);

foreach(array_reverse($messages) as $i => $message) { 
 $media = get_images($message);
 //print_r (glob('5353030282212654688'));
 $source .= "<div class='message_container'>";
 $source .= "<div class='message_title'><a href='https://t.me/btca_ru' target='_blank'>BITCOIN ADDITIONAL (RU)</a></div>";
 
 // Если в сообщение есть изображение добавляем его к выводу
 if (!empty($message['media']['photo'])) {
     $source .= "<div class='message_img'><a href='https://t.me/btca_ru/" . $message['id'] ."' target='_blank'><img src='/img/" . $message['media']['photo']['id'] ."_y_2.jpg' class='img_width'></a></div>";
 }
  
 // Если в сообщение есть видео добавляем его к выводу
 if (!empty($message['media']['document'])) {
     $source .= "";
 }
 $source .= "<div class='message'><pre>" . $message['message']. "</pre></div>";
 if (isset($message['entities'][0]['url'])) {
   $source .= "<div class='message_url'><a href='". $message['entities'][0]['url'] ."' target='_blank'>" . $message['entities'][0]['url']. "</a></div>";
 }
 $source .= "<div class='message_bottom'><div class='bottom_block'><a href='https://t.me/btca_ru/" . $message['id'] ."' target='_blank'>t.me/btca_ru/" . $message['id'] ."</a></div><div class='bottom_block><span class='message_date'>" . date('j F Y H:i', $message['date']) ."</span></div></div>";
 $source .= "</div>";
}

require_once ('src/site.html');

?>