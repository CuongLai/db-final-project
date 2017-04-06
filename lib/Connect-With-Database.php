<?php
print '<!-- make Database connections -->';

  require_once(BIN_PATH . '/Database.php');

  $thisDatabaseReader = new Database(DATABASE_READER, DATABASE_READER_PWD, DATABASE_NAME);

  $thisDatabaseWriter = new Database(DATABASE_WRITER, DATABASE_WRITER_PWD, DATABASE_NAME);

print '<!-- Database connections comlete -->';
?>
