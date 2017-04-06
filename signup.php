<?php
require "includes/top.php";
?>
<div class="welcomeContainer">
  <h1 class="centerText customH1">Sign up for Brakets!</h1>
</div>
<article>
<form action="#" method="post">

<div class="formGroup centerText">
  <h2 class="customH2">Create your username:</h2>
  <input type="text" name="username" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="customH2">Create your password:</h2>
  <input type="password" name="password" value="" />
</div>

<input class="mainBtn formGroup centerText" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Sign Up" >
</form>

</article>

<?php
  if (isset($_POST['btnSubmit'])) {
    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");
    $data = array();
    $data[] = $username;
    $data[] = $password;

    $query = 'SELECT * FROM tblUsers';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($results as $result) {
      if ($result['fldUsername'] == $username) {
        echo 'Username already exists! Please choose another one.';
      }
      else {
        $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
        session_write_close();
        header('Location:index.php');
      }
    }
  }
  require "includes/footer.php";
?>
