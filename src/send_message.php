<?php

require_once '../index.php';

$message_content = $_POST['message'];
$user_id = $_POST['user_id'];

if (
  (isset($message_content) && $message_content != NULL || !empty($message_content)) &&
  (isset($user_id) && $user_id != NULL || !empty($user_id))
) {
  $message = new Message();
  $message->setContent($message_content);
  $message->setUserId($user_id);
  $message->save();
} else {
  // Nothing to send
}

header('Location: /');