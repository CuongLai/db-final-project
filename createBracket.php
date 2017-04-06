<?php require "includes/top.php"; ?>
<div class="welcomeContainer">
  <h1 class="centerText customH1"> Please create your bracket</h1>
</div>
<article>
<form action="#" method="post">
<h2>Enter your bracket name:</h2>
<input type="text" name="bracketName" value="" />
<h2>Type of tournament bracket:</h2>
<input type="radio" name="elimination" value="0"> Single
<input type="radio" name="elimination" value="1"> Double
<h2>Enter number of entrants:</h2>
<input type="number" name="bracketSize" value="bracketSize" />

<input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Create Bracket" >
</form>

</article>

<?php require "includes/footer.php"; ?>
