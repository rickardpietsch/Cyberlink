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
    $statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE author_id=user_id ORDER BY post_id DESC");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach ($posts as $post): ?>
      <h3><?php echo $post['title'] ?></h3>
      <p><?php echo $post['description'] ?></p>
      <a target="_blank" href="<?php echo $post['url']?>"><?php echo $post['url'] ?></a>
      <p>Author: <?php echo $post['username']?></p>
      <i class="icon" dataSet=1>Plus</i>
      <i class="icon" dataSet=-1>Minus</i>

      <?php if ($post['user_id'] == $_SESSION['user']['user_id']): ?>
      <form action="edit_post.php" method="post">
          <input type="hidden" name="post_id" value="<?php echo $post['post_id'] ?>">
          <a href="edit_post.php"><button type="submit" class="btn btn-primary">Edit/Delete</button></a>
      </form>
    <?php endif; ?>
  <?php endforeach; ?>
  </article>
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
