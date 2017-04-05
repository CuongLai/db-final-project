<?php
include "top.php";

if ($isAdmin === true) {
$id = $_GET['trailId'];
print "<article>";

?>

<!-- Form for tblTrails -->

<form action="#" method="post">
  <?php
    if ($id == 0) {
      print '<h1>Create a trail</h1>';
    }
    else {
      print '<h1>Update a trail</h1>';
    }
  ?>
  <label>Enter the trail name:</label>
  <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''?>"/>

  <br><label>Enter the trail's total distance (in miles):</label>
  <input type="text" name="distance" value="<?php echo isset($_POST['distance']) ? $_POST['distance'] : '' ?>"/>

  <br><label>Enter the trail's hiking time (hh:mm:ss):</label>
  <input type="text" name="time" value="<?php echo isset($_POST['time']) ? $_POST['time'] : '' ?>"/>

  <br><label>Enter the mountain's vertical rise (in feet):</label>
  <input type="text" name="rise" value="<?php echo isset($_POST['rise']) ? $_POST['rise'] : '' ?>"/>

  <br><label>Enter the trail's rating:</label>
  <select id="rating" name="rating">
  <option selected='selected' value='Easy'>Easy</option>
  <option value='Moderate'>Moderate</option>
  <option value='Moderately Strenous'>Moderately Strenous</option>
  <option value='Strenuous'>Strenous</option>
  </select>

  <?php
    if ($id != 0) {
      print '<br><label>Choose tags for the trail:</label>';
      $query = "SELECT pmkTag FROM tblTags";
      $tags = '';
      $tags = $thisDatabaseReader->select($query, '');

      foreach ($tags as $tag) {
        print '<input type="checkbox" name="tag[]" value="' . $tag['pmkTag'] . '">' . $tag['pmkTag'];
      }
    }

    print '<br><input type="submit" class="submit" name="submit" value="';
    if ($id == 0) {
      print 'Submit Trail Data">';
    }
    else {
      print 'Update trail">';
    }
  ?>
</form>

<!-- Submission of form -->

<?php
function isInputValid($name, $distance, $time, $rise) {
  $errors = array();
  if (empty($name)) {
    $errors[] = 1;
  }
  if (is_numeric($distance) === false) {
    $errors[] = 2;
  }
  if (is_numeric($rise) === false) {
    $error[] = 4;
  }
  if ($d = DateTime::createFromFormat('H:i:s', $time)) {
    if ($d->format('H:i:s') !== $time) {
      $errors[] = 3;
    }
  }
  else {
    $errors[] = 5;
  }
  return $errors;
}

function errorMessages($errors) {
  foreach ($errors as $error) {
    if ($error === 1) {
      echo "<br>".'You must enter the name of the trail!';
    }
    if ($error === 2) {
      echo "<br>".'The distance must be a number in miles!';
    }
    if ($error === 3) {
      echo "<br>"."The time is invalid!";
    }
    if ($error === 4) {
      echo "<br>"."The vertical rise must be a number in feet!";
    }
    if ($error === 5) {
      echo "<br>"."The time is in an incorrect format!";
    }
  }
}

if (isset($_POST["submit"])) {
  $name = htmlentities($_POST["name"], ENT_QUOTES, "UTF-8");
  $distance = htmlentities($_POST["distance"], ENT_QUOTES, "UTF-8");
  $time = htmlentities($_POST["time"], ENT_QUOTES, "UTF-8");
  $rise = htmlentities($_POST["rise"], ENT_QUOTES, "UTF-8");
  $rating = htmlentities($_POST["rating"], ENT_QUOTES, "UTF-8");

  $data[] = $name;
  $data[] = $distance;
  $data[] = $time;
  $data[] = $rise;
  $data[] = $rating;

  $errors = isInputValid($name, $distance, $time, $rise);
  if (!empty($errors)) {
    errorMessages($errors);
  }
  else {
    if ($id == 0) {
      $query = 'INSERT INTO tblTrails SET fldTrailName=?, fldTotalDistance=?, fldHikingTime=?, fldVerticalRise=?, fldRating=?';
      $results = $thisDatabaseWriter->insert($query, $data);
      print "<h1>Trail data saved!</h1>";
    }
    else {
      $data[] = $id;
      $query = 'UPDATE tblTrails SET fldTrailName=?, fldTotalDistance=?, fldHikingTime=?, fldVerticalRise=?, fldRating=? WHERE pmkTrailsId=?';
      $results = $thisDatabaseWriter->update($query, $data);

      $tags = $_POST['tag'];
      $query = 'SELECT pmkTag FROM tblTags';
      $results = $thisDatabaseReader->select($query, '');
      $trailDelete = array();
      foreach ($results as $result) {
        $trailDelete[] = $result['pmkTag'];
      }
      if (!empty($tags)) {
        $trailDelete = array_diff($trailDelete, $tags);
      }

      foreach ($tags as $tag) {
        $trailData = array();
        $trailData[] = $id;
        $trailData[] = $tag;
        $query = 'INSERT INTO tblTrailTags SET pfkTrailsId=?, pfkTag=?';
        $results = $thisDatabaseWriter->insert($query, $trailData);
      }
      foreach ($trailDelete as $delete) {
        $trailData = array();
        $trailData[] = $id;
        $trailData[] = $delete;
        $query = 'DELETE FROM tblTrailTags WHERE pfkTrailsId=? AND pfkTag=?';
        $results = $thisDatabaseWriter->delete($query, $trailData);
      }
      print "<h1>Trail data updated and tags added to/deleted from tblTrailTags!</h1>";
    }
  }
}
print "</article>";
}
else {
  echo 'YOU ARE NOT AN ADMIN! ACCESS DENIED.';
}
include "footer.php";
?>
