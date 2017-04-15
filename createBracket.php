<?php
require "includes/top.php";
if (isset($_SESSION['user'])) {
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
  }
?>
