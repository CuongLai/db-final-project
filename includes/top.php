<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BRAKETS</title>
      <meta charset="utf-8">
      <meta name="author" content="Cuong, Nel">
      <meta name="description" content="Bracket Maker">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
      <![endif]-->
      <link rel="shortcut icon" type="image/png" href="css/images/favicon.png">
      <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
      <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen">


      <?php
        print '<!-- begin including libraries -->';
        include 'lib/constants.php';
        include LIB_PATH . '/Connect-With-Database.php';
        print '<!-- libraries complete-->';
      ?>
  </head>

  <?php
    print '<body id="' . $PATH_PARTS['filename'] . '">';
    $location = $PATH_PARTS['filename'];
    if ($location != 'login' && $location != 'logout' && $location != 'signup') {
      require 'nav.php';
    }
  ?>
