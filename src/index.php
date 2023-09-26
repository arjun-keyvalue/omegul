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

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Omegul</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inclusive+Sans"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container">
      <div class="chat-left">
        <div class="chat-menu">
          <div class="chat-header">
            <span class="title">Omegul</span>
          </div>
          <div class="left-menu">
            <a class="menu-item" href="profile.php"
              ><?= $user->getUsername() ?></a
            >
          </div>
        </div>
      </div>
      <div class="chat-right">
        <div class="chat-messages-container">
          <div class="chat-messages">
            <?php foreach ($messages as $index =>
            $message): ?>
            <div
              class="<?= ($index % 2 === 0) ? 'message-left' : 'message-right'?>"
            >
              <div
                class="message <?= ($index % 2 === 0) ? 'left-bubble' : 'right-bubble'?>"
              >
                <div class="message-author">
                  <a href="user.php?id=<?= $message->getUserId() ?>">
                    <?= $message->getUser()->getUsername() ?>
                  </a>
                </div>
                <div class="message-created-at">
                  <?= $message->getCreatedAt()->format('H:i') ?>
                </div>
                <div class="message-content"><?= $message->getContent() ?></div>
              </div>
            </div>

            <?php endforeach ?>
          </div>
        </div>
        <form method="post" action="send_message.php">
          <div class="chat-input">
            <input
              name="message"
              type="text"
              class="message-input"
              placeholder="Type your message..."
            />
            <input
              type="hidden"
              name="user_id"
              class="user_id"
              value="<?= $user->getId() ?>"
            />
            <button type="submit" name="send_message" class="send-button">
              Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
