<?php
// address variables
$schoolName = "Brookhaven College";
$street = " 3939 Valley View Lane";
$cityStateZip = " Farmers Branch, TX 75244";

// Set up
$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$heading = "Cost by Quantity";
$orderList = NULL;

if(empty($_POST['name']))	{
	$name = "Guest";
	$nameError = "<p class='error'> Name was missing from the form submission and is required to process your order. Please <a href='form.php'>go back to the order form </a> and complete the form.</p>";
} else	{
	$name = $_POST ['name'];
	$nameError = NULL;
}

if(empty($_POST['quantity']))	{
	$quantity = NULL;
	$userQuantityError = "<p class='error'> Quantity was missing from the form submission and is required to process your order. Please <a href='form.php'>go back to the order form </a> and complete the form.</p>";
} else	{
	$quantity = $_POST ['quantity'];
	$userQuantityError = NULL;
}

if(!isset($_POST['media']))	{
	$media = NULL;
	$userMediaError = "<p class='error'> Media was missing from the form submission and is required to process your order. Please <a href='form.php'>go back to the order form </a> and complete the form.</p>";
} else	{
	$media = $_POST ['media'];
	$userMediaError = NULL;
}

if($media == 'cd')	{
	$heading .= " - CDs";
	for($i = 1; $i<= $quantity; $i++)	{
		$cost = 0;
		$cost += $i * $cdPrice + $shipping;
		$orderList .= "<p>The price for $i CDs is $cost.</p>";
	}
}

if($media == 'download')	{
	$heading .= " - Downloads";
	$i = 1; 
	while($i<= $quantity)	{
		$cost = 0;
		$cost += $i * $downloadPrice;
		$orderList .= "<p>The price for $i Downloads is $cost.</p>";
		$i++;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css"> 
		<title>Form Processing</title>
	</head> 
	<body>
		<div class= "container-fluid">
			<h1>PHP programming</h1>
			<nav>
				<a href="index.php">Home</a> |
				<a href="form.php">Order Form</a> |
				<a href="invoice.php">Invoice</a> |
			</nav>
			<section>
				<h2><?php echo $heading; ?></h2>
				<div>
					<?php
						echo "<h3> Order for $name</h3>";
						echo $orderList;
						echo $nameError;
						echo $userQuantityError;
						echo $userMediaError;
						// echo "<pre>POST ";
						// print_r($_POST);
						// echo "<pre>";
					?>
				</div>
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