<?php
  require 'includes/top.php';
  $id = $_GET['id'];
  $data[] = $id;
  $query = 'SELECT * FROM tblBrackets WHERE pmkBracketId=?';
  $brackets = $thisDatabaseReader->select($query, $data);

  $query = 'SELECT * FROM tblPeople WHERE fnkBracketId=?';
  $players = $thisDatabaseReader->select($query, $data);

  foreach ($brackets as $title) {
    print '<h1 class="welcomeH1 centerText textShadow">' . $title["fldBracketName"] . '</h1>';
  }

  $numMatches = $brackets[0]['fldNumMatches'];
  for ($i = 0; $i < $numMatches; $i+=2) {
    print '<div class="match">';
    print ' <div class="container">';
    print '   <button type="button" onclick="add(' . $i . ')">' . $players[$i]['fldName'] . '</button>';
    print '   <p id="' . $i . '">0</p>';
    print ' <div class="container">';
    $j = $i+1;
    print '   <button type="button" onclick="add(' . $j . ')">' . $players[$j]['fldName'] . '</button>';
    print '   <p id="' . $j . '">0</p>';
    print '</div>';
  }
?>

<script type="text/javascript">
var counter = 0;
  function add(i) {

    counter++;
    document.getElementById(i).innerHTML = counter;
  }
</script>

<?php
  require 'includes/footer.php';
?>
