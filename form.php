<?php
	// address variables
	$schoolName = "Brookhaven College";
	$street = " 3939 Valley View Lane";
	$cityStateZip = " Farmers Branch, TX 75244";

	// Album Array
	$albums = array("In Your Honor" => 9, "Beautiful People Will Ruin Your Life" => 7, "Surfin Bird" => 4, "Holy" => 2, "Take You Dancing" => 3);
	$albums ["Abbey Road"] = 10;
	$albumsList = '<label for = "album"> Choose a Album </label><br>' . "\n";
	$albumsList .= '<select name = "album" id = "album">' . "\n";

	foreach ($albums as $album => $rating) {
		$albumsList .= '<option value = "' .  $album  . '">' . $album . '</option>' . "\n";
	}

	$albumsList .= '</select>' . "\n";
?>
<!DOCTYPE html>
<html lang="en">
	<head>

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> 		
    <title>Form</title>
	</head> 
	<body>
        <div class= "container-fluid">
            <h1>PHP programming</h1>
			<nav class="navbar navbar-expand-sm bg-dark justify-content-center">
                <?php
                    if (isset($_SESSION['firstname'])) {
                        print "<span style='color:lightblue;'>Hello " . $_SESSION['firstname'] ."</span>";
                    } else {
                        print "<span style='color:lightblue;'>Hello Guest</span>";
                    }
                ?>
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
            <section class="container-fluid">
                <legend> Form Processing</legend>
                    <fieldset>
                        <form method="post" action="handle_form.php">
                            <div class="form-group">
                                <label for="name">Name</label><br>
                                <input type="text" name="name" id="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label><br>
                                <input type="text" name="quantity" id="quantity" value="">
                            </div>
                            <div class="form-group">
                                <?php echo $albumsList; ?>
                            </div>               
                            <div class="form-group">
                                <label>Media</label><br>
                                <input type="radio" name="media" id="cd" value="cd">
                                <label for="cd">CD</label> &emsp;
                                <input type="radio" name="media" id="dl" value="download">
                                <label for="dl">Download</label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit">
                            </div>
                        </form>
                    </fieldset>
            </section>
            <br>
            <br>
            <footer>
                <?php 
                    print "<p>$schoolName</p>\n";
                    print "<p> $street</p>\n";
                    print "<p>$cityStateZip</p>";
                ?> 
            </footer>
    </div>
	</body>
</html>