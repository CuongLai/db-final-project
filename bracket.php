<?php
  require 'includes/top.php';
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $bracket = $thisDatabaseReader->select($query, $data);

  foreach ($bracket as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }

  print '<div class="bracket">';
  for ($i = 1; $i <= $bracket[0]['fldNumRounds']; $i++) {
    $data = array();
    $data[] = $id;
    $data[] = $i;
    $query = 'SELECT * FROM tblBracketsPeople WHERE fnkBracketId=? AND fldRoundId=?';
    $matchInfo = $thisDatabaseReader->select($query, $data);
    print '<div class="round">';
    foreach ($matchInfo as $match) {
      $data = array();
      $data[] = $match['fnkPlayer1Id'];
      $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
      $player1 = $thisDatabaseReader->select($query, $data);
      $data = array();
      $data[] = $match['fnkPlayer2Id'];
      $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
      $player2 = $thisDatabaseReader->select($query, $data);
      print '<div class="match">';
      print ' <p class="playerContainer">' . $player1[0]['fldName'] . '</p>';
      print ' <p class="scoreContainer">' . $match['fldP1Score'] . '</p>';
      print ' <p class="playerContainer">' . $player2[0]['fldName'] . '</p>';
      print ' <p class="scoreContainer">' . $match['fldP2Score'] . '</p>';
      if ($player1[0]['pmkPlayerId'] != 0 && $player2[0]['pmkPlayerId'] != 0) {
        print ' <a href="match.php?matchId=' . $match['pmkMatchId'] . '&final=' . $bracket[0]['fldNumRounds'] . '&bracketId=' . $id . '">';
        if ($match['fldP1Score'] == 0 && $match['fldP2Score'] == 0) {
          print 'Start match';
        } else {
          print 'Edit match';
        }
        print ' </a>';
      }
      print '</div>';
    }
    print '</div>';
  }
  print '</div>';

  require 'includes/footer.php';
?>
