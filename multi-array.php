<?php
$pageTitle = "Multidimensional Array";
$pageContent = Null;

// artist, album, release date arrays
$artists = array (
    "The Beatles" => array("A hard Days Night" => "1964", "Help!" => "1965", "Rubber Soul" => "1965", "Abbey Road" => "1969"),
    "LedZepplin" => array("Led Zepplin IV" => "1971"),
    "Rolling Stones" => array ("Let It Bleed" => "1969", "Sticky Fingers" => "1971"),
    "The Who" => array("Tommy" => "1969", "Quadropheni" => "1973", "The Who by Numbers" => "1975")
);//end of multi array

$singleArtist = $artists ["The Who"] ["Tommy"];
$pageContent .= "<h2>Release date for the album Tommy by The Who is $singleArtist."; 

$pageContent .= "<h2>Artists, Albums, Release Date<h2>";
/* Nested foreach loops */
foreach ($artists as $subArray => $artist) { // steps through $artists and selects $artist as sub-array value
    $pageContent .= "<p>Albums by " . $subArray . " are<br>";
    foreach ($artist as $album => $year) { // uses the value of the sub-arrays above as the array name for the nested loop
        $pageContent .= "$album released in $year<br>";
    }
	$pageContent .="</p>\n";
}
$pageContent .= "Artists";
foreach ($artists as $subArray => $artist) {
	if ($subArray == "The Who") { // condition to limit output to the who only
		$pageContent .= "<p>Albums by " . $subArray . " are<br>\n";
		foreach ($artist as $album => $year) {
			$pageContent .= "$album released $year<br>\n";
		}
		$pageContent .= "</p>\n";
	}
}
$pageContent .= "<h2>Released after 1970</h2>";
foreach ($artists as $subArray => $artist) {
	if ($subArray > "1970") { // condition to limit output to the who only
		$pageContent .= "<p>Albums released after 1970 " . $subArray . " are<br>\n";
		foreach ($artist as $album => $year) {
			$pageContent .= "$album released $year<br>\n";
		}
		$pageContent .= "</p>\n";
	}
}

include 'template.php';
?>