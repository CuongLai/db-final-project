<?php
require "includes/top.php";
if (isset($_SESSION['user'])) {
?>
<div class="welcomeContainer">
  <h1 class="centerText customH1">Please create your bracket</h1>
</div>
<article>
<form action="#" method="post">

<div class="formGroup centerText">
  <h2 class="customH2">Enter your bracket name:</h2>
  <input type="text" name="bracketName" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="customH2">Type of tournament bracket:</h2>
  <input class="" type="radio" name="elimination" value="0"> Single
  <input class="" type="radio" name="elimination" value="1"> Double
</div>

<div class="formGroup centerText">
  <h2 class="customH2">Enter number of entrants:</h2>
  <input type="number" name="bracketSize" value="bracketSize" />
</div>

<input class="mainBtn formGroup centerText" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Create Bracket" >
</form>

</article>

<?php
    require "includes/footer.php";
  }
  else {
    header('Location:login.php');
  }
?>
