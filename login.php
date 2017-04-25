<?php
  require 'includes/top.php';
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 0;
  }
?>
  <div class="middle-80">
  <div class="viewBracketsTitleContainer">
    <h1 class="centerText customH2">Log in</h1>
  </div>

  <div class="viewBracketsTableContainer">
    <div class="centerImg">
      <img class="loginImg" alt="Brakets logo" src="css/images/logo-mini.png">
    </div>

<form class = "formGroup" action="#" method="post">
  <div class="loginCenter">
    <input type="text" name="username" placeholder="username" value="" />
  </div>

  <div class="loginCenter">
    <input type="password" name="password" placeholder="password" value="" />
  </div>
  <div class="loginCenterButtons">
  <input class="loginBtn linkBtn " id="btnSubmit" name="login" type="submit" value="Log In" >
  <div class="middle-80">
    <p class="loginRegister">
      New to Brakets? <a class="loginA" href="signup.php">Register Here</a>
    </p>
  </div>
  </div>
</form>
</div>
</div>
</div>

<?php
  if (isset($_POST['login'])) {
    $_SESSION['user'] = '';

    $data = array();
    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8");
    $data[] = $username;
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8");

    $errors = array();
    $notConfirmed = false;

    if(!$_SESSION['user']) {
      $query = 'SELECT * FROM tblUsers WHERE fldUsername=?';
      $results = $thisDatabaseReader->select($query, $data);

      if (!empty($results)) {
        foreach ($results as $result) {
          if ($result['fldPassword'] == $password) {
            if ($result['fldConfirmed'] == 1) {
              $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
              $_SESSION['username'] = $result['fldUsername'];
              if ($result['fldAdmin'] == 1) {
                $_SESSION['admin'] = true;
              }
              session_write_close();
              if ($page == 1) {
                header('Location:createBracket.php');
              } else if ($page == 2) {
                header('Location:viewBrackets.php');
              } else {
                header('Location:viewBrackets.php');
              }
            }
            else {
              $notConfirmed = true;
              print '<div class="middle-80">';
              print ' <div class="loginError">';
              print '   <h1 class="centerText customH2">You have not confirmed your account yet!</h1>';
              print ' </div>';
              print '</div>';
            }
          }
        }
        print '<div class="middle-80">';
        print '<div class="loginError">';
        print '<h1 class="centerText customH2">Wrong username or password</h1>';
        print '</div>';
        print '</div>';
      }
      else {
        if ($notConfirmed == false) {
          print '<div class="middle-80">';
          print '<div class="loginError">';
          print '<h1 class="centerText customH2">Wrong username or password</h1>';
          print '</div>';
          print '</div>';
        }
      }
    }
  }
?>
