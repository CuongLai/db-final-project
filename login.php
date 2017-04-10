<?php
  require 'includes/top.php';
  $page = $_GET['page'];
?>

  <div class="welcomeContainer">
    <h1 class="centerText welcomeH1 textShadow">Log in to</h1>
    <img class="centerImg" alt="Brakets logo" src="css/images/logo.png">
  </div>
<form class = "formGroup" action="#" method="post">
  <div class="centerText">
    <h2 class="customH1">Username:</h2>
    <input type="text" name="username" value="cuong" />
  </div>

  <div class="centerText">
    <h2 class="customH1">Password:</h2>
    <input type="password" name="password" value="admin" />
  </div>

  <input class="mainBtn linkBtn" id="btnSubmit" name="login" type="submit" value="Log In" >
  <a class="secondaryBtn secondaryLinkBtn" href="signup.php">Register</a>
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
              header('Location:index.php');
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
