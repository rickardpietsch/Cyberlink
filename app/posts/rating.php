<?php

require __DIR__.'/../autoload.php';

if (isset($_GET['post_id'])) {
  $postId = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $vote = filter_var($_GET['vote'], FILTER_SANITIZE_NUMBER_INT);

  $statement = $pdo->prepare("INSERT INTO votes (post_id, user_id, vote) VALUES(:post_id, :user_id, :vote)");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->bindParam(':vote', $vote, PDO::PARAM_INT);
  $statement->execute();

  header('Location: /index.php');

}
