<?php
if( strlen($_GET['q'] > 0 )){
	# vars
	$get_date = $_GET['q'];
	
	$ClickedDateDisplay = date( 'l, F j, Y', strtotime( $get_date ) );
	$Weekday = date( 'l', strtotime( $get_date ) );	
	
	echo '<div id="schedule_box">';
	echo '<p class="display_date">'. $ClickedDateDisplay . '</p>';
	
	# get the schedule for the clicked date.
	$schedule = get_schedule( $get_date, $Weekday );
	echo '<p class="display_schedule">'.$schedule.'</p>';
	echo '</div>';

}else{
	echo $no_schedule_err;
}

function get_schedule( $get_date, $Weekday ){
	
	include 'inc/class.connector.php';
	
	$conn = new connector();
	$no_schedule_err = '<p>A schedule has not been set for this date.</p>';
	$schedule = '';
	
	# first check for exception
	$results_exceptions = $conn->query( "SELECT * FROM schedule_exceptions WHERE exception_date = '".$get_date."' LIMIT 1" );
	$results_exceptions_count = $conn->numRows( $results_exceptions );
	
	# if there is an exception, use it
	if( $results_exceptions_count > 0 ){
		$row_exceptions = $conn->getRows( $results_exceptions );
		$schedule = $row_exceptions['exception_schedule'];
	
	# else use the actual schedule
	}else{	
		$results = $conn->query( "SELECT ".$Weekday." FROM schedules WHERE schedule_start <= '".$get_date."' && schedule_end >= '".$get_date."' LIMIT 1" );
		$result_count = $conn->numRows( $results );
		if( $result_count > 0 ){
			$row = $conn->getRows( $results );
			$schedule = $row[$Weekday];
		}else{
			$schedule = $no_schedule_err;
		}
	}
	
	return $schedule;
}
?>