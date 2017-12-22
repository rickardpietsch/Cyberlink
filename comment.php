<?php

require __DIR__.'/views/header.php';

if (isset($_GET['post_id'])) {
  $postId = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);

  $statement = $pdo->prepare("SELECT * FROM users NATURAL JOIN posts WHERE author_id=user_id AND post_id=:post_id");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
  $statement->execute();
  $post = $statement->fetch(PDO::FETCH_ASSOC);
}
?>
<h1>Comment post</h1>
<h3>Title: <?php echo $post['title'] ?></h3>
<p>Description: <?php echo $post['description'] ?></p>
<p>Author: <?php echo $post['username']?></p>

<div class="container">
  <div class="row pt-5 justify-content-center">
      <div class="col-md-6">
          <form action="app/posts/a_comment.php" method="post">
              <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">

              <div class="form-group">
                  <label for="title">Add a comment</label>
                  <textarea class="form-control" name="comment" rows="4" cols="80" value=""></textarea>
              </div><!-- /form-group -->

              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div><!-- /col-md-6 -->
  </div><!-- /row -->
</div><!-- /container -->
