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
 $source .= "<div class='message_bottom'><div class='bottom_block'><a href='https://t.me/btca_ru/" . $message['id'] ."' target='_blank'>t.me/btca_ru/" . $message['id'] ."</a></div><div class='bottom_block_right'><div class='message_view'>" . $message['views'] . "<svg class='view_icon' version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
	 viewBox='0 0 42 42' enable-background='new 0 0 42 42' xml:space='reserve'>
<path d='M15.3,20.1c0,3.1,2.6,5.7,5.7,5.7s5.7-2.6,5.7-5.7s-2.6-5.7-5.7-5.7S15.3,17,15.3,20.1z M23.4,32.4
	C30.1,30.9,40.5,22,40.5,22s-7.7-12-18-13.3c-0.6-0.1-2.6-0.1-3-0.1c-10,1-18,13.7-18,13.7s8.7,8.6,17,9.9
	C19.4,32.6,22.4,32.6,23.4,32.4z M11.1,20.7c0-5.2,4.4-9.4,9.9-9.4s9.9,4.2,9.9,9.4S26.5,30,21,30S11.1,25.8,11.1,20.7z'/>
</svg></div><span>" . date('j F Y H:i', $message['date']) ."</span></div></div>";
 $source .= "</div>";
}

require_once ('src/site.html');

?>