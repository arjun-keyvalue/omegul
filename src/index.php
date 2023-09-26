<?php
use Netsensia\Usernames\Generator;

require_once '../index.php';

$user_ip = $_SERVER['REMOTE_ADDR'];
$user_query = new UserQuery();
$user = $user_query->findOneByIpAddress($user_ip);

// Create a new user if not exists
if ($user == null) {
  $user = new User();
  $username_generator = new Generator();
  $username = str_replace(" ", "", $username_generator->generate(random_int(2, 3)));

  $user->setUsername($username);
  $user->setIpAddress($user_ip);
  $user->save();
}

$messages_query = new MessageQuery();
$messages_query = $messages_query->orderByCreatedAt();
$messages = $messages_query->find();

?>

<!DOCTYPE HTML>
<html>
<nav>
  <h1>Omegul</h1>
  <div class="nav-items">
    <a href="/">Home</a>
    <a href="profile.php">Profile</a>
  </div>
</nav>

<!-- Messages -->
<div class="messages">
  <?php foreach ($messages as $message): ?>
    <ul class="message" msg-owns="<?= ($user->getId() == $message->getUserId()) ? 'true' : 'false' ?>">
      <li class="message-author">
        <a href="user.php?id=<?= $message->getUserId() ?>">
          <?= $message->getUser()->getUsername() ?>
        </a>
      </li>
      <li class="message-created-at">
        <?= $message->getCreatedAt()->format('d.m.y H:i:s') ?>
      </li>
      <li class="message-content">
        <?= $message->getContent() ?>
      </li>
    </ul>
  <?php endforeach ?>
</div>

<!-- Form to send message -->
<form class="send-message" method="post" action="send_message.php">
  <textarea name="message" class="message" placeholder="type something..."></textarea>
  <input type="hidden" name="user_id" class="user_id" value="<?= $user->getId() ?>">
  <input type="submit" name="send_message" class="send_message" value="Send">
</form>

</html>