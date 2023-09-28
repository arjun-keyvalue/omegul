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
$arrayMessages = iterator_to_array($messages);
$reversedMessages = array_reverse($arrayMessages);

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
      <div class="chat-nav">
        <span class="title">Omegul</span>
        <div class="profile-button">
            <img class="profile-icon" src="./assets/avathar.svg" alt="send">
            <a href="profile.php"
              ><?= $user->getUsername() ?></a
            >
        </div>
      </div>
      <div class="chat-container">
        <div class="chat-messages-container">
          <div class="chat-messages">
            <?php foreach ($reversedMessages as $index =>
            $message): ?>
            <div
              class="<?= ($user->getId() != $message->getUserId()) ? 'message-left' : 'message-right'?>"
            >
              <div
                class="message <?= ($user->getId() != $message->getUserId()) ? 'left-bubble' : 'right-bubble'?>"
              >
                <div class="message-author">
                  <a href="user.php?id=<?= $message->getUserId() ?>">
                    <?= $message->getUser()->getUsername() ?>
                  </a>
                </div>
                <div class="message-created-at">
                <?php
                  $originalTime = $message->getCreatedAt();
                  $utcTime = $originalTime->setTimezone(new DateTimeZone('UTC'));
                  echo $utcTime->format('H:i');
                ?>
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
              <img class="send-icon" src="./assets/send.svg" alt="send">
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>