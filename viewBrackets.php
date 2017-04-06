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
      print '<th>' . $result['fldBracketName'] . '</th>';
      if ($result['fldElim'] == 0) {
        print '<th>Single</th>';
      }
      else {
        print '<th>Double</th>';
      }
      print '<th>' . $result['fldNumMatches'] . '</th>';
      print '</tr>';
    }
  }
  }
  else {
    header('Location:login.php');
  }
  require 'includes/footer.php';
?>
