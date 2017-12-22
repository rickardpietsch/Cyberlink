<?php

require __DIR__.'/../autoload.php';

if (isset($_POST['post_id'])) {
  $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

  $statement = $pdo->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES(:post_id, :user_id, :comment)");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
  $statement->execute();

  header('Location: /comment.php');

}
