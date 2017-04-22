<?php
  require 'includes/top.php';
  if (isset($_SESSION['user'])) {
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $bracket = $thisDatabaseReader->select($query, $data);

  foreach ($bracket as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }

  print '<script>';
     print 'var roundI = 0;';
     print 'var matchI = 0;';
  print '</script>';

  print '<div id="bracketPlayers" class="bracket">';
  for ($i = 1; $i <= $bracket[0]['fldNumRounds']; $i++) {
    $data = array();
    $data[] = $id;
    $data[] = $i;
    $query = 'SELECT * FROM tblBracketsPeople WHERE fnkBracketId=? AND fldRoundId=?';
    $matchInfo = $thisDatabaseReader->select($query, $data);
    print '<div id="round" class="round">';

    print '<script>';
       print 'var d = document.getElementById("bracketPlayers").children[roundI];';
       print 'roundI++;';
       print 'var matchI = 0;';
    print '</script>';

    foreach ($matchInfo as $match) {
      $data = array();
      $data[] = $match['fnkPlayer1Id'];
      $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
      $player1 = $thisDatabaseReader->select($query, $data);
      $data = array();
      $data[] = $match['fnkPlayer2Id'];
      $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
      $player2 = $thisDatabaseReader->select($query, $data);
      print '<div id ="match" class="match">';

      print '<script>';
      print "var d2 = d.getElementsByTagName('div')[matchI];";
      print 'matchI++;';
      print '</script>';


      print ' <p id= "player1Container" class="playerContainer">' . $player1[0]['fldName'] . '</p>';
      print ' <p class="scoreContainer">' . $match['fldP1Score'] . '</p>';
      print ' <p id= "player2Container" class="playerContainer">' . $player2[0]['fldName'] . '</p>';
      print ' <p class="scoreContainer">' . $match['fldP2Score'] . '</p>';
      if ($match['fldP1Score'] == 3) {

        print '<script>';
        print "var d3 = d2.getElementsByTagName('p')[0];";
        print 'd3.className += " winningPlayer";';
        print "var d4 = d2.getElementsByTagName('p')[2];";;
        print 'd4.className += " losingPlayer";';
        print '</script>';
      }
      elseif ($match['fldP2Score'] == 3) {
      print '<script>';
      print "var d3 = d2.getElementsByTagName('p')[2];";
      print 'd3.className += " winningPlayer";';
      print "var d4 = d2.getElementsByTagName('p')[0];";
      print 'd4.className += " losingPlayer";';
      print '</script>';
       }
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
  }
  else {
    header("Location:login.php?page=0");
  }
  require 'includes/footer.php';
?>
