<?php
  require "includes/top.php";
  $id = $_GET['id'];

  $data[] = 1;
  $data[] = $id;
  $query = 'UPDATE tblUsers SET fldConfirmed=? WHERE pmkUserId=?';
  $results = $thisDatabaseWriter->update($query, $data);
?>
<div class="createBracketContainer">
  <div class="loginCenterButtons">
    <h1 class="centerText customH2">You just confirmed your account with Brakets!</h1>
    <button class="matchBtn"><a class="matchLnkBtn" href="index.php">Home</a></button>
    <button class="matchBtn"><a class="matchLnkBtn" href="createBracket.php">Start your first bracket</a></button>
  </div>
</div>
