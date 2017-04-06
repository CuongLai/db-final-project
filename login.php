<?php require 'includes/top.php'; ?>

<form action="#" method="post">
  <h1>Log in to create and access your brackets!</h1>

  <label>Username: </label>
  <input type="text" class="login" placeholder="Please enter your username..." name="username">

  <label>Password: </label>
  <input type="password" class="login" placeholder="Please enter your password..." name="password">

  <input type="submit" class="loginBtn" value="Log In" name="login">
</form>

<?php
  if (isset($_POST['login'])) {
    $credentials = array();
    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $credentials[] = $username;
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");
    $credentials[] = $password;

    foreach ($credentials as $credential) {
      echo $credential;
    }
  }
	// else:
	// 	header("Location:hub.php");
	// endif;
?>
