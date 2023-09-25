<?php

require_once '../index.php';

$secret_file = $_FILES['secret_file'];
$user_id = $_POST['user_id'];

if (isset($secret_file) && $secret_file != NULL || !empty($secret_file)) {
  $file_name = $secret_file['name'];
  $tmp_name = $secret_file['tmp_name'];
  $file_split = explode('.', $file_name);
  $file_type = $file_split[count($file_split) - 1];

  $secret = new Secret();
  $secret->setFileName($file_name);
  $secret->setFileType($file_type);
  $secret->setUserId($user_id);
  $secret->save();

  $targetDirectory = 'uploads/';
  $targetFile = $targetDirectory . $secret->getId() . '.' . $file_type;

  if (is_uploaded_file($tmp_name)) {
    move_uploaded_file($tmp_name, $targetFile);
  } else {
    echo 'Invalid file.';
  }

  header('Location: /profile.php');
}