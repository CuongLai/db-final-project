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

<div class="formGroup centerText">
  <h2 class="loginH1">Gender:</h2>
  <select name="gender">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Choose your favorite games:</h2>
  <?php
  $query = 'SELECT * FROM tblGames';
  $results = $thisDatabaseReader->select($query, '');
  foreach ($results as $result) {
    print '<input type="checkbox" name="game[]" value="' . $result['pmkGamesId'] . '">' . $result['fldName'] . '</input>';
  }
  ?>
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Which of the following are you:</h2>
  <input type="radio" name="userType" value="Tournament Organizer">Tournament Organizer</input>
  <input type="radio" name="userType" value="Player">Player</input>
  <input type="radio" name="userType" value="Staff">Staff</input>
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
    $username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
    $gender = htmlentities($_POST['gender'], ENT_QUOTES, "UTF-8");
    $userType = htmlentities($_POST['userType'], ENT_QUOTES, "UTF-8");
    $games = $_POST['game'];

    $data = array();
    $data[] = $username;
    $data[] = $password;
    $data[] = $gender;
    $data[] = $userType;
    $data[] = 0;

    $error = false;

    $query = 'SELECT * FROM tblUsers';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($results as $result) {
      if ($result['fldUsername'] == $username) {
        $error = true;
      }
    }
    if ($error === false) {
      $query = 'INSERT INTO tblUsers SET fldUsername=?, fldPassword=?, fldGender=?, fldUserType=?, fldAdmin=?';
      $results = $thisDatabaseWriter->insert($query, $data);
      $userId = $thisDatabaseWriter->lastInsert();
      foreach ($games as $game) {
        $gameData = array();
        $gameData[] = $userId;
        $gameData[] = $game;
        $query = 'INSERT INTO tblUsersGames SET fnkUserId=?, fnkGameId=?';
        $results = $thisDatabaseWriter->insert($query, $gameData);
      }
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
