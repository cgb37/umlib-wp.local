<?php

/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/11/15
 * Time: 4:05 PM
 */



function get_today() {
    $ts = current_time('timestamp');
    $today = date('l', $ts);
    return $today;
}


function is_between_period($current_time, $open, $close) {

    if ( strtolower( date('l', current_time('timestamp')) ) != $this->day )
        return false;

    return ( $open <= $current_time and $close >= $current_time );
}

function todays_hours_func( $atts ){

    $openHours = new Open_Hours();

    $todays_hours = $openHours->get_todays_hours_formatted();
    $is_closed        = $todays_hours['is_closed'];
    $is_holiday       = $todays_hours['is_holiday'];
    $today_open_hour  = $todays_hours['open'];
    $today_close_hour = $todays_hours['close'];

    if($is_closed == 2) {
        $return = "<div>Closed</div>";
    } else {
        $return = "<div>{$today_open_hour} - {$today_close_hour}</div>";

    }

    return $return;
}


add_shortcode( 'todays_hours', 'todays_hours_func' );