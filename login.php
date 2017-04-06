<?php require 'includes/top.php'; ?>

<form action="#" method="post">
  <h1>Log in to create and access your brackets!</h1>

  <label>Username: </label>
  <input type="text" class="login" placeholder="Please enter your username..." value="cuong" name="username">

  <label>Password: </label>
  <input type="password" class="login" placeholder="Please enter your password..." value="admin" name="password">

  <input type="submit" class="loginBtn" value="Log In" name="login">
  <a href="signup.php">Register</a>
</form>

<?php
  if (isset($_POST['login'])) {
    $_SESSION['user'] = '';

    $data = array();
    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $data[] = $username;
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

    $errors = array();

    if(!$_SESSION['user']) {
      $query = 'SELECT * FROM tblUsers WHERE fldUsername=?';
      $results = $thisDatabaseReader->select($query, $data);

      if (!empty($results)) {
        foreach ($results as $result) {
          if ($result['fldPassword'] == $password) {
            $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
            session_write_close();
            header('Location:index.php');
          }
        }
        echo 'Wrong username or password';
      }
      else {
        echo 'Wrong username or password';
      }
    }
  }
?>
