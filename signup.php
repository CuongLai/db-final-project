<?php
require "includes/top.php";
?>
<div class="middle-80">
<div class="viewBracketsTitleContainer">

  <h1 class="centerText customH2">Sign up for Brakets!</h1>
<article>
<form action="" method="post">

<div class="formGroup centerText">
  <h2 class="loginH1">Create your username:</h2>
  <input id="signupInput" type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Create your password:</h2>
  <input id="signupInput" type="password" name="password" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Enter your email:</h2>
  <input id="signupInput" type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Gender:</h2>
  <select id="signupInput" name="gender">
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
    print '<input class="signUpMargin" type="checkbox" name="game[]" value="' . $result['pmkGamesId'] . '">' . $result['fldName'] . '</input>';
  }
  ?>
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Which of the following are you:</h2>
  <input class="signUpMargin" type="radio" name="userType" value="Tournament Organizer">Tournament Organizer</input>
  <input class="signUpMargin" type="radio" name="userType" value="Player">Player</input>
  <input class="signUpMargin" type="radio" name="userType" value="Staff">Staff</input>
</div>

<div class="loginCenterButtons signUpBottom">
<input class="mainBtn linkBtn" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Sign Up" >
</div>
</form>
</div>
</div>
</article>

<?php
  if (isset($_POST['btnSubmit'])) {
    $data = array();
    $errors = array();

    $username = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
    if (empty($username)) {
      $errors[] = 2;
    } else {
      $data[] = $username;
    }

    $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
    if (empty($password)) {
      $errors[] = 3;
    } else {
      $data[] = $password;
    }

    $email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
    if (empty($email)) {
      $errors[] = 4;
    } else {
      $data[] = $email;
    }

    $gender = htmlentities($_POST['gender'], ENT_QUOTES, "UTF-8");
    $data[] = $gender;

    if (isset($_POST['userType'])) {
      $userType = htmlentities($_POST['userType'], ENT_QUOTES, "UTF-8");
      $data[] = $userType;
    } else {
      $errors[] = 6;
    }
    if (isset($_POST['game'])) {
      $games = $_POST['game'];
    } else {
      $errors[] = 5;
    }

    $query = 'SELECT * FROM tblUsers';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($results as $result) {
      if ($result['fldUsername'] == $username) {
        $errors[] = 1;
      }
    }
    $data[] = 0;
    if (empty($errors)) {
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

      //email the user to confirm
      $to = $email;
      $subject = 'Welcome to Brakets!';
      $message = '
      <html>
      <head>
        <title>Thanks for signing up for Brakets!</title>
      </head>
      <body>
        <p>Thanks for signing up for Brakets, ' . $username . '!</p>
        <p>Your account will be created after you click the link below.</p>
        <p>Confirmation link: https://chlai.w3.uvm.edu/cs148/dev/final/confirmUser.php?id=' . $userId . '</p>
      </body>
      </html>
      ';
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-type: text/html; charset=iso-8859-1';
      $headers[] = 'From: Brakets Team <braketsofficial@gmail.com>';
      mail($to, $subject, $message, implode("\r\n", $headers));

      header('Location:signupMessage.php');
    }
    else {
      $errorMsgs = array();
      foreach ($errors as $error) {
        if ($error == 1) {
          $errorMsgs[] = "Username already exists! Please choose another one.";
        }
        else if ($error == 2) {
          $errorMsgs[] = "Please enter a username!";
        }
        else if ($error == 3) {
          $errorMsgs[] = "Please enter a password!";
        }
        else if ($error == 4) {
          $errorMsgs[] = "Please enter your email!";
        }
        else if ($error == 5) {
          $errorMsgs[] = "Please choose at least one game!";
        }
        else if ($error == 6) {
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
