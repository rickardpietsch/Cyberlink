<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['email'])) {
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

  if (isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  }

  if (isset($_POST['bio'])) {
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
  } else {
    $bio = "";
  }

  $statement = $pdo->prepare("UPDATE users SET username=:username, email=:email, password=:password, bio=:bio WHERE user_id=:user_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }


  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':password', $password, PDO::PARAM_STR);
  $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();

  header('Location: /profile.php');

}

if (isset($_FILES['image'])) {
  $image = $_FILES['image'];
  $info = pathinfo($_FILES['image']['name']); //Skapar array ur 'name'
  $ext = $info['extension']; //Väljer 'extension' ur 'name'
  $fileName = $_SESSION['user']['username'].'.'.$ext;

  move_uploaded_file($image['tmp_name'], __DIR__.'/../../images/'.$fileName);

  $statement = $pdo->prepare("UPDATE users set image=:image WHERE user_id = :user_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  $statement->bindParam(':image', $fileName, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();

  header('Location: /profile.php');
}
