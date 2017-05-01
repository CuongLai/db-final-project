<?php
  require 'includes/top.php';
  if (isset($_SESSION['user'])) {
    $data[] = $_SESSION['userId'];
    $query = 'SELECT * FROM tblBrackets WHERE fnkUserId=?';
    $results = $thisDatabaseReader->select($query, $data);
?>
<div class="middle-80">

<div class="viewBracketsTitleContainer">
  <h1 class = "centerText customH2">Your Brakets</h1>
</div>
<?php
  if (!empty($results)) {
    foreach ($results as $result) {
      print'<table class="viewBracketsTableContainer">';
        print'<tr class ="tableRow">';
          print'<th>Braket Name</th>';
          print'<th># of Players</th>';
          print'<th>Status</th>';
        print'</tr>';
      print '<tr href="bracket.php?id=' . $result['pmkBracketId'] . '">';
      print '<td class="tableRow"><a href="bracket.php?id=' . $result['pmkBracketId'] . '">';
      print $result['fldBracketName'] . '</a></td>';
      print '<td>' . $result['fldNumPlayers'] . '</td>';
      if ($result['fldCompletion'] == 0) {
        print '<td>In-progress</td>';
      }
      else {
        print '<td>Completed</td>';
      }
      print '</tr>';
    }
  }
  else {
    print "<h1 class='loginH1'>You don't have any Brakets...</h1>";
    print '<button class="mainBtn"><a href="createBracket.php">Start your first braket</a></button>';
  }
  print '</table>';
  print '</div>';
  }
  else {
    header('Location:login.php?page=2');
  }
  require 'includes/footer.php';
?>
