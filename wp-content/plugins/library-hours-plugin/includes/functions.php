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

function master_calendar_func( $atts ){

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


add_shortcode( 'master_calendar', 'master_calendar_func' );



function custom_libhours_post_type_column( $column, $post_id ) {


    switch ( $column ) {

        case 'ID' :
            echo get_the_ID();
            break;

        case 'semester' :
            $semester = get_post_meta( $post_id , 'semester' , true );
            echo ucfirst($semester);
            break;

        case 'year' :
            echo get_post_meta( $post_id , 'year' , true );
            break;

        case 'calendar_active' :
            $ca = get_post_meta( $post_id , 'calendar_active' , true );
            echo ucfirst($ca);
            break;

    }
}




add_action( 'manage_libhours_post_type_posts_custom_column' , 'custom_libhours_post_type_column', 10, 2 );


function add_libhours_post_type_columns($columns) {

    return array_merge($columns,
        array(
            'ID' => __('Post ID'),
            'semester' => __('Semester'),
            'year' => __('Year'),
            'calendar_active' =>__( 'Calendar Active'

            )
        )
    );
}
add_filter('manage_libhours_post_type_posts_columns' , 'add_libhours_post_type_columns');



