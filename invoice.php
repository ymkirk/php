<?php
include 'functions.php';

$pageTitle = "Invoice";
$shipping = 2.99;
$downloadPrice = 9.99;
$cdPrice = 12.99;
$heading = "Cost by Quantity";
$albumsList = NULL;
$media = NULL;
$orderListCD = $orderListDL = NULL;
$quantity = 5;
$albumHeading = "<h2>Artists and Albums</h2>";

$albums = array("In Your Honor" => "Foo Fighters", "Beautiful People Will Ruin Your Life" => "The Wombats", "Surfin Bird" => "The Trashmen", "Parasite Eve" => "Bring Me The Horizon", "Take You Dancing" => "Jason Darulo");
$albums ["Abbey Road"] = "The Beatles";

foreach ($albums as $album => $artist) {
    $albumsList .= "<p>$album was created by $artist </p>\n";
}
$media = 'cd';
if($media == 'cd')	{
	$headingCD = "<h2>$heading - CDs</h2>";
	for($i = 1; $i<= $quantity; $i++)	{
		$subtotal = priceCalc($cdPrice, $i);
		$total = number_format ($subtotal, 2) + $shipping;
		$orderListCD .= "<p>The price for $i CDs is $total.</p>";
	}
}
$media = 'download';
if($media == 'download')	{
	$headingDL = "<h2>$heading - Downloads</h2>";
	$i = 1; 
	while($i<= $quantity)	{
		$total = number_format (priceCalc($downloadPrice, $i), 2);
		$orderListDL .= "<p>The price for $i Downloads is \$  $total.</p>";
		$i++;
	}
}


include 'header.php';


echo <<<EOD

$headingCD
$orderListCD

$headingDL
$orderListDL
<div class="card">
$albumHeading
$albumsList
</div>
EOD;

include 'footer.php'; 
?>