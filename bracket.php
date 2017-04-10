<?php
  require 'includes/top.php';
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $results = $thisDatabaseReader->select($query, $data);

  foreach ($results as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }

  $numMatches = $results[0]['fldNumMatches'];
  for ($i = 0; $i < $numMatches; $i++) {
    print '<div class="match">';
    print '</div>';
  }
?>

<?php
  require 'includes/footer.php';
?>
