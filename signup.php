<?php
require "includes/top.php";
?>
<div class="middle-80">
<div class="viewBracketsTitleContainer">

  <h1 class="centerText customH1">Sign up for Brakets!</h1>
<article>
<form action="#" method="post">

<div class="formGroup centerText">
  <h2 class="loginH1">Create your username:</h2>
  <input type="text" name="username" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Create your password:</h2>
  <input type="password" name="password" value="" />
</div>

<div class="loginCenterButtons">
<input class="mainBtn linkBtn" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Sign Up" >
</div>
</form>
</div>
</div>
</article>

<?php
  if (isset($_POST['btnSubmit'])) {
    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");
    $data = array();
    $data[] = $username;
    $data[] = $password;

    $error = false;

    $query = 'SELECT * FROM tblUsers';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($results as $result) {
      if ($result['fldUsername'] == $username) {
        $error = true;
      }
    }
    if ($error === false) {
      $query = 'INSERT INTO tblUsers SET fldUsername=?, fldPassword=?';
      $results = $thisDatabaseWriter->insert($query, $data);
      $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
      $_SESSION['username'] = $data[0];
      session_write_close();
      header('Location:signupMessage.php');
    }
    else {
      echo 'Username already exists! Please choose another one.';
    }
  }
  require "includes/footer.php";
?>
