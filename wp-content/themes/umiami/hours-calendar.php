<?php
include 'inc/class.sscalendar.php';

if( strlen($_GET['q'] > 0 )){
	
	$q_temp = explode( '-',$_GET['q'] );
	
	$DateTemp = strtotime( $_GET['q'].'-' . 1 );

  $Month = date( 'm', $DateTemp );
  $Day = date( 'd', $DateTemp ); # the first day of the next/previous month
  $Year = date( 'Y', $DateTemp ); 



$ssCal = new ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 1, $DayLinks = 1 );
$content_two = $ssCal->printCalendar();
echo $content_two;
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