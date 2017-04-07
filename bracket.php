<?php
  require 'includes/top.php';
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $results = $thisDatabaseReader->select($query, $data);

  foreach ($results as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }
?>

<?php
  require 'includes/footer.php';
?>
