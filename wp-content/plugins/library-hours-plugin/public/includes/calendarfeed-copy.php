<?php

function create_js_fullcalendar() {

    $openHours = new Open_Hours();
    $period = $openHours->get_calendar_period();

    $startdate = date("Y-m-d", strtotime($period['start']));
    //var_dump($startdate);
    $enddate   =  date("Y-m-d", strtotime($period['end']));
    //var_dump($enddate);


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


        $origin_dtz = new DateTimeZone("America/New_York");
        //var_dump($origin_dtz);

        $offset = $origin_dtz->getOffset(new DateTime('now'));
        //var_dump($day);
        //$days[] = date("Y-m-d", $day->fields['start-date']);
        if($day->fields['holiday-closed'] == 2) {
            $holiday_title = "Closed";
            $holiday_allday = true;
        } else {
            $holiday_title = $day->post_title;
            $holiday_allday = false;
        }
        $days[] = array(
            'holiday_start' => date("Y-m-d", $day->fields['start-date']),
            'title'  => $holiday_title,
            'start'  => date("Y-m-d g:i a", $day->fields['start-date'] - $offset),
            'end'    =>date("Y-m-d g:i a", $day->fields['end-date'] - $offset),
            'allDay' => $holiday_allday
        );
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

        $open = date("g:i a", $open_ts[0] - $offset);
        //var_dump($open);

        $close_ts = get_post_meta($openHours->getPostId(), $ev_weekday.'_close');
        //var_dump($open_ts);

        $close = date("g:i a", $close_ts[0] - $offset);
        //var_dump($close);


        $event_title = " - ".$close;
        //var_dump($event_title);
        $event_start = $ev_formatted_array[0]." ".$open;
        $event_end   = $ev_formatted_array[0]." ".$close;
        //var_dump($event_start);



        foreach($days as $day) {
            if(in_array($day['holiday_start'], $ev_formatted_array)) {
                //var_dump($day);
                $event_title = $day['title'];
                $event_start = $day['start'];
                $event_end   = $day['end'];
                $allday = $day['allday'];
                //$ev->timezone = "America/New_York";
            }
        }



        $events[] = array(
            'title'  => $event_title,
            'start'  => $event_start,
            'end'    => $event_end,
            'allDay' => false
        );


    }

    $events = json_encode($events);
    //var_dump($events);
    return $events;


}
$events = create_js_fullcalendar();


header('Content-Type:application/json');


echo '[{"title":" - 9:00 pm","start":"2015-01-12 7:30 am","end":"2015-01-12 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-13 7:30 am","end":"2015-01-13 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-14 7:30 am","end":"2015-01-14 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-15 7:30 am","end":"2015-01-15 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-16 7:30 am","end":"2015-01-16 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-17 9:00 am","end":"2015-01-17 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-18 12:00 pm","end":"2015-01-18 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-19 7:30 am","end":"2015-01-19 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-20 7:30 am","end":"2015-01-20 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-21 7:30 am","end":"2015-01-21 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-22 7:30 am","end":"2015-01-22 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-23 7:30 am","end":"2015-01-23 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-24 9:00 am","end":"2015-01-24 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-25 12:00 pm","end":"2015-01-25 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-26 7:30 am","end":"2015-01-26 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-27 7:30 am","end":"2015-01-27 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-28 7:30 am","end":"2015-01-28 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-29 7:30 am","end":"2015-01-29 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-30 7:30 am","end":"2015-01-30 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-31 9:00 am","end":"2015-01-31 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-01 12:00 pm","end":"2015-02-01 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-02 7:30 am","end":"2015-02-02 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-03 7:30 am","end":"2015-02-03 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-04 7:30 am","end":"2015-02-04 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-05 7:30 am","end":"2015-02-05 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-06 7:30 am","end":"2015-02-06 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-07 9:00 am","end":"2015-02-07 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-08 12:00 pm","end":"2015-02-08 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-09 7:30 am","end":"2015-02-09 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-10 7:30 am","end":"2015-02-10 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-11 7:30 am","end":"2015-02-11 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-12 7:30 am","end":"2015-02-12 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-13 7:30 am","end":"2015-02-13 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-14 9:00 am","end":"2015-02-14 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-15 12:00 pm","end":"2015-02-15 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-16 7:30 am","end":"2015-02-16 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-17 7:30 am","end":"2015-02-17 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-18 7:30 am","end":"2015-02-18 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-19 7:30 am","end":"2015-02-19 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-20 7:30 am","end":"2015-02-20 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-21 9:00 am","end":"2015-02-21 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-22 12:00 pm","end":"2015-02-22 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-23 7:30 am","end":"2015-02-23 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-24 7:30 am","end":"2015-02-24 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-25 7:30 am","end":"2015-02-25 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-26 7:30 am","end":"2015-02-26 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-27 7:30 am","end":"2015-02-27 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-28 9:00 am","end":"2015-02-28 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-01 12:00 pm","end":"2015-03-01 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-02 7:30 am","end":"2015-03-02 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-03 7:30 am","end":"2015-03-03 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-04 7:30 am","end":"2015-03-04 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-03-05 7:30 am","end":"2015-03-05 2:00 am","allDay":false},{"title":"Closed","start":"2015-03-06 6:00 am","end":"2015-03-06 7:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-07 9:00 am","end":"2015-03-07 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-08 12:00 pm","end":"2015-03-08 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-09 7:30 am","end":"2015-03-09 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-10 7:30 am","end":"2015-03-10 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-11 7:30 am","end":"2015-03-11 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-03-12 7:30 am","end":"2015-03-12 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-03-13 7:30 am","end":"2015-03-13 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-14 9:00 am","end":"2015-03-14 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-15 12:00 pm","end":"2015-03-15 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-16 7:30 am","end":"2015-03-16 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-17 7:30 am","end":"2015-03-17 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-18 7:30 am","end":"2015-03-18 2:00 am","allDay":false},{"title":"Closed","start":"2015-03-19 7:00 am","end":"2015-03-19 11:59 pm","allDay":false},{"title":" - 10:00 pm","start":"2015-03-20 7:30 am","end":"2015-03-20 10:00 pm","allDay":false},{"title":"Closed","start":"2015-03-21 7:30 am","end":"2015-03-21 11:59 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-22 12:00 pm","end":"2015-03-22 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-23 7:30 am","end":"2015-03-23 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-24 7:30 am","end":"2015-03-24 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-25 7:30 am","end":"2015-03-25 2:00 am","allDay":false},{"title":"Closed","start":"2015-03-26 7:00 am","end":"2015-03-26 11:59 pm","allDay":false},{"title":" - 10:00 pm","start":"2015-03-27 7:30 am","end":"2015-03-27 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-28 9:00 am","end":"2015-03-28 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-29 12:00 pm","end":"2015-03-29 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-30 7:30 am","end":"2015-03-30 9:00 pm","allDay":false},{"title":"holiday 174","start":"2015-03-31 9:30 am","end":"2015-03-31 2:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-01 7:30 am","end":"2015-04-01 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-02 7:30 am","end":"2015-04-02 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-03 7:30 am","end":"2015-04-03 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-04 9:00 am","end":"2015-04-04 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-05 12:00 pm","end":"2015-04-05 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-06 7:30 am","end":"2015-04-06 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-07 7:30 am","end":"2015-04-07 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-08 7:30 am","end":"2015-04-08 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-09 7:30 am","end":"2015-04-09 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-10 7:30 am","end":"2015-04-10 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-11 9:00 am","end":"2015-04-11 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-12 12:00 pm","end":"2015-04-12 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-13 7:30 am","end":"2015-04-13 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-14 7:30 am","end":"2015-04-14 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-15 7:30 am","end":"2015-04-15 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-16 7:30 am","end":"2015-04-16 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-17 7:30 am","end":"2015-04-17 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-18 9:00 am","end":"2015-04-18 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-19 12:00 pm","end":"2015-04-19 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-20 7:30 am","end":"2015-04-20 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-21 7:30 am","end":"2015-04-21 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-22 7:30 am","end":"2015-04-22 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-23 7:30 am","end":"2015-04-23 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-24 7:30 am","end":"2015-04-24 10:00 pm","allDay":false}]';
//echo $events;
