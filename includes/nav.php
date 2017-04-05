<nav>
  <ol>
    <?php
      print '<li ';
      if ($PATH_PARTS['filename'] == 'index') {
        print ' class="activePage" ';
      }
      print '><a href="./index.php">Home</a></li>';

      print '<li ';
      if ($PATH_PARTS['filename'] == 'createBracket') {
        print ' class="activePage" ';
      }
      print '><a href="createBracket.php">Start a bracket</a></li>';
    ?>
  </ol>
</nav>
