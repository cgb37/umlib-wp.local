<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/10/15
 * Time: 2:55 PM
 */

class Library_Hours_Plugin_Holidays_Widget extends WP_Widget {



    function __construct() {
        $widget_opts = array(
            'classname'		=> 'widget_libhours_holidays',
            'description'	=> 'This Widget lists all Holidays set up in the Holidays Section.'
        );

        $this->WP_Widget('widget_libhours_holidays', 'Holiday Library Hours', $widget_opts);
        $this->alt_option_name	= 'widget_libhours_holidays';
    }


    function widget ($args, $instance) {
        extract($args);

        $time_offset = "18000";

        echo "<h2>Events</h2>";

        $args = array(
            'orderby' => 'wpcf-start-date',
            'order' => 'ASC',

        );

        $child_posts = types_child_posts('event', $args);
        echo "<ul>";

        foreach ($child_posts as $child_post) {

            $title = $child_post->post_title;
            $url = $child_post->fields['event-url'];

            $start = strftime('%a %b %e %l:%M %p', $child_post->fields['start-date']+$time_offset);
            $end = strftime('%a %b %e %l:%M %p', $child_post->fields['end-date']+$time_offset);


            echo "<li><a href=$url>".$child_post->post_title."</a>"
                ." ".strftime('%a %b %e %l:%M %p', $child_post->fields['start-date']+$time_offset)
                ." ".strftime('%a %b %e %l:%M %p', $child_post->fields['end-date']+$time_offset)
                ."</li>";
        }

        echo "</ul>";
    }


    function update ($new_instance, $old_instance) {
        return $new_instance;
    }

    function form ($instance) {



    }


}