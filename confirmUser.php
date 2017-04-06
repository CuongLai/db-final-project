<?php
  require 'includes/top.php';
  if (isset($_SESSION['user'])) {
    if (isset($_SESSION['admin'])) {
      $query = 'SELECT * FROM tblPending';
      $requests = $thisDatabaseReader->select($query, '');
?>
<table>
<?php
  if (!empty($requests)) {
    foreach ($requests as $request) {
      print '<tr>';
      print ' <td>' . $request['fldUser'] . '</td>';
      print '</tr>';
    }
  }
  print '</table>';
}
}
  else {
    print '<h1>Thanks for your interesting in becoming a user! You will get confirmation soon.</h1>';
    print '<button href="index.php" value="Home"/>';
  }
  require 'includes/footer.php';
?>
