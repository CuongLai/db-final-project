<?php
print '<!-- begin including libraries -->';
include 'lib/constants.php';
include LIB_PATH . '/Connect-With-Database.php';
print '<!-- libraries complete-->';

$q = $_GET['q'];
$query = 'SELECT * FROM tblPeople';
$results = $thisDatabaseReader->select($query, "");

$hint = "";
if ($q !== "") {
  $q = strtolower($q);
  $len = strlen($q);
  foreach ($results as $result) {
    if (stristr($q, substr($result['fldName'], 0, $len))) {
      if ($hint === "") {
        $hint = '<a href="#" id="nameLink">' . $result['fldName'] . '</a>';
      } else {
        $hint .= '<br><a href="#" id="nameLink">' . $result['fldName'] . '</a>';
      }
    }
  }
}

if ($hint == "") {
  $response="No Suggestion";
} else {
  $response=$hint;
}

echo $response;
?>
