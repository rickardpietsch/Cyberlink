<?php

declare(strict_types=1);

require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");

$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
    <div class="row pt-5 justify-content-center">
        <div class="col-md-6">
            <form action="app/auth/a_edit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">

                <div class="form-group">
                    <label for="title">Username</label>
                    <input class="form-control" type="text" name="username" value="<?php echo $user['username']; ?>">
                    <small class="form-text text-muted">Please provide a new username.</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="title">E-mail</label>
                    <input class="form-control" type="text" name="email" value="<?php echo $user['email']; ?>">
                    <small class="form-text text-muted">Please provide a new e-mail adress.</small>
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="title">Biography</label>
                    <textarea class="form-control" name="bio" rows="8" cols="80"><?php echo $user['bio']; ?></textarea>
                    <small class="form-text text-muted">Please write a short biography about yourself.</small>
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div><!-- /col-md-6 -->
    </div><!-- /row -->
</div><!-- /container -->
