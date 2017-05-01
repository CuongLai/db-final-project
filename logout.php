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
<div class="createBracketContainer">
  <div class="loginCenterButtons">
    <h1 class="centerText customH2">Thank you for using Brakets!</h1>
    <button class="matchBtn"><a class="matchLnkBtn" href="index.php">Home</a></button>
    <button class="matchBtn"><a class="matchLnkBtn" href="login.php?page=0">Log back in</a></button>
  </div>
</div>
