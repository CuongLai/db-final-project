<?php
require "includes/top.php";
if (isset($_SESSION['user'])) {
?>
<?php

//Init all the variables
$formBracketName = "";
$formFldElim = "";
$formFldNumPlayers = 2;
$formFldCompletion = "";
$formPlayerNames = "";

//init error messages
$formBracketNameERROR = false;
$formFldElimERROR = false;
$formFldNumMatchesERROR = false;


//init the data array, and the error array
$data = array();
$errorMsg = array();

//form processing
if (isset($_POST["btnSubmit"])) {

//security check, does this actually work? @REVIEW
if (!securityCheck($yourURL)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

//SANITIZING: removing HTML and JS from inputs
$formBracketName = htmlentities($_POST["bracketName"], ENT_QUOTES, "UTF-8");


$formFldElim = htmlentities($_POST["elimination"], ENT_QUOTES, "UTF-8");


$formFldNumPlayers = htmlentities($_POST["bracketSize"], ENT_QUOTES, "UTF-8");

$formFldNumRounds = log($formFldNumPlayers, 2);
//validation, error messages
if ($formBracketName == "") {
        $errorMsg[] = "Enter your bracket name!";
        $formBracketNameERROR = true;
    } elseif (!verifyAlphaNum($formBracketName)) {
        $errorMsg[] = "Your bracket name appears to have extra characters.";
        $formBracketNameERROR = true;
}

if ($formFldElim == "") {
        $errorMsg[] = "Enter the type of bracket!";
        $formFldElimERROR = true;
    } elseif (!verifyAlphaNum($formFldElim)) {
        $errorMsg[] = "You didn't select a type of bracket!";
        $formFldElimERROR = true;
}

if ($formFldNumMatches < 2) {
        $errorMsg[] = "You need atleast 2 players!";
        $formFldNumMatches = true;
    }

//set up the query
$query = 'INSERT INTO tblBrackets SET fldBracketName = ?, fldElim = ?, fldNumPlayers = ?, fldNumRounds = ?, fldCompletion =?';
$data = array($formBracketName, $formFldElim, $formFldNumPlayers, $formFldNumRounds, 0);

//checking the Security of our query, insert if it's good
if ($thisDatabaseWriter->querySecurityOk($query, 0)) {
                $query = $thisDatabaseWriter->sanitizeQuery($query);
                $results = $thisDatabaseWriter->insert($query, $data);
                $primaryKey = $thisDatabaseWriter->lastInsert();
            }
if ($fldNumPlayers == 16) {
  $numMatches = 15;
}
else if ($fldNumPlayers == 8) {
  $numMatches = 7;
}
else if ($fldNumPlayers == 4) {
  $numMatches = 3;
}
$nextMatch = 1;
for ($i=1; $i<=$formfldNumPlayers/2; $i++) {
  $data = array();
  $data[] = $primaryKey;
  $data[] = 1;
  $data[] = $i;
  $data[] = $nextMatch;
  if (($i%2) != 0) {
    $nextMatch++;
  }
}


 ?>
 <?php
 if ($errorMsg) {
   print '<div id="errors">';
   print '<h1>Your form has the following mistakes</h1>';
   print "<ol>\n";
   foreach ($errorMsg as $err) {
       print "<li>" . $err . "</li>\n";
   }
   print "</ol>\n";
   print '</div>';
}
}
?>
<div class="middle-80 padding-10">
<div class="createBracketContainer">
  <h1 class="centerText customH2">Please create your bracket</h1>
<article>
</div>
<div class="viewBracketsTableContainer">
<form action="#" method="post">
<div class="formGroup centerText">
  <h2 class="loginH1">Enter your bracket name:</h2>
  <input type="text" name="bracketName" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Type of tournament bracket:</h2>
  <input class="" type="radio" name="elimination" value="0"> Single
  <input class="" type="radio" name="elimination" value="1"> Double
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Enter number of entrants:</h2>
  <input type="number" name="bracketSize" value="2" />
</div>
<div class="loginCenterButtons">
<input class="mainBtn linkBtn" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Create Bracket" />
</div>
</form>
</div>
</div>


</article>

<?php
    require "includes/footer.php";
  }
  else {
    header('Location:login.php?page=1');
  };
?>
