<?php
include 'config.php';
$msg = NULL;
	if (isset($_REQUEST['logout'])) {
		$msg = 'You are Logged out.';
		foreach ($_SESSION as $field => $value){
			unset($_SESSION[$field]);
		}
		session_destroy();
		header("Location: index.php?msg=$msg");
		exit;
	}
	if(isset($_GET['msg']))	{
		$msg = $_GET['msg'];
	}
	// value assigned to favorite quote
	$quote = "Keep Moving Forward -Walt Disney";
	// address variables
	$schoolName = "Brookhaven College";
	$street = " 3939 Valley View Lane";
	$cityStateZip = " Farmers Branch, TX 75244";
	// x , y variables
	$x= 4;
	$y= 9;
	//Name
	define("NAME", " Yordin Kirk");
	// arithmatic
	$sum = $x + $y;
	$difference = $x - $y;
	$product = $x * $y;
	$quotient = $x / $y;
	$module = $x % $y;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
     
		<title>Intro to PHP</title>
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
					 <li class="nav-item active">
                  <a class="nav-link" href="profile.php">Profile</a>
               </li>
					<li class="nav-item active">
						<a class="nav-link" href="blog.php">Blog</a>
					</li>
				</ul>
					 <?php 
					 if(isset ($_SESSION['memberID']))  {
						$loginButton = <<<HERE
						<form class="form-inline" action="index.php" method="post">
						<button class="btn btn-light" name="logout" type="submit">Log Out</button>
						</form>
HERE;
						} else  {
						  $loginButton = <<<HERE
						<form class="form-inline" action="login.php" method="post">
						<button class="btn btn-light" type="submit">Login</button>
						</form>
HERE;
						}
					 print $loginButton;?>
        </nav>
			<section>
				<h1>Welcome to my First PHP Page!</h1>
					<p class="pCenter"> This page was made for ITSE 1406 PHP Programming</p>
					<p class="pCenter">
					<!-- name -->
						<?php echo 'Designed by ' . NAME;?>
					</p>
			</section>
			<article>
				<h2>Quote</h2>
					<!-- quote -->
					<?php echo "<p> $quote </p> \n"; ?>
			</article>
			<section>
				<h2>About Me</h2>
					<p>
						I am a student at Dallas College, Brookhaven Campus, in hopes of getting my Associates in Science in the study of Web design
						and programming. I am taking this class to learn PHP, I have never worked with it before, but am excited to learn. 
					</p>
			</section>
			<div>
			<!-- arithmatic php -->
				<h3>Working with Numbers</h3>
				<p>
				<?php 
						print "<p>$x  +  $y  = $sum</p> \n";
						print "<p>$x  -  $y  = $difference</p> \n";
						print "<p>$x  *  $y  = $product</p> \n";
						print "<p>$x  /  $y  = $quotient</p> \n";
						print "<p>$x  %  $y  = $module</p> \n";
				?>
				</p>
			</div>
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