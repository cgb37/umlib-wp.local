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

                                if($openHours->is_holiday() == true) {
                                    $asterisk = "*";
                                    $asterisk_def = "<p class='small'>* An exception to the normal weekly schedule. See Exceptions for more information.</p>";
                                } else {
                                    $asterisk = "";
                                    $asterisk_def = "";
                                }

                                echo "<tr style='font-weight: bold; background-color: #ffffe0'><td class='time-entry'>{$key}</td><td>" . date("M j", current_time('timestamp'))  ."{$asterisk}</td><td class='time-entry'>  {$day['open']} -  {$day['close']} </td></tr>";
                            else:

                                echo "<tr><td class='time-entry'>{$key}</td><td>".date("M j", current_time('timestamp'))."</td><td class='time-entry'>  {$day['open']} -  {$day['close']} </td></tr>";

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