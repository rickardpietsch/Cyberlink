<?php

declare(strict_types=1);

require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");

$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>

<img src="/images/<?php echo $user['image']?>" alt=""></img>
<div class="form-group">
    <label for="image">Choose an avatar picture to upload.</label>
    <input class="form-control" type="file" name="image">
</div>
