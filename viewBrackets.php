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
  </tr>
<?php
  if (!empty($results)) {
    foreach ($results as $result) {
      print '<tr>';
      print '<td>' . $result['fldBracketName'] . '</td>';
      if ($result['fldElim'] == 0) {
        print '<td>Single</td>';
      }
      else {
        print '<td>Double</td>';
      }
      print '<td>' . $result['fldNumMatches'] . '</td>';
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
