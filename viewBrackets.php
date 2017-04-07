<?php
  require 'includes/top.php';
  if (isset($_SESSION['user'])) {
    $query = 'SELECT * FROM tblBrackets';
    $results = $thisDatabaseReader->select($query, '');
?>
<table>
  <tr>
    <th>Bracket Name</th>
    <th>Elimination Type</th>
    <th># of Players</th>
    <th>Status</th>
  </tr>
<?php
  if (!empty($results)) {
    foreach ($results as $result) {
      print '<tr href="bracket.php?id=' . $result['pmkBracketId'] . '">';
      print '<td><a href="bracket.php?id=' . $result['pmkBracketId'] . '">';
      print $result['fldBracketName'] . '</a></td>';
      if ($result['fldElim'] == 0) {
        print '<td>Single</td>';
      }
      else {
        print '<td>Double</td>';
      }
      print '<td>' . $result['fldNumMatches'] . '</td>';
      if ($result['fldCompletion'] == 0) {
        print '<td>In-progress</td>';
      }
      else {
        print '<td>Completed</td>';
      }
      print '</tr>';
    }
  }
  print '</table>';
  }
  else {
    header('Location:login.php');
  }
  require 'includes/footer.php';
?>
