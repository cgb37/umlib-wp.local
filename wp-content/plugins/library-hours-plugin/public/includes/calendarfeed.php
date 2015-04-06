<?php


header("content-type:application/json");

// - grab wp load, wherever it's hiding -
if(file_exists('../../../../wp-load.php')) :
    include '../../../../wp-load.php';
else:
    include '../../../../../wp-load.php';
endif;

global $wpdb;


$openHours = new Open_Hours();
$events = $openHours->get_json_for_calendar($_GET['ID']);

echo $events;
