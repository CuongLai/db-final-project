<?php
  require 'includes/top.php';
  $player1 = $_GET['p1'];
  $player2 = $_GET['p2'];

  print '<div class="thisMatch">';
  print ' <div class="thisContainer">';
  print '   <button type="button" onclick="add(1)">' . $player1 . '</button>';
  print '   <input type="text" id="player1" value=0 readonly />';
  print ' </div>';
  print ' <div class="thisContainer">';
  print '   <button type="button" onclick="add(2)">' . $player2 . '</button>';
  print '   <input type="text" id="player2" value=0 readonly />';
  print ' </div>';
  print '</div>';

  print '<p id="winner"></p>';
?>

<script type="text/javascript">
  var counter1 = 0;
  var counter2 = 0;
  var stop = 0;
  function add(i) {
    if (stop == 0) {
      if (i == 1) {
        if (counter1 < 2) {
          counter1++;
          document.getElementById("player1").value = counter1;
        }
        else if (counter1 == 2) {
          counter1++
          document.getElementById("player1").value = counter1;
          document.getElementById("winner").innerHTML = i;
          stop = 1;
        }
      }
      else {
        if (counter2 < 2) {
          counter2++;
          document.getElementById("player2").value = counter2;
        }
        else if (counter2 == 2) {
          counter2++
          document.getElementById("player2").value = counter2;
          document.getElementById("winner").innerHTML = i;
          stop = 1;
        }
      }
    }
  }
</script>

<?php
  require 'includes/footer.php';
?>
