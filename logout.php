<?php
  require 'includes/top.php';
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
?>

<h1>Thank you for using Brakets!</h1>
<button class="mainBtn"><a href="index.php">Home</a></button>
<button class="mainBtn"><a href="login.php?page=0">Log back in</a></button>
