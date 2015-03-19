<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 3/4/15
 * Time: 11:44 AM
 */

?>

<?php
    $todays_hours = $openHours->get_todays_hours_formatted();
    $is_closed        = $todays_hours['is_closed'];
    $is_holiday       = $todays_hours['is_holiday'];
    $today_open_hour  = $todays_hours['open'];
    $today_close_hour = $todays_hours['close'];

    $printable_hours = $openHours->get_printable_hours_pdf();
?>
<h3>Today's Hours:
    <?php

    if($todays_hours['is_holiday'] == true) {
        if($todays_hours['is_closed'] == 2) {
            echo 'Closed';
        } else {
            echo $todays_hours['open']." - ".$todays_hours['close'];
        }
    } else {
        echo $todays_hours['open']." - ".$todays_hours['close'];
    }

    ?></h3>


<?php $calendar_period = $openHours->get_calendar_period_formatted(); ?>
<h4>
    <?php echo $calendar_period['semester']; ?> <?php echo $calendar_period['year']; ?>: <?php echo $calendar_period['start']; ?> to <?php echo $calendar_period['end']; ?>
</h4>
<br/>
<div id="page_lvl_tabs">
    <ul>
        <li class="active"><a href="#tabs-1" rel="tab-1">This Week's Hours</a></li>
        <li><a href="#tabs-2" rel="tab-2">Exceptions</a></li>
        <li><a href="#tab-upcoming" rel="tab-upcoming">Upcoming</a></li>
        <li><a href="#tabs-3" rel="tab-3">Events</a></li>
        <li><a href="<?php echo $printable_hours['wpcf-printable-hours'][0]; ?>" target="_blank">Printable Hours (.pdf)</a></li>
    </ul>

    <div class="tab-1 breather">

        <br/>

        <?php $data = $openHours->get_times_formatted(); ?>
        <div id="schedule_box">
            <p class="display_date">
            <table class="form_listing" style="background-color: #FFF;">
                <?php foreach($data as $datum): ?>
                    <?php foreach($datum as $key => $day): ?>

                        <?php
                            if($key == $openHours->getCurrentWeekday()):
                                $day = $openHours->get_todays_hours_formatted();

                                if($day['is_closed'] == 2) {
                                    $display_hours = 'Closed';
                                } else {
                                    $display_hours = $day['open']." - ".$day['close'];
                                }

                                if($openHours->is_holiday() == true) {
                                    $asterisk = "*";
                                    $asterisk_def = "<p class='small'>* An exception to the normal weekly schedule. See Exceptions for more information.</p>";
                                } else {
                                    $asterisk = "";
                                    $asterisk_def = "";
                                }

                                echo "<tr style='font-weight: bold; background-color: #ffffe0'><td class='time-entry'>{$key}{$asterisk}</td><td class='time-entry'>  {$display_hours} </td></tr>";
                            else:

                                echo "<tr><td class='time-entry'>{$key}</td><td class='time-entry'>  {$day['open']} -  {$day['close']} </td></tr>";

                            endif;
                        ?>

                    <?php endforeach; ?>
                <?php endforeach; ?>
            </table>
            </p>
            <?php echo $asterisk_def ?>

        </div>
    </div>



    <div class="tab-2 breather" style="display: none;">
        <br/>
        <h5>
            Exceptions to the Richter Library Building Hours
        </h5>


        <div>
            <?php $holidays = $openHours->get_holidays_formatted(); ?>
            <?php

            function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
                $reference_array = array();

                foreach($array as $key => $row) {
                    $reference_array[$key] = strtotime($row[$column]);
                }

                array_multisort($reference_array, $direction, $array);
            }

            ?>

            <?php  array_sort_by_column($holidays, 'start-datetime'); ?>

            <table class="form_listing" style="background-color: #FFF;">
                <tr class="even">
                    <td class="time-entry"><strong>Day</strong></td>
                    <td class="time-entry"><strong>Library Hours</strong></td>
                </tr>


                <?php foreach($holidays as $holiday): ?>

                    <tr>
                        <?php
                        if($holiday['is-closed'] == 'Closed') {

                            if($holiday['start-date'] == $holiday['end-date']) {
                                echo "<td class='time-entry'>". $holiday['name']. "</td><td class='time-entry'> ".$holiday['start-date']." Closed</td>";
                            } else {
                                echo "<td class='time-entry'>". $holiday['name']. "</td><td class='time-entry'> ".$holiday['start-date']. " - ".$holiday['end-date']." Closed</td>";
                            }

                        } else {
                            echo "<td class='time-entry'>". $holiday['name']."</td><td class='time-entry'> ".$holiday['start-date']." ".$holiday['start-time']." - ".$holiday['end-time']."</td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>

    <div class="tab-upcoming breather" style="display: none;">

        <?php

        //var_dump($openHours->getPostId());

        $period = $openHours->get_calendar_period();

        $startdate = date("Y-m-d", strtotime($period['start']));
        $enddate   =  date("Y-m-d", strtotime($period['end']));
        //$enddate = "2015-04-24";


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
            //var_dump($day);
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

            $close_ts = get_post_meta($openHours->getPostId(), $ev_weekday.'_close');
            //var_dump($open_ts);

            $close = date("H:i:s", $close_ts[0] - $offset);
            //var_dump($open);


            $event_title = " - ".date("H:i:s", strtotime($close));
            $event_start = $ev_formatted_array[0]." ".$open;
            $event_end   = $ev_formatted_array[0]." ".$close;
            //var_dump($event_start);



            foreach($days as $day) {
                if(in_array($day, $ev_formatted_array)) {
                    $event_title = "Holiday";
                    //$event_start = $ev_formatted_array;
                    $ev->timezone = "America/New_York";
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




        ?>



        <div id='calendar'></div>

    </div>

    <div class="tab-3 breather" style="display: none;">
        <br/>
        <h5>Events</h5>
        <?php $events = $openHours->get_events_formatted(); ?>
        <?php  array_sort_by_column($events, 'start-datetime'); ?>
        <table class="form_listing" style="background-color: #FFF;">
            <tr class="even">
                <td class="time-entry"><strong>Event</strong></td>
                <td class="time-entry"><strong>Date & Time</strong></td>
            </tr>
            <?php foreach($events as $event): ?>
                <?php
                if($event['event-url'] != "") {

                    $title = "<a href='{$event['event-url']}'>{$event['title']}</a>";
                } else {
                    $title = $event['title'];
                }

                ?>

                <?php echo "<tr><td class='time-entry'>". $title." </td><td class='time-entry'>". $event['start-date']." ". $event['start-time']." - ".$event['end-time']. "</td></tr>"; ?>
            <?php endforeach; ?>
        </table>


    </div>

</div><!--end tabs area-->