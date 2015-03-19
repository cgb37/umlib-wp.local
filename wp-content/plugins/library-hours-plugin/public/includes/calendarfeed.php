<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 3/11/15
 * Time: 11:31 AM
 */
header('Content-Type:application/json');

// - grab wp load, wherever it's hiding -
if(file_exists('../../../../../wp-load.php')) :
    include '../../../../../wp-load.php';
else:
    include '../../../../../wp-load.php';
endif;

$openHours = new Open_Hours();
$period = $openHours->get_calendar_period();



if(is_object($openHours)) {

    $period = $openHours->get_calendar_period();

    $startdate = date("Y-m-d", strtotime($period['start']));
    //$enddate   =  date("Y-m-d", strtotime($period['end']));
    $enddate = "2015-04-24";


    $start        = new DateTime($startdate);
    $end_period   = new DateTime($enddate);
    $end_period   = $end_period->modify('+1 day');

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($start, $interval, $end_period);


    $current_day_str = date("Y-m-d", current_time('timestamp'));
    $holidays = $openHours->get_holidays();
    //var_dump($holidays);

    $days = array();
    foreach($holidays as $day) {
        $days[] = date("Y-m-d", $day->fields['start-date']);
    }
    //var_dump($days);

    $events = array();
    foreach ($daterange as $ev) {
        //var_dump($ev);

        $ev_vars = get_object_vars($ev);
        //var_dump($ev_vars);

        $origin_dtz = new DateTimeZone("America/New_York");
        //var_dump($origin_dtz);

        $offset = $origin_dtz->getOffset(new DateTime('now'));
        //var_dump($offset);

        //$event_time = new DateTime("H:i:s", $ev_vars['date'], $origin_dtz);
        //var_dump($event_time);


        $ts = strtotime($ev_vars['date']);

        $weekday = strtolower(date("l", $ts));
        //var_dump($weekday);

        $ev_formatted_array = array(date("Y-m-d", $ts));
        //var_dump($ev_formatted_array);

        $ev_weekday = strtolower(date("l", strtotime($ev_formatted_array[0])));
        //var_dump($ev_weekday);

        $open_ts = get_post_meta($openHours->getPostId(), $ev_weekday.'_open');
        //var_dump($open_ts);

        $open = date("H:i:s", $open_ts[0] - $offset);
        //var_dump($open);

        $event_title = "Just another day";
        //$event_start = date("Y-m-d H:i:s", $open);
        //var_dump($event_start);



        foreach($days as $day) {
            if(in_array($day, $ev_formatted_array)) {
                $event_title = "Holiday";
                $event_start = $ev_formatted_array;
                $ev->timezone = "America/New_York";
            }
        }


        $events[] = array(
            'title' => $event_title,
            'start' => $ev_formatted_array[0]." ".$open,
            'end' => $ev->format("Y-m-d 02:30:00+05:00"),
            'allDay' => true
        );



    }


    echo json_encode($events);

}
