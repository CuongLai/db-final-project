<?php
  require 'includes/top.php';
  if (isset($_SESSION['user'])) {

  $matchId = $_GET['matchId'];
  $final = $_GET['final'];
  $bracketId = $_GET['bracketId'];
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

  print '<div class="middle-80">';
  print '<div class="viewBracketsTitleContainer">';
  print '<h1 class = "centerText customH2">BO5 Match</h1>';
  print '</div>';

  print '<script>';
     print 'var counter1 = ' . $matchInfo[0]['fldP1Score'] . ';';
     print 'var counter2 = ' . $matchInfo[0]['fldP2Score'] . ';';
  print '</script>';

  print '<div class="viewBracketsTableContainer">';
  print '<form action="#" method="post">';
  print '<div class="thisMatch clear">';
  print ' <div class="thisContainer">';
  print '   <p id="winner1"></p>';
  print '   <p class="thisPlayer">' . $player1[0]['fldName'];
  print '   <input type="text" class ="matchInput" id="player1" value=' . $matchInfo[0]['fldP1Score'] . ' name="p1Score" readonly />';
  print '</p>';
  print '   <button class="matchBtn" type="button" onclick="subtract(1)">-</button>';
  print '   <button class="matchBtn" type="button" onclick="add(1)">+</button>';
  print ' </div>';
  print ' <div class="thisContainer">';
  print '   <p id="winner2"></p>';
  print '   <p class="thisPlayer">' . $player2[0]['fldName'];
  print '   <input type="text" class="matchInput" id="player2" value=' . $matchInfo[0]['fldP2Score'] . ' name="p2Score" readonly />';
  print '</p>';
  print '   <button class="matchBtn" type="button" onclick="subtract(2)">-</button>';
  print '   <button class="matchBtn" type="button" onclick="add(2)">+</button>';
  print ' </div>';
  print '</div>';
  print '<div class="loginCenterButtons">';
  print '<button class="matchBtn" type="button"><a class="matchLnkBtn" href="bracket.php?id=' . $matchInfo[0]['fnkBracketId'] . '">Cancel</a></button>';
  print '<button class="matchBtn matchLnkBtn" type="button" onclick="resetScore()">Reset</button>';
  print '<button class="matchBtn matchLnkBtn" type="submit" name="submit">Save Results</button>';
  print '</div>';
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
        if ($matchInfo[0]['fldRoundId'] != $final) {
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
        else {
          $data = array();
          $data[] = 1;
          $data[] = $bracketId;
          $query = 'UPDATE tblBrackets SET fldCompletion=? WHERE pmkBracketId=?';
          $results = $thisDatabaseWriter->update($query, $data);
        }
      }

      header('Location:bracket.php?id=' . $matchInfo[0]['fnkBracketId'] . '');
  }
print '</div>';
print '</div>';
?>

<script type="text/javascript">
  function add(i) {
    if (counter1 < 3 && counter2 < 3) {
      if (i == 1) {
        if (counter1 < 3) {
          counter1++;
          document.getElementById("player1").value = counter1;
        }
      }
      else {
        counter2++;
        document.getElementById("player2").value = counter2;
      }
    }
    else if (counter1 == 3) {
      if (i == 2) {
        if (counter2 < 2) {
          counter2++
          document.getElementById("player2").value = counter2;
        }
      }
    }
    else if (counter2 == 3) {
      if (i == 1) {
        if (counter1 < 2) {
          counter1++;
          document.getElementById("player1").value = counter1;
        }
      }
    }
  }
  function subtract(i) {
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
  function resetScore() {
    counter1 = 0;
    counter2 = 0;
    document.getElementById("player1").value = counter1;
    document.getElementById("player2").value = counter2;
  }
</script>

<?php
  } else {
    header("Location:login.php?page=0");
  }
  require 'includes/footer.php';
?>
