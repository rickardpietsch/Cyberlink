<?php

require __DIR__.'/views/header.php';

if (isset($_POST['post_id'])) {
  $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

  $statement = $pdo->prepare("SELECT * from posts NATURAL JOIN users WHERE post_id=:post_id AND user_id=:user_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
  $statement->execute();
  $post = $statement->fetch(PDO::FETCH_ASSOC);
}
?>
<h1>Edit post</h1>
<div class="container">
  <div class="row pt-5 justify-content-center">
      <div class="col-md-6">
          <form action="app/auth/a_edit.php" method="post">
              <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

              <div class="form-group">
                  <label for="title">Title</label>
                  <input class="form-control" type="text" name="title" value="<?php echo $post['title']; ?>">
                  <small class="form-text text-muted">New title.</small>
              </div><!-- /form-group -->

              <div class="form-group">
                  <label for="title">Description</label>
                  <textarea class="form-control" name="description" rows="8" cols="80" value=""><?php echo $post['description']; ?></textarea>
                  <small class="form-text text-muted">New Description.</small>
              </div><!-- /form-group -->

              <div class="form-group">
                <label for="title">Url</label>
                <input class="form-control" type="url" name="url" value="<?php echo $post['url']; ?>">
                <small class="form-text text-muted">New URL.</small>
              </div><!-- /form-group -->

              <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div><!-- /col-md-6 -->
  </div><!-- /row -->
</div><!-- /container -->
