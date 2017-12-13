<?php require __DIR__.'/views/header.php'; ?>

<?php if (isset($_SESSION['user'])): ?>
  <p>Welcome, <?php echo $_SESSION['user']['username']?>!</p>
<?php endif; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
