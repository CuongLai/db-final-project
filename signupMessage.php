<?php
  require "includes/top.php";
  if (isset($_SESSION['user'])) {
?>
<h1>Thank you for signing up for Brakets!</h1>
<button class="mainBtn"><a href="index.php">Home</a></button>
<button class="mainBtn"><a href="createBracket.php">Start your first bracket</a></button>
<?php
  } else {
    header("Location:login.php?page=0");
  }
?>
