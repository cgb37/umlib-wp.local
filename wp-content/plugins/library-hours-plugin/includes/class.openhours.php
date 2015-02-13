<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/13/15
 * Time: 9:02 AM
 */

class Open_Hours {


    private $_monday;
    private $_tuesday;
    private $_wednesday;
    private $_thursday;
    private $_friday;
    private $_saturday;
    private $_sunday;

    private $_monday_open;
    private $_tuesday_open;
    private $_wednesday_open;
    private $_thursday_open;
    private $_friday_open;
    private $_saturday_open;
    private $_sunday_open;

    private $_monday_close;
    private $_tuesday_close;
    private $_wednesday_close;
    private $_thursday_close;
    private $_friday_close;
    private $_saturday_close;
    private $_sunday_close;

    private $_time_offset = "18000";


    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0

     */
    public function __construct() {

    }


    function set_post_metadata_keys() {

        $this->pmd_keys = array(

            array("Monday"    => array("open" => "monday_open",    "close" => "monday_close"),),
            array("Tuesday"   => array("open" => "tuesday_open",   "close" => "tuesday_close"),),
            array("Wednesday" => array("open" => "wednesday_open", "close" => "wednesday_close"),),
            array("Thursday"  => array("open" => "thursday_open",  "close" => "thursday_close"),),
            array("Friday"    => array("open" => "friday_open",    "close" => "friday_close"),),
            array("Saturday"  => array("open" => "saturday_open",  "close" => "saturday_close"),),
            array("Sunday"    => array("open" => "sunday_open",    "close" => "sunday_close"),),

        );

        return $this->pmd_keys;
    }


    function get_timestamp($post_id, $key) {
        $timestamp = get_post_meta( $post_id, $key );
        return $timestamp;
    }

    function date_formatter($timestamp) {
        return date('h:i a', $timestamp + $this->_time_offset);
    }

    function get_time($post_id, $key) {
        $timestamp = $this->get_timestamp( $post_id, $key );

        $time = $this->date_formatter($timestamp[0]);

        return $time;
    }

    function get_formatted_times($post_id) {

        //get the keys for the post metadata
        $keys = $this->set_post_metadata_keys();

        $times = array();
        foreach($keys as $datum):
            foreach($datum as $key => $day):
                $times[] = array($key => array("open" => $this->get_time($post_id, $day['open']), "close" => $this->get_time($post_id, $day['close'])),);
            endforeach;
        endforeach;

        return $times;
    }

    function is_open() {


    }


    function is_between_period($current_time, $open, $close) {

        if ( strtolower( date('l', current_time('timestamp')) ) != $this->day )
            return false;

        return ( $open <= $current_time and $close >= $current_time );
    }


    /**
     * Retrieve the current time based on specified type.
     *
     * The 'mysql' type will return the time in the format for MySQL DATETIME field.
     * The 'timestamp' type will return the current timestamp.
     * Other strings will be interpreted as PHP date formats (e.g. 'Y-m-d').
     *
     * If $gmt is set to either '1' or 'true', then both types will use GMT time.
     * if $gmt is false, the output is adjusted with the GMT offset in the WordPress option.
     *
     * @since 1.0.0
     *
     * @param string   $type Type of time to retrieve. Accepts 'mysql', 'timestamp', or PHP date
     *                       format string (e.g. 'Y-m-d').
     * @param int|bool $gmt  Optional. Whether to use GMT timezone. Default false.
     * @return int|string Integer if $type is 'timestamp', string otherwise.
     */
    function current_time( $type, $gmt = 0 ) {
        switch ( $type ) {
            case 'mysql':
                return ( $gmt ) ? gmdate( 'Y-m-d H:i:s' ) : gmdate( 'Y-m-d H:i:s', ( time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ) );
            case 'timestamp':
                return ( $gmt ) ? time() : time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
            default:
                return ( $gmt ) ? date( $type ) : date( $type, time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) );
        }
    }


    function get_data(){

        $data = array(

            array("Monday"    => array("open" => "07:30:00", "close" => "02:00:00"),),
            array("Tuesday"   => array("open" => "07:30:00", "close" => "02:00:00"),),
            array("Wednesday" => array("open" => "07:30:00", "close" => "02:00:00"),),
            array("Thursday"  => array("open" => "07:30:00", "close" => "02:00:00"),),
            array("Friday"    => array("open" => "07:30:00", "close" => "02:00:00"),),
            array("Saturday"  => array("open" => "09:00:00", "close" => "22:00:00"),),
            array("Sunday"    => array("open" => "09:00:00", "close" => "02:00:00"),),

        );

        return $data;

    }




    /**
     * @return mixed
     */
    public function getMonday()
    {
        return $this->_monday;
    }

    /**
     * @param mixed $monday
     */
    public function setMonday($monday)
    {
        $this->_monday = $monday;
    }

    /**
     * @return mixed
     */
    public function getTuesday()
    {
        return $this->_tuesday;
    }

    /**
     * @param mixed $tuesday
     */
    public function setTuesday($tuesday)
    {
        $this->_tuesday = $tuesday;
    }

    /**
     * @return mixed
     */
    public function getWednesday()
    {
        return $this->_wednesday;
    }

    /**
     * @param mixed $wednesday
     */
    public function setWednesday($wednesday)
    {
        $this->_wednesday = $wednesday;
    }

    /**
     * @return mixed
     */
    public function getThursday()
    {
        return $this->_thursday;
    }

    /**
     * @param mixed $thursday
     */
    public function setThursday($thursday)
    {
        $this->_thursday = $thursday;
    }

    /**
     * @return mixed
     */
    public function getFriday()
    {
        return $this->_friday;
    }

    /**
     * @param mixed $friday
     */
    public function setFriday($friday)
    {
        $this->_friday = $friday;
    }

    /**
     * @return mixed
     */
    public function getSaturday()
    {
        return $this->_saturday;
    }

    /**
     * @param mixed $saturday
     */
    public function setSaturday($saturday)
    {
        $this->_saturday = $saturday;
    }

    /**
     * @return mixed
     */
    public function getSunday()
    {
        return $this->_sunday;
    }

    /**
     * @param mixed $sunday
     */
    public function setSunday($sunday)
    {
        $this->_sunday = $sunday;
    }

    /**
     * @return mixed
     */
    public function getMondayOpen()
    {
        return $this->_monday_open;
    }

    /**
     * @param mixed $monday_open
     */
    public function setMondayOpen($monday_open)
    {
        $this->_monday_open = $monday_open;
    }

    /**
     * @return mixed
     */
    public function getTuesdayOpen()
    {
        return $this->_tuesday_open;
    }

    /**
     * @param mixed $tuesday_open
     */
    public function setTuesdayOpen($tuesday_open)
    {
        $this->_tuesday_open = $tuesday_open;
    }

    /**
     * @return mixed
     */
    public function getWednesdayOpen()
    {
        return $this->_wednesday_open;
    }

    /**
     * @param mixed $wednesday_open
     */
    public function setWednesdayOpen($wednesday_open)
    {
        $this->_wednesday_open = $wednesday_open;
    }

    /**
     * @return mixed
     */
    public function getThursdayOpen()
    {
        return $this->_thursday_open;
    }

    /**
     * @param mixed $thursday_open
     */
    public function setThursdayOpen($thursday_open)
    {
        $this->_thursday_open = $thursday_open;
    }

    /**
     * @return mixed
     */
    public function getFridayOpen()
    {
        return $this->_friday_open;
    }

    /**
     * @param mixed $friday_open
     */
    public function setFridayOpen($friday_open)
    {
        $this->_friday_open = $friday_open;
    }

    /**
     * @return mixed
     */
    public function getSaturdayOpen()
    {
        return $this->_saturday_open;
    }

    /**
     * @param mixed $saturday_open
     */
    public function setSaturdayOpen($saturday_open)
    {
        $this->_saturday_open = $saturday_open;
    }

    /**
     * @return mixed
     */
    public function getSundayOpen()
    {
        return $this->_sunday_open;
    }

    /**
     * @param mixed $sunday_open
     */
    public function setSundayOpen($sunday_open)
    {
        $this->_sunday_open = $sunday_open;
    }

    /**
     * @return mixed
     */
    public function getMondayClose()
    {
        return $this->_monday_close;
    }

    /**
     * @param mixed $monday_close
     */
    public function setMondayClose($monday_close)
    {
        $this->_monday_close = $monday_close;
    }

    /**
     * @return mixed
     */
    public function getTuesdayClose()
    {
        return $this->_tuesday_close;
    }

    /**
     * @param mixed $tuesday_close
     */
    public function setTuesdayClose($tuesday_close)
    {
        $this->_tuesday_close = $tuesday_close;
    }

    /**
     * @return mixed
     */
    public function getWednesdayClose()
    {
        return $this->_wednesday_close;
    }

    /**
     * @param mixed $wednesday_close
     */
    public function setWednesdayClose($wednesday_close)
    {
        $this->_wednesday_close = $wednesday_close;
    }

    /**
     * @return mixed
     */
    public function getThursdayClose()
    {
        return $this->_thursday_close;
    }

    /**
     * @param mixed $thursday_close
     */
    public function setThursdayClose($thursday_close)
    {
        $this->_thursday_close = $thursday_close;
    }

    /**
     * @return mixed
     */
    public function getFridayClose()
    {
        return $this->_friday_close;
    }

    /**
     * @param mixed $friday_close
     */
    public function setFridayClose($friday_close)
    {
        $this->_friday_close = $friday_close;
    }

    /**
     * @return mixed
     */
    public function getSaturdayClose()
    {
        return $this->_saturday_close;
    }

    /**
     * @param mixed $saturday_close
     */
    public function setSaturdayClose($saturday_close)
    {
        $this->_saturday_close = $saturday_close;
    }

    /**
     * @return mixed
     */
    public function getSundayClose()
    {
        return $this->_sunday_close;
    }

    /**
     * @param mixed $sunday_close
     */
    public function setSundayClose($sunday_close)
    {
        $this->_sunday_close = $sunday_close;
    }



}