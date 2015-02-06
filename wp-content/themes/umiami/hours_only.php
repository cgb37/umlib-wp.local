<?php
header('Access-Control-Allow-Origin: *');
define("UM_USERNAME", "webuser01");
define("UM_PASSWORD", "w3bpas2");
define("UM_HOSTNAME", "127.0.0.1");
define("UM_PORT", "3310");


function get_schedule($get_date, $weekday) {
	// connect
	$mysqli = mysqli_connect(UM_HOSTNAME,UM_USERNAME,UM_PASSWORD,'rlibcalendar',UM_PORT) or die("Error " . mysqli_error($link));

	// check for exceptions
	$exceptions = $mysqli->query("SELECT exception_name, exception_date, exception_schedule FROM schedule_exceptions WHERE exception_date = '" . $get_date . "' LIMIT 1");

	$row = $exceptions->fetch_array();

	// if exceptions, return that value
	if (!empty($row)) {
		$todays_hours = $row[0]->exception_schedule;
	} else {
		// no exceptions--return hours
		$q = "SELECT " . $weekday . " FROM schedules WHERE schedule_start <= '" . $get_date . "' && schedule_end >= '" . $get_date . "' LIMIT 1";
		$get_hours = $mysqli->query("$q");
		$row = $get_hours->fetch_array();

		$todays_hours = $row[$weekday];
	}

	return $todays_hours;
}

$get_date = date("Y-m-d");
$weekday = date("l");

$today = get_schedule($get_date, $weekday);
?>

<div class="icon"><img src="http://library.miami.edu/wp-content/themes/umiami/images/clock_green.png" alt="clock" /></div>
<div class="text hours tour_1" style="margin-right: 50px;"><a href="http://library.miami.edu/hours/" title="Click to see more hours">Richter hours:<br /><?php print $today; ?></a></div>