<?php
  require "includes/top.php";
  $id = $_GET['id'];

  $data[] = 1;
  $data[] = $id;
  $query = 'UPDATE tblUsers SET fldConfirmed=? WHERE pmkUserId=?';
  $results = $thisDatabaseWriter->update($query, $data);
?>
<h1>You just confirmed your account with Brakets!</h1>
<p>Thanks for using Brakets!</p>
<button class="mainBtn"><a href="index.php">Home</a></button>
<button class="mainBtn"><a href="createBracket.php">Start your first bracket</a></button>
