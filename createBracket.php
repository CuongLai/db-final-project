<?php
require "includes/top.php";
if (isset($_SESSION['user'])) {

//Init all the variables
$formBracketName = "";
$formFldNumPlayers = 4;
$formFldCompletion = "";
$formPlayerNames = "";

//init error messages
$playerError = false;

//init the data array, and the error array
$data = array();
$errorMsg = array();

//form processing
if (isset($_POST["btnSubmit"])) {
  //SANITIZING: removing HTML and JS from inputs
  $formBracketName = htmlentities($_POST["bracketName"], ENT_QUOTES, "UTF-8");
  $formFldNumPlayers = htmlentities($_POST["bracketSize"], ENT_QUOTES, "UTF-8");
  $formFldNumRounds = log($formFldNumPlayers, 2);
  $formFldCompletion = 0;

  $players = $_POST['player'];

  //validation, error messages
  if (empty($formBracketName)) {
    $errorMsg[] = "Enter your bracket name!";
  }
  foreach ($players as $player) {
    if (empty($player)) {
      $playerError = true;
    }
  }
  if ($playerError == true) {
    $errorMsg[] = "Enter the player names!";
  }

  //set up the query
  if (empty($errorMsg)) {
    $query = 'INSERT INTO tblBrackets SET fnkUserId=?, fldBracketName=?, fldNumPlayers=?, fldNumRounds=?, fldCompletion=?';
    $id = $_SESSION['userId'];
    $data = array($id, $formBracketName, $formFldNumPlayers, $formFldNumRounds, $formFldCompletion);

    $query = $thisDatabaseWriter->sanitizeQuery($query);
    $results = $thisDatabaseWriter->insert($query, $data);
    $primaryKey = $thisDatabaseWriter->lastInsert();

    $playerArray = array();
    $query = 'SELECT * FROM tblPeople';
    $results = $thisDatabaseReader->select($query, '');
    foreach ($players as $player) {
      $matchFound = false;
      foreach ($results as $result) {
        if ($player == $result['fldName']) {
          $playerArray[] = $result['pmkPlayerId'];
          $matchFound = true;
        }
      }
      if ($matchFound == false) {
        $data = array();
        $data[] = $player;
        $query = 'INSERT INTO tblPeople SET fldName=?';
        $addedPlayer = $thisDatabaseWriter->insert($query, $data);
        $playerArray[] = $thisDatabaseWriter->lastInsert();
      }
    }

    $numMatches = $formFldNumPlayers;
    $playerIndex = 0; //number that will reference the playerArray
    for ($i=1; $i<=$formFldNumRounds; $i++) {
      $nextMatchCount = 1;
      $numMatches = $numMatches / 2;
      for ($j=1; $j<=$numMatches; $j++) {
        $data = array();
        $data[] = $primaryKey; //fnkBracketId
        $data[] = $i; //fldRoundId
        $data[] = $j; //fldRoundMatchId
        if ($j % 2 != 0) { //if odd
          $data[] = $nextMatchCount; //fldNextMatch
          $data[] = 1; //fldWhichPlayer
        }
        else { //if even
          $data[] = $nextMatchCount; //fldNextMatch
          $nextMatchCount++;
          $data[] = 2; //fldWhichPlayer
        }
        if ($i == 1) {
          $data[] = $playerArray[$playerIndex]; //fnkPlayer1Id
          $playerIndex++;
          $data[] = $playerArray[$playerIndex]; //fnkPlayer2Id
          $playerIndex++;
        }
        else {
          $data[] = 0; //fnkPlayer1Id
          $data[] = 0; //fnkPlayer2Id
        }
        $data[] = 0; //fldP1Score
        $data[] = 0; //fldP2Score
        $query = 'INSERT INTO tblBracketsPeople SET fnkBracketId=?, fldRoundId=?, fldRoundMatchId=?, fldNextMatch=?, fldWhichPlayer=?, fnkPlayer1Id=?, fnkPlayer2Id=?, fldP1Score=?, fldP2Score=?';
        $results = $thisDatabaseWriter->insert($query, $data);
      }
    }
    header("Location:viewBrackets.php");
  }

  else {
    foreach ($errorMsg as $err) {
      print '<h1 class="centerText customH2">' . $err . '</h1>';
    }
  }
}
?>

<div class="middle-80 padding-10">
<div class="createBracketContainer">
  <h1 class="centerText customH2">Please create your braket</h1>
<article>
</div>
<div class="viewBracketsTableContainer">
<form action="#" method="post">
<div class="formGroup centerText">
  <h2 class="loginH1">Enter your bracket name:</h2>
  <input id="create" type="text" name="bracketName" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="loginH1">Enter number of entrants:</h2>
  <select id="create" class="numNames" name="bracketSize">
    <option value="4">4</option>
    <option value="8">8</option>
    <option value="16">16</option>
  </select>
</div>
<div class="loginCenterButtons">

<h2 class="loginH1">Enter entrant names:</h2>
<div id="nameText" class="formGroup centerText">
  <div>
    <input type="text" id="create" class="name" name="player[]" placeholder="Add new player" onkeyup="suggestions(this.value)">
  </div>
  <div>
    <input type="text" id="create" class="name" name="player[]" placeholder="Add new player" onkeyup="suggestions(this.value)">
  </div>
  <div>
    <input type="text" id="create" class="name" name="player[]" placeholder="Add new player" onkeyup="suggestions(this.value)">
  </div>
  <div>
    <input type="text" id="create" class="name" name="player[]" placeholder="Add new player" onkeyup="suggestions(this.value)">
  </div>
</div>
<div id="livesearch"></div>

<input class="mainBtn linkBtn" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Create Bracket" />
</div>
</form>
</div>
</div>
</article>

<script>
  var nameInput =
  '<div>' +
    '<input type="text" id="create" class="name" name="player[]" placeholder="Add new player" onkeyup="suggestions(this.value)">' +
  '</div>';

  $('.numNames').on('input', function(e) {
    var numPlayers = Number($(this).val());
    createInput(numPlayers);
  });

  function createInput(numPlayers) {
    $('#nameText').empty();
    for (var i=0; i<numPlayers; i++) {
      $('#nameText').append(nameInput);
    }
  }

  function suggestions(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
      }
    }
    xmlhttp.open("GET","livesearch.php?q="+str,true);
    xmlhttp.send();
  }

  $(document).ready(function(){
    $("#nameLink").click(function(){
      var value = $(this).html();
      var input = $('#create');
      input.val(value);
    });
  });

</script>

<?php
    require "includes/footer.php";
  }
  else {
    header('Location:login.php?page=1');
  }
?>
