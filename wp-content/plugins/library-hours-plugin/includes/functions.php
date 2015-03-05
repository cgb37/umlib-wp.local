<?php

/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/11/15
 * Time: 4:05 PM
 */



function is_between_period($current_time, $open, $close) {

    if ( strtolower( date('l', current_time('timestamp')) ) != $this->day )
        return false;

    return ( $open <= $current_time and $close >= $current_time );
}

function master_schedule_func( $atts ){

    $a = shortcode_atts( array(
        'post_id' => 'post_id',
    ), $atts);


    $openHours = new Open_Hours();
    $openHours->setPostId($a['post_id']);

    $template_filename = dirname(__FILE__) .'/../public/partials/master-calendar-for-shortcode-display.php';

    if(file_exists($template_filename)) {
        set_query_var( 'openHours', $openHours );
        $template = load_template( $template_filename );
    }

    return $template;
}


add_shortcode( 'master_schedule', 'master_schedule_func' );