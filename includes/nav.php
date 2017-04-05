<nav>
  <ol>
    <?php
      print '<li ';
      if ($PATH_PARTS['filename'] == 'index') {
        print ' class="activePage" ';
      }
      print '><a href="index.php">Home</a></li>';

      print '<li';
      if ($PATH_PARTS['filename'] == 'createBracket') {
        print ' class="activePage" ';
      }
      print '><a href="form-trails.php?trailId=0">Start a bracket</a></li>';
    ?>
  </ol>
</nav>
