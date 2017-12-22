<?php

require __DIR__.'/../autoload.php';

$postId = filter_var($_GET['post_id'], FILTER_SANITIZE_STRING);
$rating = filter_var($_GET['vote'], FILTER_SANITIZE_STRING);
// die(var_dump($rating));

$statement = $pdo->prepare("SELECT * FROM votes WHERE post_id=:post_id AND user_id=:user_id"); //Om den inte finns = INSERT, Om finns UPDATE, begränsa med pointer event i css
if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();
$vote = $statement->fetch(PDO::FETCH_ASSOC);

if (!$vote) {
  $statement = $pdo->prepare("INSERT INTO votes (post_id, user_id, vote) VALUES (:post_id, :user_id, :vote)");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
}
else {
  $statement = $pdo->prepare("UPDATE votes SET vote=:vote WHERE post_id=:post_id AND user_id=:user_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
}
$statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->bindParam(':vote', $rating, PDO::PARAM_INT);
$statement->execute();
// die(var_dump($statement));
header('Location: /index.php');
