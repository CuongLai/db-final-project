<?php
  require 'includes/top.php';
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $bracket = $thisDatabaseReader->select($query, $data);

  foreach ($bracket as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }

  $query = 'SELECT * FROM tblBracketsPeople WHERE fnkBracketId=?';
  $matchInfo = $thisDatabaseReader->select($query, $data);

  $matchCount = $bracket[0]['fldNumPlayers'];
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
    print ' <a href="match.php?p1=' . $player1[0]['fldName'] . '&p2=' . $player2[0]['fldName'] . '&id=' . $match['pmkMatchId'] . '">';
    if ($match['fldP1Score'] == 0 && $match['fldP2Score'] == 0) {
      print 'Start match';
    } else {
      print 'Edit match';
    }
    print '</a>';
    print '</div>';
    $matchCount = $matchCount - 1;
  }

  $counter = 0;
  for ($i = 0; $i < $matchCount; $i+=2) {
    print '<div class="match">';
    if ($matchInfo[$i]['fldP1Score'] == 3) {
      print ' <p class="playerContainer">p1</p>';
      print ' <p class="scoreContainer">score</p>';
    }
    else if ($matchInfo[$i]['fldP2Score'] == 3) {
      print ' <p class="playerContainer">p2</p>';
      print ' <p class="scoreContainer">score</p>';
    }
    else {
      print ' <p class="playerContainer"></p>';
      print ' <p class="scoreContainer">0</p>';
    }

    if ($matchInfo[$i+1]['fldP1Score'] == 3) {
      print ' <p class="playerContainer">p1</p>';
      print ' <p class="scoreContainer">score</p>';
    }
    else if ($matchInfo[$i+1]['fldP2Score'] == 3) {
      print ' <p class="playerContainer">p2</p>';
      print ' <p class="scoreContainer">score</p>';
    }
    else {
      print ' <p class="playerContainer"></p>';
      print ' <p class="scoreContainer">0</p>';
    }
    print '</div>';
    $counter++;
  }

  require 'includes/footer.php';
?>
