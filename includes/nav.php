<nav>
  <div class = "navContainer">
    <ul>
      <?php
        print '<li ';
        if ($PATH_PARTS['filename'] == 'index') {
          print ' class="activePage" ';
        }
        print '><a href="./index.php"><img class = "floatLeft navLogo" alt="Brakets logo" src="css/images/logo-mini.png"></a></li>';

        print '<li ';
        if ($PATH_PARTS['filename'] == 'createBracket') {
          print ' class="activePage" ';
        }
        print '><a href="createBracket.php">Start a bracket</a></li>';

        print '<li ';
        if ($PATH_PARTS['filename'] == 'login') {
          print ' class="activePage" ';
        }
        print '><a href="./login.php">Log In!</a></li>';
      ?>
    </ul>
  </div>
</nav>
