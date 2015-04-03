<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/13/15
 * Time: 9:02 AM
 */

class Open_Hours {

    private $_post_id;


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

    private $_time_offset = "14400";
    private $_current_timestamp;
    private $_current_weekday;

    private $_open_hour_format = "g:i a";
    private $_close_hour_format = "g:i a";

    private $_holiday_datetime_format = "D M j, Y g:i a";
    private $_holiday_date_format = "M j (D)";
    private $_holiday_time_format = "g:i a";

    private $_event_datetime_format = "D M j, g:i a";
    private $_event_date_format = "M j (D)";
    private $_event_time_format = "g:i a";

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0

     */
    public function __construct() {

        $this->setup();

    }


    protected function setup() {

        $this->setPostId(null);
        $this->setCurrentTimestamp(null);
        $this->setCurrentWeekday(null);

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


    function get_post_meta_timestamp($post_id, $key) {
        $timestamp = get_post_meta( $post_id, $key );
        return $timestamp;
    }

    function date_formatter($format, $timestamp) {
        return date($format, $timestamp + $this->_time_offset);
    }

    function get_post_meta_time_formatted($post_id, $key) {
        $timestamp = $this->get_post_meta_timestamp( $post_id, $key );
        $time = $this->date_formatter("g:i a", $timestamp[0]);
        return $time;
    }

    function get_times_formatted() {

        $post_id = $this->getPostId();
        //get the keys for the post metadata
        $keys = $this->set_post_metadata_keys();

        $times = array();
        foreach($keys as $datum):
            foreach($datum as $key => $day):
                $times[] = array(
                    $key => array(
                        "open"  => $this->get_post_meta_time_formatted($post_id, $day['open']),
                        "close" => $this->get_post_meta_time_formatted($post_id, $day['close'])
                    ),
                );
            endforeach;
        endforeach;

        return $times;
    }

    public function get_current_day() {
        $ts = current_time('timestamp');
        $today = date('l', $ts);
        return $today;
    }

    public function is_today() {

        $today = $this->getCurrentWeekday();
        $keys = $this->set_post_metadata_keys();

        foreach($keys as $datum):
            foreach($datum as $day => $value):
                if($today == $day) {
                    return true;
                }
            endforeach;
        endforeach;

        return false;
    }

    public function get_holidays() {

        $args = array(
            'orderby' => 'wpcf-start-date',
            'order' => 'ASC',
            'post_id' => $this->getPostId()
        );

        $holidays = types_child_posts('holiday', $args);
        return $holidays;
    }

    public function get_holidays_formatted() {

        $holidays = $this->get_holidays();

        $days = array();

        foreach($holidays as $day) {

            $start = $this->date_formatter($this->_holiday_datetime_format, $day->fields['start-date']);
            $end   = $this->date_formatter($this->_holiday_datetime_format, $day->fields['end-date']);

            $start_time = $this->date_formatter($this->_holiday_time_format, $day->fields['start-date']);
            $start_date = $this->date_formatter($this->_holiday_date_format, $day->fields['start-date']);

            $end_time = $this->date_formatter($this->_holiday_time_format, $day->fields['end-date']);
            $end_date = $this->date_formatter($this->_holiday_date_format, $day->fields['end-date']);

            if($day->fields['holiday-closed'] == 1) {
                $is_closed = 'Open';
            } else {
                $is_closed = 'Closed';
            }

            $days[] = array(
                'name'           => $day->post_title,
                'start-datetime' => $start,
                'end-datetime'   => $end,
                'start-time'     => $start_time,
                'end-time'       => $end_time,
                'start-date'     => $start_date,
                'end-date'       => $end_date,
                'is-closed'      => $is_closed
            );
        }

        return $days;
    }

    public function is_holiday() {

        $holidays = $this->get_holidays();

        $today = $this->getCurrentWeekday();
        $current_timestamp = $this->getCurrentTimestamp();

        if ( strtolower( date('l', $current_timestamp) ) == strtolower($today) ) {
            foreach($holidays as $day) {

                $start_date = $this->date_formatter($this->_holiday_date_format, $day->fields['start-date']);

                if(strtolower( date('D M j, Y', $current_timestamp) ) == strtolower($start_date)) {
                    return true;
                } elseif($day->fields['start-date'] <= $current_timestamp and $day->fields['end-date'] >= $current_timestamp ){
                    //closed
                    return true;
                }
            }
        }
        return false;

    }

    public function is_holiday_check($timestamp) {

        $date_to_verify = $timestamp;

        $holidays = $this->get_holidays();

        foreach($holidays as $day) {
            $start_date = $this->date_formatter($this->_holiday_date_format, $day->fields['start-date']);

            if(strtolower( date('D M j, Y', $date_to_verify) ) == strtolower($start_date)) {
                return true;
            } elseif($day->fields['start-date'] <= $date_to_verify and $day->fields['end-date'] >= $date_to_verify ){
                //closed
                return true;
            } else {
                return false;
            }
        }
    }


    public function get_calendar_period() {

        $query = get_post_meta($this->getPostId());

        $data = array(
            'semester' => $query['semester'][0],
            'year'     => $query['year'][0],
            'start'    => $query['semester_begin'][0],
            'end'      => $query['semester_end'][0],
        );
        return $data;
    }

    public function get_calendar_period_formatted() {

        $data = get_post_meta($this->getPostId());

        $return = array(
            'semester' => strtoupper($data['semester'][0]),
            'year'     => $data['year'][0],
            'start'    => $this->date_formatter('M j, Y', strtotime($data['semester_begin'][0])),
            'end'      => $this->date_formatter('M j, Y', strtotime($data['semester_end'][0])),
        );
        return $return;
    }


    public function get_todays_hours_formatted() {

        //is today
        if($this->is_today() == true) {

            //is today a holiday?
            if($this->is_holiday() == true) {

                //get post
                $holidays = $this->get_holidays();

                $current_timestamp = $this->getCurrentTimestamp();

                foreach($holidays as $day) {
                    $start_date = $this->date_formatter($this->_holiday_date_format, $day->fields['start-date']);

                    if($day->fields['start-date'] <= $current_timestamp and $day->fields['end-date'] >= $current_timestamp ) {

                        $hours = array(
                            'is_holiday' => true,
                            'is_closed'  => $day->fields['holiday-closed'],
                            'open'       => $this->date_formatter("g:i a", $day->fields['start-date']),
                            'close'      => $this->date_formatter("g:i a", $day->fields['end-date']),
                        );


                    } elseif( (strtolower( date('D M j, Y', $current_timestamp) ) == strtolower($start_date)) and ($day->fields['holiday-closed'] == 1) ) {
                        $hours = array(
                            'is_holiday' => true,
                            'is_closed'  => $day->fields['holiday-closed'],
                            'open'       => $this->date_formatter("g:i a", $day->fields['start-date']),
                            'close'      => $this->date_formatter("g:i a", $day->fields['end-date']),
                        );
                    } elseif($day->fields['holiday-closed'] == 2) {
                        $hours = array(
                            'is_holiday' => true,
                            'is_closed'  => $day->fields['holiday-closed'],
                            'open'       => $this->date_formatter("g:i a", $day->fields['start-date']),
                            'close'      => $this->date_formatter("g:i a", $day->fields['end-date']),
                        );
                       // var_dump($day);
                    }
                }

            } else {

                $today = strtolower($this->getCurrentWeekday());

                $open_ts = get_post_meta($this->getPostId(), $today.'_open');
                $open    = $this->date_formatter("g:i a", $open_ts[0]);

                $close_ts = get_post_meta($this->getPostId(), $today.'_close');
                $close    = $this->date_formatter("g:i a", $close_ts[0]);

                $hours = array(
                    'is_holiday' => false,
                    'is_closed' => '1',
                    'open' => $open,
                    'close' => $close,
                );
            }

            return $hours;
        }
        return false;
    }


    public function get_events_by_postid() {

        $post_id = $this->getPostId();

        $args = array(
            'post_id' => $post_id,
            'orderby' => 'wpcf-start-date',
            'order' => 'ASC',
        );

        $events = types_child_posts('event', $args);
        return $events;
    }

    public function get_events_formatted() {

        $data = $this->get_events_by_postid();

        $events = array();
        foreach($data as $event) {

            $events[] = array(
                'title'          => $event->post_title,
                'start-datetime' => $this->date_formatter($this->_event_datetime_format, $event->fields['start-date']),
                'end-datetime'   => $this->date_formatter($this->_event_datetime_format, $event->fields['end-date']),
                'start-date'     => $this->date_formatter($this->_event_date_format, $event->fields['start-date']),
                'end-date'       => $this->date_formatter($this->_event_date_format, $event->fields['end-date']),
                'start-time'     => $this->date_formatter($this->_event_time_format, $event->fields['start-date']),
                'end-time'       => $this->date_formatter($this->_event_time_format, $event->fields['end-date']),
                'event-url'      => $event->fields['event-url'],
            );
        }
        return $events;
    }

    public function get_printable_hours_pdf() {

        $post_id = $this->getPostId();

        $args = array(
            'post_id' => $post_id
        );

        $data = get_post_meta($post_id);
        return $data;
    }


    public function get_branch_hours() {

        // must be a branch and active
        //schedule_type
        //calendar_active
        $today = $this->getCurrentTimestamp();

        $args = array(
            'post_type' => 'libhours_post_type',

            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'calendar_active',
                    'value' => 'yes',
                ),

                array(
                    'key' => 'schedule_type',
                    'value' => 'branch',
                )



            )
        );
        $query = new WP_Query( $args );

        $post_id = $query->posts[0]->ID;

        $this->setPostId($post_id);
        $data = $this->get_todays_hours_formatted();

        return $data;
    }


    public function get_json_for_calendar() {

        //$events = '[{"title":" - 9:00 pm","start":"2015-01-12 07:30:00","end":"2015-01-12 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-13 07:30:00","end":"2015-01-13 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-14 07:30:00","end":"2015-01-14 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-15 07:30:00","end":"2015-01-15 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-16 07:30:00","end":"2015-01-16 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-17 09:00:00","end":"2015-01-17 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-18 12:00:00","end":"2015-01-18 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-19 07:30:00","end":"2015-01-19 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-20 07:30:00","end":"2015-01-20 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-21 07:30:00","end":"2015-01-21 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-22 07:30:00","end":"2015-01-22 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-23 07:30:00","end":"2015-01-23 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-24 09:00:00","end":"2015-01-24 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-25 12:00:00","end":"2015-01-25 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-26 07:30:00","end":"2015-01-26 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-01-27 07:30:00","end":"2015-01-27 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-01-28 07:30:00","end":"2015-01-28 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-01-29 07:30:00","end":"2015-01-29 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-01-30 07:30:00","end":"2015-01-30 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-01-31 09:00:00","end":"2015-01-31 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-01 12:00:00","end":"2015-02-01 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-02 07:30:00","end":"2015-02-02 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-03 07:30:00","end":"2015-02-03 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-04 07:30:00","end":"2015-02-04 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-05 07:30:00","end":"2015-02-05 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-06 07:30:00","end":"2015-02-06 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-07 09:00:00","end":"2015-02-07 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-08 12:00:00","end":"2015-02-08 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-09 07:30:00","end":"2015-02-09 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-10 07:30:00","end":"2015-02-10 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-11 07:30:00","end":"2015-02-11 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-12 07:30:00","end":"2015-02-12 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-13 07:30:00","end":"2015-02-13 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-14 09:00:00","end":"2015-02-14 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-15 12:00:00","end":"2015-02-15 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-16 07:30:00","end":"2015-02-16 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-17 07:30:00","end":"2015-02-17 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-18 07:30:00","end":"2015-02-18 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-19 07:30:00","end":"2015-02-19 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-20 07:30:00","end":"2015-02-20 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-21 09:00:00","end":"2015-02-21 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-22 12:00:00","end":"2015-02-22 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-23 07:30:00","end":"2015-02-23 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-02-24 07:30:00","end":"2015-02-24 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-02-25 07:30:00","end":"2015-02-25 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-02-26 07:30:00","end":"2015-02-26 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-02-27 07:30:00","end":"2015-02-27 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-02-28 09:00:00","end":"2015-02-28 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-01 12:00:00","end":"2015-03-01 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-02 07:30:00","end":"2015-03-02 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-03 07:30:00","end":"2015-03-03 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-04 07:30:00","end":"2015-03-04 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-03-05 07:30:00","end":"2015-03-05 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-06 07:30:00","end":"2015-03-06 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-07 09:00:00","end":"2015-03-07 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-08 12:00:00","end":"2015-03-08 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-09 07:30:00","end":"2015-03-09 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-10 07:30:00","end":"2015-03-10 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-11 07:30:00","end":"2015-03-11 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-03-12 07:30:00","end":"2015-03-12 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-03-13 07:30:00","end":"2015-03-13 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-14 09:00:00","end":"2015-03-14 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-15 12:00:00","end":"2015-03-15 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-16 07:30:00","end":"2015-03-16 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-17 07:30:00","end":"2015-03-17 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-18 07:30:00","end":"2015-03-18 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-19 07:30:00","end":"2015-03-19 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-03-20 07:30:00","end":"2015-03-20 10:00 pm","allDay":false},{"title":"Holiday","start":"2015-03-21 09:00:00","end":"2015-03-21 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-22 12:00:00","end":"2015-03-22 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-23 07:30:00","end":"2015-03-23 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-24 07:30:00","end":"2015-03-24 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-03-25 07:30:00","end":"2015-03-25 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-26 07:30:00","end":"2015-03-26 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-03-27 07:30:00","end":"2015-03-27 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-28 09:00:00","end":"2015-03-28 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-03-29 12:00:00","end":"2015-03-29 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-03-30 07:30:00","end":"2015-03-30 9:00 pm","allDay":false},{"title":"Holiday","start":"2015-03-31 07:30:00","end":"2015-03-31 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-01 07:30:00","end":"2015-04-01 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-02 07:30:00","end":"2015-04-02 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-03 07:30:00","end":"2015-04-03 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-04 09:00:00","end":"2015-04-04 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-05 12:00:00","end":"2015-04-05 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-06 07:30:00","end":"2015-04-06 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-07 07:30:00","end":"2015-04-07 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-08 07:30:00","end":"2015-04-08 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-09 07:30:00","end":"2015-04-09 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-10 07:30:00","end":"2015-04-10 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-11 09:00:00","end":"2015-04-11 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-12 12:00:00","end":"2015-04-12 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-13 07:30:00","end":"2015-04-13 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-14 07:30:00","end":"2015-04-14 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-15 07:30:00","end":"2015-04-15 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-16 07:30:00","end":"2015-04-16 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-17 07:30:00","end":"2015-04-17 10:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-18 09:00:00","end":"2015-04-18 6:00 pm","allDay":false},{"title":" - 6:00 pm","start":"2015-04-19 12:00:00","end":"2015-04-19 6:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-20 07:30:00","end":"2015-04-20 9:00 pm","allDay":false},{"title":" - 9:00 pm","start":"2015-04-21 07:30:00","end":"2015-04-21 9:00 pm","allDay":false},{"title":" - 2:00 am","start":"2015-04-22 07:30:00","end":"2015-04-22 2:00 am","allDay":false},{"title":" - 2:00 am","start":"2015-04-23 07:30:00","end":"2015-04-23 2:00 am","allDay":false},{"title":" - 10:00 pm","start":"2015-04-24 07:30:00","end":"2015-04-24 10:00 pm","allDay":false}]';
        //return $events;


        $period = $this->get_calendar_period();

        $startdate = date("Y-m-d", strtotime($period['start']));
        //var_dump($startdate);
        $enddate   =  date("Y-m-d", strtotime($period['end']));
        //var_dump($enddate);
        //$enddate = "2015-04-24";


        $start        = new DateTime($startdate);
        $end_period   = new DateTime($enddate);
        $end_period   = $end_period->modify('+1 day');

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end_period);


        $current_day_str = date("Y-m-d", current_time('timestamp'));
        $holidays = $this->get_holidays();
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

            $open_ts = get_post_meta($this->getPostId(), $ev_weekday.'_open');
            //var_dump($open_ts);

            $open = date("H:i:s", $open_ts[0] - $offset);
            //var_dump($open);

            $close_ts = get_post_meta($this->getPostId(), $ev_weekday.'_close');
            //var_dump($open_ts);

            $close = date("g:i a", $close_ts[0] - $offset);
            //var_dump($close);


            $event_title = " - ".$close;
            //var_dump($event_title);
            $event_start = $ev_formatted_array[0]." ".$open;
            $event_end   = $ev_formatted_array[0]." ".$close;
            //var_dump($event_start);



            foreach($days as $day) {
                if(in_array($day, $ev_formatted_array)) {
                    $event_title = "Holiday";
                    $event_start = $ev_formatted_array;
                    $ev->timezone = "America/New_York";
                }
            }


            $events[] = array(
                'title'  => $event_title,
                'start'  => $ev_formatted_array[0]." ".$open,
                'end'    => $event_end,
                'allDay' => false
            );



        }

        $return["json"] = json_encode($events);

        $json = wp_json_encode($events);
        return $json;

    }



    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->_post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        if(!is_null($post_id)) {
            $this->_post_id = $post_id;
        } else {
            $this->_post_id = get_the_ID();
        }
    }




    /**
     * @return mixed
     */
    public function getCurrentTimestamp()
    {
        return $this->_current_timestamp;
    }

    /**
     * @param mixed $current_timestamp
     */
    public function setCurrentTimestamp($current_timestamp)
    {
        if(!is_null($current_timestamp)) {
            $this->_current_timestamp = $current_timestamp;
        } else {
            $this->_current_timestamp = current_time('timestamp');
        }


    }

    /**
     * @return mixed
     */
    public function getCurrentWeekday()
    {
        return $this->_current_weekday;
    }

    /**
     * @param mixed $current_weekday
     */
    public function setCurrentWeekday($current_weekday)
    {
        if(!is_null($current_weekday)) {
            $this->_current_weekday = $current_weekday;
        } else {
            $this->_current_weekday = $this->get_current_day();
        }

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