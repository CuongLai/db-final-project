<?php
  require 'includes/top.php';
  $matchId = $_GET['matchId'];
  $data = array();
  $data[] = $matchId;

  $query = 'SELECT * FROM tblBracketsPeople WHERE pmkMatchId=?';
  $matchInfo = $thisDatabaseReader->select($query, $data);

  $data = array();
  $data[] = $matchInfo[0]['fnkPlayer1Id'];
  $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
  $player1 = $thisDatabaseReader->select($query, $data);

  $data = array();
  $data[] = $matchInfo[0]['fnkPlayer2Id'];
  $query = 'SELECT * FROM tblPeople WHERE pmkPlayerId=?';
  $player2 = $thisDatabaseReader->select($query, $data);

  print '<h1 class="welcomeH1 centerText textShadow">Bo5 Match</h1>';

  print '<form action="#" method="post">';
  print '<div class="thisMatch">';
  print ' <div class="thisContainer">';
  print '   <p id="winner1"></p>';
  print '   <p>' . $player1[0]['fldName'] . '</p>';
  print '   <button type="button" onclick="subtract(1)">-</button>';
  print '   <input type="text" id="player1" value=' . $matchInfo[0]['fldP1Score'] . ' name="p1Score" readonly />';
  print '   <button type="button" onclick="add(1)">+</button>';
  print ' </div>';
  print ' <div class="thisContainer">';
  print '   <p id="winner2"></p>';
  print '   <p>' . $player2[0]['fldName'] . '</p>';
  print '   <button type="button" onclick="subtract(2)">-</button>';
  print '   <input type="text" id="player2" value=' . $matchInfo[0]['fldP2Score'] . ' name="p2Score" readonly />';
  print '   <button type="button" onclick="add(2)">+</button>';
  print ' </div>';
  print '</div>';

  print '<button class="mainBtn" type="button"><a href="bracket.php?id=' . $matchInfo[0]['fnkBracketId'] . '">Cancel</a></button>';
  print '<button class="mainBtn" type="button" onclick="resetScore()">Reset</button>';
  print '<button class="mainBtn" type="submit" name="submit">Save Results</button>';

  print '</form>';

  if (isset($_POST['submit'])) {
      $p1Score = htmlentities($_POST['p1Score'], ENT_QUOTES, "UTF-8");
      $p2Score = htmlentities($_POST['p2Score'], ENT_QUOTES, "UTF-8");
      $data = array();
      $data[] = $p1Score;
      $data[] = $p2Score;
      $data[] = $matchId;

      $query = 'UPDATE tblBracketsPeople SET fldP1Score=?, fldP2Score=? WHERE pmkMatchId=?';
      $results = $thisDatabaseWriter->update($query, $data);

      if ($p1Score == 3 || $p2Score == 3) {
        if ($matchInfo[0]['fldRoundId'] != 4) {
          $data = array();
          if ($p1Score > $p2Score) {
            $data[] = $matchInfo[0]['fnkPlayer1Id'];
          } else {
            $data[] = $matchInfo[0]['fnkPlayer2Id'];
          }
          $data[] = $matchInfo[0]['fldRoundId'] + 1;
          $data[] = $matchInfo[0]['fldNextMatch'];

          if ($matchInfo[0]['fldWhichPlayer'] == 1) {
            $query = 'UPDATE tblBracketsPeople SET fnkPlayer1Id=? WHERE fldRoundId=? AND fldRoundMatchId=?';
          }
          else {
            $query = 'UPDATE tblBracketsPeople SET fnkPlayer2Id=? WHERE fldRoundId=? AND fldRoundMatchId=?';
          }

          $results = $thisDatabaseWriter->update($query, $data);
        }
      }

      header('Location:bracket.php?id=' . $matchInfo[0]['fnkBracketId'] . '');
  }

?>

<script type="text/javascript">
  var counter1 = 0;
  var counter2 = 0;
  var stop = false;
  function add(i) {
    if (stop == false) {
      console.log("not stopped");
      if (i == 1) {
        if (counter1 < 2) {
          counter1++;
          document.getElementById("player1").value = counter1;
        }
        else if (counter1 == 2) {
          counter1++;
          document.getElementById("player1").value = counter1;
          document.getElementById("winner1").innerHTML = "Winner ->";
          stop = true;
        }
      }
      else {
        if (counter2 < 2) {
          counter2++;
          document.getElementById("player2").value = counter2;
        }
        else if (counter2 == 2) {
          counter2++;
          document.getElementById("player2").value = counter2;
          document.getElementById("winner2").innerHTML = "Winner ->";
          stop = true;
        }
      }
    }
  }
  function subtract(i) {
    if (stop == false) {
      console.log("not stopped");
      if (i == 1) {
        if (counter1 > 0) {
          counter1--;
          document.getElementById("player1").value = counter1;
        }
      }
      else {
        if (counter2 > 0) {
          counter2--;
          document.getElementById("player2").value = counter2;
        }
      }
    }
  }
  function resetScore() {
    counter1 = 0;
    counter2 = 0;
    stop = false;
    document.getElementById("player1").value = counter1;
    document.getElementById("player2").value = counter2;
    document.getElementById("winner1").innerHTML = " ";
    document.getElementById("winner2").innerHTML = " ";
  }
</script>

<?php
  require 'includes/footer.php';
?>
