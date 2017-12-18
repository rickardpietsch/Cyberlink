<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'], $_POST['description'], $_POST['url'])) {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);

  $statement = $pdo->prepare("INSERT INTO posts (title, description, url, author_id) VALUES(:title, :description, :url, :author_id)");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->bindParam(':url', $url, PDO::PARAM_STR);
  $statement->bindParam(':author_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();

  header('Location: /index.php');

}
