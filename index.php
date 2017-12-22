<?php require __DIR__.'/views/header.php'; ?>

<?php if (isset($_SESSION['user'])): ?>
  <p>Welcome, <?php echo $_SESSION['user']['username']?>!</p>
<?php endif; ?>

<article>
  <h1><?php echo $config['title']; ?></h1>
</article>

<?php if (isset($_SESSION['user'])): ?>
  <article>
    <?php
    $statement = $pdo->prepare("SELECT * FROM users NATURAL JOIN posts WHERE author_id=user_id ORDER BY post_id DESC");
    // $statement = $pdo->prepare("SELECT SUM(vote) * FROM votes NATURAL JOIN posts WHERE post_id=post_id AND author_id=user_id ORDER BY post_id DESC");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php
    // $statement = $pdo->prepare("SELECT SUM(vote) FROM votes NATURAL JOIN posts WHERE post_id=post_id;");
    // $statement->execute();
    // $votesSum = $statement->fetch(PDO::FETCH_ASSOC);
    // die(var_dump($votesSum));
    ?>
    <?php foreach ($posts as $post): ?>
      <h3><?php echo $post['title'] ?></h3>
      <p><?php echo $post['description'] ?></p>
      <a target="_blank" href="<?php echo $post['url']?>"><?php echo $post['url'] ?></a>
      <p>Author: <?php echo $post['username']?></p>
      <p>Rating: </p>
      <i class="icon" data-post_id="<?php echo $post['post_id'] ?>" data-vote="1">Plus</i>
      <i class="icon" data-post_id="<?php echo $post['post_id'] ?>" data-vote="-1">Minus</i>

      <?php if ($post['user_id'] == $_SESSION['user']['user_id']): ?>
      <form action="edit_post.php" method="post">
          <input type="hidden" name="post_id" value="<?php echo $post['post_id'] ?>">
          <a href="edit_post.php"><button type="submit" class="btn btn-primary">Edit/Delete</button></a>
      </form>
      <form action="comment.php" method="get">
          <input type="hidden" name="post_id" value="<?php echo $post['post_id'] ?>">
          <a href="comment.php"><button type="submit" class="btn btn-primary">Comment</button></a>
      </form>
    <?php endif; ?>
  <?php endforeach; ?>
  </article>
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
