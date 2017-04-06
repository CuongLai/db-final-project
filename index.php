<?php
  require 'includes/top.php';
  print '<div class="welcomeContainer">';
  print '<h1 class="welcomeH1 centerText textShadow"> Welcome to</h1>';
  print '<img class="centerImg" src="./css/images/logo.png" alt="logo for our website" />';
  print '</div>';
?>
<h1>Ready to get your tournament going?</h1>
<p>Use our simple bracket manager to make your tournament! For any of <b>your favorite games</b></p>
<button class="mainBtn"><a href="signUp.php">Sign up</a></button>
<?php
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
  require 'includes/footer.php';
?>
