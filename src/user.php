<?php
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;

require_once '../index.php';

$user_id = $_GET['id'];

// User details
if (isset($user_id) && $user_id != NULL || !empty($user_id)) {
  $connection = Propel::getConnection();
  $users_query = "SELECT * FROM users WHERE id = '" . $user_id . "'";
  $statement = $connection->prepare($users_query);
  $statement->execute();
  $users = $statement->fetchAll();

  if (count($users) == 0) {
    header('Location: /404.php');
  }
} else {
  header('Location: /404.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Omegul</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <div class="container profile-container">
    <span class="title"><a href="/">Omegul</a></span>
<div class="user-card">
<?php foreach ($users as $user): ?>
    <?php
    $dateString = $user['created_at'];
    $format = "Y-m-d H:i:s.u";
    $user_created_at = DateTime::createFromFormat($format, $dateString);

    $first_message = (new MessageQuery())->orderByCreatedAt(Criteria::ASC)->findOneByUserId($user['id']);
    $last_message = (new MessageQuery())->orderByCreatedAt(Criteria::DESC)->findOneByUserId($user['id']);
    $message_count = (new MessageQuery())->filterByUserId($user['id'])->count();
    ?>
  <p class="user-username">
  <?= $user['username'] ?>
  </p>
  <div class="user-card-content">
  <p class="user-created-at">
    Joined on:
    <?= $user_created_at->format('d.m.y H:i:s') ?>
  </p>
  <?php if ($first_message != null): ?>
    <p>
      First message:
      <?= $first_message->getCreatedAt()->format('d.m.y H:i:s') ?>
    </p>
    <p>
      Last message:
      <?= $last_message->getCreatedAt()->format('d.m.y H:i:s') ?>
    </p>
    <p>
      Total messages:
      <?= $message_count ?>
    </p>
  <?php endif ?>
  <?php endforeach ?>
      </div>

</html>