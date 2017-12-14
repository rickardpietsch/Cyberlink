<?php

declare(strict_types=1);

require __DIR__.'/views/header.php';

$statement = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");

$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>
<h1>Create post</h1>
<div class="container">
    <div class="row pt-5 justify-content-center">
        <div class="col-md-6">
            <form action="app/auth/a_post.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" value="" required>
                    <!-- <small class="form-text text-muted">Please provide a new username.</small> -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="title">Description</label>
                    <textarea class="form-control" name="description" rows="8" cols="80" required></textarea>
                    <!-- <small class="form-text text-muted">Please provide a new e-mail adress.</small> -->
                </div><!-- /form-group -->

                <div class="form-group">
                    <label for="title">Url</label>
                    <input class="form-control" type="url" name="url" value="" required>
                    <!-- <small class="form-text text-muted">Please provide a new password.</small> -->
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-primary">Post</button>
            </form>
        </div><!-- /col-md-6 -->
    </div><!-- /row -->
</div><!-- /container -->
