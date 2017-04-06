<?php
require "includes/top.php";
?>
<div class="welcomeContainer">
  <h1 class="centerText customH1">Sign up for Brakets!</h1>
</div>
<article>
<form action="#" method="post">

<div class="formGroup centerText">
  <h2 class="customH2">Create your username:</h2>
  <input type="text" name="bracketName" value="" />
</div>

<div class="formGroup centerText">
  <h2 class="customH2">Create your password:</h2>
  <input class="" type="radio" name="elimination" value="0"> Single
  <input class="" type="radio" name="elimination" value="1"> Double
</div>

<input class="mainBtn formGroup centerText" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Sign Up" >
</form>

</article>

<?php
  require "includes/footer.php";
?>
