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
    <h2 class="customP">Username:</h2>
    <input type="text" name="username" value="cuong" />
  </div>

  <div class="loginCenter">
    <h2 class="customP">Password:</h2>
    <input type="password" name="password" value="admin" />
  </div>
  <div class="loginCenterButtons">
  <input class="mainBtn linkBtn centerText" id="btnSubmit" name="login" type="submit" value="Log In" >
  <a class="secondaryBtn secondaryLinkBtn" href="signup.php">Register</a>
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

    if(!$_SESSION['user']) {
      $query = 'SELECT * FROM tblUsers WHERE fldUsername=?';
      $results = $thisDatabaseReader->select($query, $data);

      if (!empty($results)) {
        foreach ($results as $result) {
          if ($result['fldPassword'] == $password) {
            $_SESSION['user'] = isset($_SESSION['user']) ? $_SESSION['user'] : '';
            $_SESSION['username'] = $result['fldUsername'];
            if ($result['fldAdmin'] == 1) {
              $_SESSION['admin'] = true;
            }
            session_write_close();
            if ($page == 1) {
              header('Location:createBracket.php');
            }
            else if ($page == 2) {
              header('Location:viewBrackets.php');
            }
            else {
              header('Location:viewBrackets.php');
            }
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
