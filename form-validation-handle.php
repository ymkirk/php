<?php
// Sticky
$heading = "Form Validation";
$name = NULL;
$favColor = NULL;
$instrument = NULL;
$animal = NULL;
$urban = NULL;
$dogChecked = NULL;
$cat = NULL;
$birdChecked = NULL;
$snakeChecked = NULL;
$parkChecked =  NULL;
$bridgeChecked =  NULL;
$towerChecked =  NULL;
$highwayChecked =  NULL;
// error
$nameError = NULL;
$userColorError = NULL;
$userInstrumentError = NULL;
$animalError = NULL;
$urbanError = NULL;
// validation flag
$valid = false;


if (isset($_POST['submit'])) {
	// change the validation flag to assume data integrity
	$valid = true;

    $name = htmlspecialchars($_POST['name']);
        if(empty($_POST['name']))	{
            $name = "Guest";
            $nameError = "<p class='error'> Name was missing from the form submission and is required. Please <a href='form-validation.php'>go back to the order form </a> and complete the form.</p>";
        } else	{
            $name = $_POST ['name'];
            $nameError = NULL;
        }
    $favColor =  htmlspecialchars($_POST['color']);
        if(empty($_POST['color']))	{
            $favColor = NULL;
            $userColorError = "<p class='error'> Favorite color was missing from the form submission and is required. Please <a href='form-validation.php'>go back to the order form </a> and complete the form.</p>";
        } else	{
            $favColor = $_POST ['color'];
            $userColorError = NULL;
        }
    if(!isset($_POST['instrument']))	{
        $instrument = NULL;
        $userInstrumentError = "<p class='error'> Instrument choice was missing from the form submission and is required. Please <a href='form-validation.php'>go back to the order form </a> and complete the form.</p>";
    } else	{
        $instrument = $_POST ['instrument'];
        $userInstrumentError = NULL;
    }

    if (isset($_POST['animals'])) {
        $countAnimal = COUNT$(_POST['animals']);
        foreach ($_POST['animals'] as $index => $animal)    {
            $animalSelected[] = $animal;
            if(in_array($animal, $animalArray ))    {
                $animalChecked[$index] = "checked";
            }
        }
        if ($countAnimal == 2){ 
            $animal1 = $animalSelected[0];
            $animal2 = $animalSelected[1];
            $animal3 = $animalSelected[2];
            $animal4 = $animalSelected[3];
    } else {
        $animalError = "<span class='error'>Please select 2</span>";
        $valid = false;
    }
    if (isset($_POST['urban'])) {
        // if set, get the type. No need for htmlspecialchars here, since the user can only select a value we provided.
        $type = $_POST['urban'];
        if ($urban == "park") {$parkChecked = "checked";}
        if ($urban == "bridge") {$bridgeChecked = "checked";}
        if ($urban == "tower") {$towerChecked = "checked";}
        if ($urban == "highway") {$highwayChecked = "checked";}
    } else {
        $urbanError = "<span class='error'>Please select 3</span>";
        $valid = false;
    }
}
// if the data is valid, display the values on the page
if ($valid) {
	echo "<h2>Welcome $name";
	echo "<br>Your favorite color is $favColor";
	echo "<br>Your favorite musical instrument is $instrument";
	echo "<br>Your favorite animals are $animal1 and $animal2";
	echo "<br>Your favoirte places are the $urban1, the $urban2, and $urban3";
    echo "<br>Your favoirte activity is $activity";
} else {
echo <<<EOD
<fieldset>
  <legend> Example Form </legend>
  <form method="post" action="form-validation.php">
    <p>
      <label for="artist">Artist</label>$artistError
      <input type="text" name="artist" id="artist" value="$artist">
    </p>
    <p>
      <label for="album">Album</label>$albumError
      <input type="text" name="album" id="album" value="$album">
    </p>
    <p>
      <label for="rdate">Release date</label>$rdateError
      <input type="text" name="rdate" id="rdate" value="$rdate">
    </p>
    <p>
      <input type="radio" name="type" id="typecd" value="cd" $cdChecked>
      <label for="typecd">CD</label>
      <input type="radio" name="type" id="typedl" value="download" $downloadChecked>
      <label for="typedl">Download</label>$typeError
    </p><br />
    <p>
      <input type="submit" name="submit" value="Add Album">
    </p>
  </form>
</fieldset>
EOD;
}
?>