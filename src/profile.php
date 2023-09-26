<?php
use Propel\Runtime\ActiveQuery\Criteria;

require_once '../index.php';

$user_ip = $_SERVER['REMOTE_ADDR'];
$user = (new UserQuery())->findOneByIpAddress($user_ip);

if ($user == null) {
  header('Location: /');
}

$first_message = (new MessageQuery())->orderByCreatedAt(Criteria::ASC)->findOneByUserId($user->getId());
$last_message = (new MessageQuery())->orderByCreatedAt(Criteria::DESC)->findOneByUserId($user->getId());
$message_count = (new MessageQuery())->filterByUserId($user->getId())->count();

$secrets = (new SecretQuery())->findByUserId($user->getId());
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
  <p class="user-username">
    <?= $user->getUsername() ?>
  </p>
  <div class="user-card-content">
  <p class="user-created-at">
    Joined on:
    <?= $user->getCreatedAt()->format('d.m.y H:i:s') ?>
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
  <hr/>
  </div>
  <div class="secrets">
    <div class="sub-title">Secrets</div>
    <div class="para">You can upload your secrets securely. Only txt, pdf, docx, jpg & png files are supported.</div>
    <form class="secret-upload" method="post" enctype="multipart/form-data" action="upload_secret.php">
      <div class="upload-buttons" >
      <input type="file" name="secret_file" class="secret_file">
      <input type="hidden" name="user_id" class="user_id" value="<?= $user->getId() ?>">
      <input type="submit" name="upload_secret" class="upload_secret" value="Upload">
  </div>
    </form>
<hr/>
  <?php if (count($secrets) > 0): ?>
    <div class="sub-title">Your secrets</div>
      <?php foreach ($secrets as $secret): ?>
        <div class="secrets-secret">
          <a href="uploads/<?= $secret->getId() . '.' . $secret->getFileType() ?>">
            <?= $secret->getFileName() ?>
          </a>
          <form class="secret-delete" method="post" action="delete_secret.php">
            <input type="hidden" name="user_id" class="user_id" value="<?= $user->getId() ?>">
            <input type="hidden" name="secret_id" class="secret_id" value="<?= $secret->getId() ?>">
            <button name="delete_secret" class="delete_secret">Delete</button>
          </form>
      </div>
      <?php endforeach ?>
  <?php endif ?>
  </div>
</div>
      </div>
<script>
  const secretUploadForm = document.querySelector('.secret-upload');

  secretUploadForm.addEventListener('submit', (e) => {
    const files = e.target.querySelector('.secret_file').files;
    const allowedMimeTypes = [
      'text/plain',
      'image/jpeg',
      'image/png',
      'application/pdf',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (files.length == 0) {
      e.preventDefault();
    } else {
      if (!allowedMimeTypes.includes(files[0].type)) {
        alert('Unsupported file detected. Please use the supported formats.');
        e.preventDefault();
      }
    }
  })
</script>

</html>