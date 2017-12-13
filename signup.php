<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Sign up</h1>

    <form action="app/auth/a_signup.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" required>
            <small class="form-text text-muted">Please choose a username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" type="email" name="email" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please choose a password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
