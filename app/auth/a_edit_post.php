<?php

require __DIR__.'/../autoload.php';

if (isset($_POST['post_id'])) {
  $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

  if (isset($_POST['title'])) {
    $title = password_hash($_POST['title'], FILTER_SANITIZE_STRING);
  }

  if (isset($_POST['description'])) {
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  }

  if (isset($_POST['url'])) {
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
  }

  $statement = $pdo->prepare("UPDATE posts set title=:title, description=:description, url=:url WHERE post_id = :post_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }


  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->bindParam(':url', $url, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();

  header('Location: /profile.php');

}
