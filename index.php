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
    $statement = $pdo->prepare("SELECT * from users NATURAL JOIN posts WHERE author_id=user_id");
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach ($posts as $post): ?>
      <h3><?php echo $post['title']?></h3>
      <p><?php echo $post['description']?></p>
      <a target="_blank" href="<?php echo $post['url']?>"><?php echo $post['url']?></a>
      <p>Author: <?php echo $post['username']?></p>
    <?php endforeach ?>
  </article>
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
