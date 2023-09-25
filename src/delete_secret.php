<?php

require_once '../index.php';

$user_id = $_POST['user_id'];
$secret_id = $_POST['secret_id'];

if (
  (isset($user_id) && $user_id != NULL || !empty($user_id)) &&
  (isset($secret_id) && $secret_id != NULL || !empty($secret_id))
) {
  $secret_query = new SecretQuery();
  $secret = $secret_query->filterByArray(['id' => $secret_id, 'userId' => $user_id])->findOne();
  $secret->delete();

  unlink('uploads/' . $secret->getId() . '.' . $secret->getFileType());
  header('Location: /profile.php');
}