<?php

declare(strict_types=1);

require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");

$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>

<article>
  <div class="row">
    <div class="col-">
      <h1>Profile</h1>
      <h3>Username: <?php echo $user['username']?></h3>
      <h3>E-mail: <?php echo $user['email']?></h3>
      <h3>Bio: <?php echo $user['bio']?></h3>
      <a href="edit.php"><button type="button" class="btn btn-primary">Update profile</button></a>
    </div>

    <div class="col-">
      <img src="
      <?php if(isset($user['image'])): ?>
      <?php echo "/images/".$user['image'] ?>
      <?php else: echo "/images/trump.jpg" ?>
      <?php endif; ?>
      " alt=""></img>
      <a href="image.php"><button type="button" class="btn btn-primary">Change avatar</button></a>
    </div>
  </div>
</article>
