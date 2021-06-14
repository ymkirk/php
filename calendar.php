<?php
$pageTitle = "Calendar";

$pageContent = Null;
$dateContent = NULL;
$timeContent = Null;
$semesterContent = Null;
$holidayContent = Null;
$amChecked = $pmChecked = Null;
// Time zone
date_default_timezone_set('America/Chicago');

$ampm = date('A');
$seconds = date('s');
$minutes = date('i');
$hours = date('g');
$displayhours = $hours;
$month = date("m");
$day = date('j');
$year = date("Y");

//form process
//data from form
if (filter_has_var(INPUT_POST, 'submit'))	{
	$ampm = filter_input(INPUT_POST, 'ampm');
	$seconds = filter_input(INPUT_POST, 'seconds');
	$minutes = filter_input(INPUT_POST, 'minutes');
	$displayhours = filter_input(INPUT_POST, 'hours');
	$month = filter_input(INPUT_POST, 'month');
	$day = filter_input(INPUT_POST, 'day');
	$year = filter_input(INPUT_POST, 'year');
	$hours - $displayhours;
}
if ($ampm == 'PM')	{
	if ($hours < 12)	{
		$hours += 12;
	}//end of if
	$pmChecked = "checked";
}else{
	if ($hours == 12)	{
		$hours = 0;
}//end of else
$amChecked = "checked";
}//end of ampm if

$today = mktime($hours, $minutes, $seconds, $month, $day, $year);
$timeForm =<<<HERE
<p>Lets try a different date</p>
<form method = "post">
<input type="number" name="hours" value="$displayhours" placeholder="HH" size="3" min="1" max="12">
<input type="number" name="minutes" value="$minutes" placeholder="MM" size="3" min="1" max="59">
<input type="number" name="seconds" value="$seconds" placeholder="SS" size="3" min="1" max="59">
<label><input type="radio" name="ampm" value="AM" $amChecked>&nbsp;AM</label>
<label><input type="radio" name="ampm" value="PM" $pmChecked>&nbsp;PM</label>
<input type="submit" name="submit" value="Show Selected">
<input type="submit" name="reset" value="Show Now">
HERE;

$month_select = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$monthList = Null;
foreach ($month_select as $key => $value)	{
	if	($key == $month)	{
		$monthList .= <<<HERE
		<option value="$key" selected>$value</option\n
HERE;
	}else {
		$monthList .= <<<HERE
		<option value="$key">$value</option>\n
HERE;
	}//end of else
}//EO foreach

$dayList = Null;
for ($i=1; $i<=31; $i++)	{
	if($i == $day)	{
		$dayList .= <<<HERE
		<option value="$i" selected>$i</option>\n
HERE;
	}else {
		$dayList .= <<<HERE
		<option value="$i">$i</option>\n
HERE;
	}//EO else
}//EO for

$yearList = Null;
for ($j = date('Y'); $j >= 2000; $j--)	{
	if($j == $year)	{
	$yearList .= <<<HERE
	<option value="$j" selected>$j</option>\n
HERE;
}else {
	$yearList .= <<<HERE
	<option value="$j">$j</option>\n
HERE;
}//EO else
}//EO for
//date form
$dateForm = <<<HERE
<p>Lets try a different day from the One below</p>
<select name="month">
	$monthList
</select>
<select name="day">
	$dayList
</select>
<select name="year">
	$yearList
</select>
<input type="submit" name="submit" value="Show Selected">
<input type="submit" name="reset" value="Show Today">
HERE;

$currentDate = date("l, F j, Y", $today);
$currentTime = date("g:i A", $today);
$dateContent = <<<HERE
<h2> Greetings! Today is $currentDate. The current time is $currentTime.<h2>
HERE;

//TOD
$morning=6;
$daytime=12;
$evening=18;
$night= 20;
//added night for fun
if	($hours >= $night)	{
	$timeContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/night.jpg' alt="night image">
		<figcaption>It's night time...</figcaption>
	</figure>
HERE;
} elseif	($hours >= $evening)	{
	$timeContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/evening.jpg' alt="Evening image">
		<figcaption>It's evening...</figcaption>
	</figure>
HERE;
} elseif ($hours >= $daytime) {
	$timeContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/afternoon.jpg' alt="afternoon image">
		<figcaption>It's afternoon...</figcaption>
	</figure>
HERE;
} elseif ($hours >= $morning) {
	$timeContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/morning.jpg' alt="morning image">
		<figcaption>It's morning...</figcaption>
	</figure>
HERE;
}

// semester
$spring = 1;
$summer = 6;
$fall = 9;

if	($month >= $fall)	{
	$semesterContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/fall.jpg' alt="fall image">
		<figcaption>It's Fall...</figcaption>
	</figure>
HERE;
} else if	($month >= $summer)	{
	$semesterContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/summer.jpg' alt="Summer image">
		<figcaption>It's Summer...</figcaption>
	</figure>
HERE;
} else {
	$semesterContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/spring.jpg' alt="spring image">
		<figcaption>It's Spring...</figcaption>
	</figure>
HERE;
}

// days til
$holiday = date('z', strtotime("October 31"));
$day2 = date('z');
if ( $holiday == $day2 ) { // holiday is today
	$holidayContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/halloween.jpg' alt="halloween image">
		<figcaption>Happy Halloween!!</figcaption>
	</figure>
HERE;
} elseif( $holiday > $day2 ) { // holiday is after today
	$diff = $holiday - $day2;
	$holidayContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/not.jpg' alt="waitng for halloween image">
		<figcaption>There are $diff days until Halloween</figcaption>
	</figure>
HERE;
} else { // holiday is before today
	$endOfYear = date('z', strtotime("December 31"));
	$nextYear = date('z', strtotime("October 31 +1 year"));
	$diff = ($endOfYear - $day2) + $nextYear;
	$holidayContent .= <<<HERE
	<figure>
		<img class="img-fluid" src='timeImg/not.jpg' alt="waitng for halloween image">
		<figcaption>There are " . $diff . " days until next year's holiday.</figcaption>
	</figure>
HERE;
}
// form field
$pageContent .=<<<HERE
$dateContent
<div class="container p-3 my-3 bg-dark text-white">
	<div class="row">
		<div class="col-md">
			$timeContent
		</div>
		<div class="col-md">
			$semesterContent
		</div>
		<div class="col-md">
			$holidayContent
		</div>
	</div>
	$timeForm
	$dateForm
</div>
HERE;

$postArray = "<pre>";
$postArray .= print_r($_POST, true);
$postArray .="</pre>";
$pageContent .=$postArray;
//$pageContent .= $hours;
include "template.php";
?>