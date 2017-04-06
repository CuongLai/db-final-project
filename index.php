<?php
  require 'includes/top.php';
  print '<div class="welcomeContainer">';
  print '<h1 class="welcomeH1 centerText textShadow"> Welcome to</h1>';
  print '<img class="centerImg" src="./css/images/logo.png" alt="logo for our website" />';
  print '</div>';
  if (!isset($_SESSION['user'])) {
?>
<h1>Ready to get your tournament going?</h1>
<p>Use our simple bracket manager to make your tournament! For any of <b>your favorite games</b></p>
<button class="mainBtn"><a href="signup.php">Sign up</a></button>
<?php
  }
  else {
?>
<h1>Create a new bracket</h1>
<button class="mainBtn"><a href="createBracket.php">Create</a></button>
<?php
  }
  require 'includes/footer.php';
?>
