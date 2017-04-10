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
        if ($PATH_PARTS['filename'] == 'viewBrackets') {
          print ' class="activePage" ';
        }
        print '><a href="viewBrackets.php">Your Brackets</a></li>';

        if (isset($_SESSION['user'])) {
          if (isset($_SESSION['admin'])) {
            print '<li ';
            if ($PATH_PARTS['filename'] == 'confirmUser') {
              print ' class="activePage" ';
            }
            print '><a href="./confirmUser.php">Pending Requests</a></li>';
          }
        }

        if (!isset($_SESSION['user'])) {
          print '<li ';
          if ($PATH_PARTS['filename'] == 'login') {
            print ' class="activePage" ';
          }
          print '><a href="./login.php?page=0">Log In!</a></li>';
        }

        if (isset($_SESSION['user'])) {
          print '<li ';
          if ($PATH_PARTS['filename'] == 'logout') {
            print ' class="activePage" ';
          }
          print '><a href="./logout.php">Log Out</a></li>';
        }
      ?>
    </ul>
  </div>
</nav>
