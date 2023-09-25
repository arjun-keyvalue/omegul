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

<nav>
  <h1>Omegul</h1>
  <div class="nav-section">
    <a href="/">Home</a>
    <a href="profile.php">Profile</a>
  </div>
</nav>

<div class="user">
  <p class="user-username">
    Username:
    <?= $user->getUsername() ?>
  </p>
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

  <div class="secrets">
    <h3>Secrets</h3>
    <h4>You can upload your secrets securely. Only txt, pdf, docx, jpg & png files are supported.</h4>
    <form class="secret-upload" method="post" enctype="multipart/form-data" action="upload_secret.php">
      <label for="file">Choose a file:</label>
      <input type="file" name="secret_file" class="secret_file">
      <input type="hidden" name="user_id" class="user_id" value="<?= $user->getId() ?>">
      <input type="submit" name="upload_secret" class="upload_secret" value="Upload">
    </form>
  </div>

  <?php if (count($secrets) > 0): ?>
    <h4>Your secrets</h4>
    <ul class="secrets-all">
      <?php foreach ($secrets as $secret): ?>
        <li class="secrets-secret">
          <a href="uploads/<?= $secret->getId() . '.' . $secret->getFileType() ?>">
            <?= $secret->getFileName() ?>
          </a>
          <form class="secret-delete" method="post" action="delete_secret.php">
            <input type="hidden" name="user_id" class="user_id" value="<?= $user->getId() ?>">
            <input type="hidden" name="secret_id" class="secret_id" value="<?= $secret->getId() ?>">
            <input type="submit" name="delete_secret" class="delete_secret" value="Delete">
          </form>
        </li>
      <?php endforeach ?>
    </ul>
  <?php endif ?>
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