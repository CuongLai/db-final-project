<?php
  require 'includes/top.php';
  print '<div class="welcomeContainer">';
  print '<div class="middle-80">';
  print '<h1 class="welcomeH1 centerText textShadow"> Welcome to</h1>';
  print '<img class="centerImg welcomeImg" src="./css/images/logo.png" alt="logo for our website" />';
  print '<div class="clear">';

  if (!isset($_SESSION['user'])) {
    print '<div class="left-40">';
    print '<h1 class="floatLeft customH1 subH1">Ready to get your tournament going?</h1>';
    print '<p class="floatleft customP subHeading">Use our simple bracket manager to make your tournament! For any of your favorite games.</p>';
    print'</div>';
    print '<div class="right-50">';
    print '<img class="floatRight bracketExampleImage" src="./css/images/bracket-example.png" />';
    print '</div>';
    print '</div>';
    print '<button class="mainBtn"><a class="linkBtn" href="signup.php">Sign up</a></button>';
    print '<button class="secondaryBtn"><a class="linkBtn secondaryLinkBtn" href="#">Learn more</a></button>';
    print '</div>';
    print '</div>';
  }
  else {
    print '<h1 class="floatLeft customH1 subH1">Welcome ' . $_SESSION['username'] . '!</h1>';

    print '<h1 class="floatLeft customH1 subH1">Start a bracket for your tournament!</h1>';
    print '</div>';
    print '<button class="mainBtn"><a class="linkBtn" href="createBracket.php">Create</a></button>';
    print '</div>';
  }
?>

<?php
  require 'includes/footer.php';
?>
