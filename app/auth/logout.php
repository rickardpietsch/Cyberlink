<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

session_destroy();

header('Location: /../../index.php');

// In this file we logout users.
