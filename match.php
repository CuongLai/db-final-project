<?php
  require 'includes/top.php';
  $player1 = $_GET['p1'];
  $player2 = $_GET['p2'];

  print '<div class="thisMatch">';
  print ' <div class="thisContainer">';
  print '   <button type="button" onclick="add(1)">' . $player1 . '</button>';
  print '   <p id="player1">0</p>';
  print ' </div>';
  print ' <div class="thisContainer">';
  print '   <button type="button" onclick="add(2)">' . $player2 . '</button>';
  print '   <p id="player2">0</p>';
  print ' </div>';
  print '</div>';

  print '<div id="winner"></div>';
?>

<script type="text/javascript">
  var counter1 = 0;
  var counter2 = 0;
  function add(i) {
    if (i == 1) {
      if (counter1 < 3) {
        counter1++;
        document.getElementById("player1").innerHTML = counter1;
        if (counter2 == 3) {
          document.getElementById("winner").innerHTML = i;
        }
      }
      else {
        document.getElementById("winner").innerHTML = i;
      }
    }
    else {
      if (counter2 < 3) {
        counter2++;
        document.getElementById("player2").innerHTML = counter2;
        if (counter2 == 3) {
          document.getElementById("winner").innerHTML = i;
        }
      }
    }
  }
</script>

<?php
  require 'includes/footer.php';
?>
