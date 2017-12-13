<?php

if (!$statement) {
  die(var_dump($pdo->errorInfo()));
}

if (!$statement->execute()) {
  die(var_dump($pdo->errorInfo()));
}

die(var_dump($user));
