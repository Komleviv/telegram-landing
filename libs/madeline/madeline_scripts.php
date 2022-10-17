<?php
// Скачиваем библиотеку MadelineProto, если её ещё нет, и подключаем
if (!file_exists('libs/madeline/madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'libs/madeline/madeline.php');
}
include 'libs/madeline/madeline.php';

// функция подключения к API Telegram 
function connect() { 
  $settings = [
      'app_info' => [ // Эти данные мы получили после регистрации приложения на https://my.telegram.org
          'api_id' => '28022471',
          'api_hash' => '1665e36b7cd6313a4468876f7bf875c3',
      ],
      'logger' => [ // Вывод сообщений и ошибок
          'logger' => 3, // выводим сообещения через echo
          'logger_level' => 4, // выводим только критические ошибки.
      ],
    'serialization' => [
          'serialization_interval' => 300,
          //Очищать файл сессии от некритичных данных. 
          //Значительно снижает потребление памяти при интенсивном использовании, но может вызывать проблемы
          'cleanup_before_serialization' => true,
      ],
  ];

  $MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
  $MadelineProto->start();  
  
  return $MadelineProto;
}

// Функция получения сообщений
function get_messages($peer, $min_id, $limit) {
  $MadelineProto = connect();
  $messages_Messages = $MadelineProto->messages->getHistory([
      'peer' => $peer, 
      'offset_id' => 0, 
      'offset_date' => 0, 
      'add_offset' => 0, 
      'limit' => 10, 
      'max_id' => 0, 
      'min_id' => $min_id, 
      'hash' => $limit, 
  ]);

  $messages = $messages_Messages['messages'];
  
  return $messages;
}

// Функция получения медиа-файла конкретного сообщения
function get_images($message) {
  $MadelineProto = connect();
  // Если информация о сообщение содержит медиа-файл, сохраняем его в выбранную категорию
  if (!empty($message['media'])) {
     yield $MadelineProto->downloadToDir($message, getcwd() . '/img/');
  }
}

?>