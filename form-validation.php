<?php
$animal1 = $animal2 = $animal3 = $animal4 = NULL;
$animalList = NULL;
$activityList = NULL;
$valid = false;
// check box animals
$animalArray = array("dog", "cat", "bird", "snake");
foreach ($animalArray as $animalIndex => $animalName) {
    $animalChecked[$animalIndex] = NULL;
}
foreach ($animalArray as $animalIndex => $animalName) {
    $animalList = <<<here
    <input type="checkbox" name="animals[$animalIndex] id="$animalIndex" value="$animalName" $animalChecked[$animalIndex]>
    <label for="$animalIndex">$animalName</label>\n
here;
};
// check box urban

//  drop down array Array
$activity = array("Gaming", "Baseball", "Hockey", "Gymnastics", "Texas Hold'em");
$activityList = '<label for = "favActivity"> Choose your favorite Activity </label><br>' . "\n";
$activityList .= '<select name = "favActivity" id = "favActivity">' . "\n";
    foreach ($activity as $activityChoice) {
        $activityList .= '<option value = "' .  $activityChoice  . '">' . $activityChoice . '</option>' . "\n";
    }
$activityList .= '</select>' . "\n";

?>
<!DOCTYPE html>
<html lang="en">
	<head>

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> 		
    <title>Form Validation</title>
	</head> 
	<body>
        <div class= "container-fluid">
            <h1>PHP programming</h1>
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li> 
                <li class="nav-item active">
                    <a class="nav-link" href="form.php">Order Form</a>
                </li> 
                <li class="nav-item active">
                    <a class="nav-link" href="invoice.php">Invoice</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="multi-array.php">Multi-Array</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="calendar.php">Calendar</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
					 <?php 
					 if(isset ($_SESSION['loggedin']))  {
						$loginButton = <<<HERE
						<form class="form-inline" action="index.php" >
						<button class="btn btn-light" type="submit">Log Out</button>
						</form>
HERE;
						} else  {
						  $loginButton = <<<HERE
						<form class="form-inline" action="login.php" >
						<button class="btn btn-light" type="submit">Login</button>
						</form>
HERE;
						}
					 print $loginButton;?>
            </ul>
        </nav>
        <main>
            <fieldset>
            <legend>Form Validation</legend>
            <form method="post" action="form-validation-handle.php">
                <p>
                    <label for="name">Name</label>$nameError<br>
                    <input type="text" name="name" id="name" value="">
                </p>
                <p>
                    <label for="favColor">What's your Favorite Color?</label>
                    <input type="text" name="color" id="favColor" value="">
                </p>
                <p>
                    <?php echo $animalList;?>
                </p>
                <p>
                    <?php echo $activityList; ?>
                </p>               
                <p>
                    <label>Favorite Instrument</label><br>
                    <input type="radio" name="Instrument" id="drums" value="drums">
                    <label for="drums">Drums</label> &emsp;
                    <input type="radio" name="Instrument" id="guitar" value="guitar">
                    <label for="guitar">Guitar</label> &emsp;
                    <input type="radio" name="Instrument" id="cello" value="cello">
                    <label for="cello">Cello</label> &emsp;
                    <input type="radio" name="Instrument" id="piano" value="piano">
                    <label for="piano">Piano</label>
                </p>
                <p>
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
            </fieldset>
        </main>
    </div>
	</body>
</html>