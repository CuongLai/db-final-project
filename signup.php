<?php
require "includes/top.php";
?>
<div class="middle-80">
<div class="viewBracketsTitleContainer">

  <h1 class="centerText customH1">Sign up for Brakets!</h1>
<article>
<form action="" method="post">

<div class="formGroup centerText">
  <h2 class="loginH1">Create your username:</h2>
  <input type="text" name="username" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Create your password:</h2>
  <input type="password" name="password" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Enter your email:</h2>
  <input type="text" name="email" value="" />
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
    $data = array();
    $error = array();

    if (!isset($_POST['username'])) {
      $username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
      $data[] = $username;
    } else {
      $error[] = 2;
    }
    if (!isset($_POST['password'])) {
      $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
      $data[] = $password;
    } else {
      $error[] = 3;
    }
    if (!isset($_POST['email'])) {
      $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
      $data[] = $email;
    } else {
      $error[] = 4;
    }
    $gender = htmlentities($_POST['gender'], ENT_QUOTES, "UTF-8");
    $data[] = $gender;
    if (!isset($_POST['userType'])) {
      $userType = htmlentities($_POST['userType'], ENT_QUOTES, "UTF-8");
      $data[] = $userType;
    } else {
      $error[] = 6;
    }
    if (!isset($_POST['game'])) {
      $games = $_POST['game'];
    } else {
      $error[] = 5;
    }

    $query = 'SELECT * FROM tblUsers';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($results as $result) {
      if ($result['fldUsername'] == $username) {
        $error[] = 1;
      }
    }
    $data[] = 0;
    if (empty($error)) {
      print_r($data);
      $query = 'INSERT INTO tblUsers SET fldUsername=?, fldPassword=?, fldEmail=?, fldGender=?, fldUserType=?, fldConfirmed=?';
      $results = $thisDatabaseWriter->insert($query, $data);
      $userId = $thisDatabaseWriter->lastInsert();
      foreach ($games as $game) {
        $gameData = array();
        $gameData[] = $userId;
        $gameData[] = $game;
        $query = 'INSERT INTO tblUsersGames SET fnkUserId=?, fnkGameId=?';
        $results = $thisDatabaseWriter->insert($query, $gameData);
      }
      $subject = 'Welcome to Brakets!';
      $message = 'Thanks for signing up for Brakets! Click on the link below to get started with your first bracket! https://chlai.w3.uvm.edu/cs148/dev/final/login.php';
      mail($email, $subject, $message);

      header('Location:signupMessage.php');
    }
    else {
      $errorMsgs = array();
      foreach ($error as $error) {
        switch ($error) {
          case 1:
            $errorMsgs[] = "Username already exists! Please choose another one.";
          case 2:
            $errorMsgs[] = "Please enter a username!";
          case 3:
            $errorMsgs[] = "Please enter a password!";
          case 4:
            $errorMsgs[] = "Please enter your email!";
          case 5:
            $errorMsgs[] = "Please choose at least one game!";
          case 6:
            $errorMsgs[] = "Please choose what type of user you are!";
        }
      }
      foreach ($errorMsgs as $errorMsg) {
        print '<p class="errorMsg">' . $errorMsg . '</p>';
      }
    }
  }
  require "includes/footer.php";
?>
