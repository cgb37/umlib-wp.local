(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
     *
     *
     *
     *
     *
	 */

    $(document).ready(function() {

        $.ajax({
            dataType: 'json',
            url: '../includes/calendarfeed.php',
            success: function(data) {
                console.log(data)
            }
        });


        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
            defaultView: 'month',
            theme: true,
            themeButtonIcons:false,
            events: json,
            //events: [{"title":"9:30 am - 9:00 pm","start":"2015-01-12 9:30 am","end":"2015-01-12 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-01-13 7:30 am","end":"2015-01-13 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-14 7:30 am","end":"2015-01-14 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-15 7:30 am","end":"2015-01-15 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-01-16 7:30 am","end":"2015-01-16 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-01-17 9:00 am","end":"2015-01-17 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-01-18 12:00 pm","end":"2015-01-18 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-01-19 9:30 am","end":"2015-01-19 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-01-20 7:30 am","end":"2015-01-20 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-21 7:30 am","end":"2015-01-21 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-22 7:30 am","end":"2015-01-22 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-01-23 7:30 am","end":"2015-01-23 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-01-24 9:00 am","end":"2015-01-24 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-01-25 12:00 pm","end":"2015-01-25 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-01-26 9:30 am","end":"2015-01-26 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-01-27 7:30 am","end":"2015-01-27 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-28 7:30 am","end":"2015-01-28 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-01-29 7:30 am","end":"2015-01-29 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-01-30 7:30 am","end":"2015-01-30 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-01-31 9:00 am","end":"2015-01-31 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-02-01 12:00 pm","end":"2015-02-01 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-02-02 9:30 am","end":"2015-02-02 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-02-03 7:30 am","end":"2015-02-03 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-04 7:30 am","end":"2015-02-04 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-05 7:30 am","end":"2015-02-05 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-02-06 7:30 am","end":"2015-02-06 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-02-07 9:00 am","end":"2015-02-07 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-02-08 12:00 pm","end":"2015-02-08 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-02-09 9:30 am","end":"2015-02-09 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-02-10 7:30 am","end":"2015-02-10 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-11 7:30 am","end":"2015-02-11 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-12 7:30 am","end":"2015-02-12 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-02-13 7:30 am","end":"2015-02-13 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-02-14 9:00 am","end":"2015-02-14 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-02-15 12:00 pm","end":"2015-02-15 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-02-16 9:30 am","end":"2015-02-16 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-02-17 7:30 am","end":"2015-02-17 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-18 7:30 am","end":"2015-02-18 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-19 7:30 am","end":"2015-02-19 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-02-20 7:30 am","end":"2015-02-20 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-02-21 9:00 am","end":"2015-02-21 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-02-22 12:00 pm","end":"2015-02-22 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-02-23 9:30 am","end":"2015-02-23 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-02-24 7:30 am","end":"2015-02-24 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-25 7:30 am","end":"2015-02-25 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-02-26 7:30 am","end":"2015-02-26 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-02-27 7:30 am","end":"2015-02-27 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-02-28 9:00 am","end":"2015-02-28 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-03-01 12:00 pm","end":"2015-03-01 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-03-02 9:30 am","end":"2015-03-02 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-03-03 7:30 am","end":"2015-03-03 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-03-04 7:30 am","end":"2015-03-04 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-03-05 7:30 am","end":"2015-03-05 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-06 7:30 am","end":"2015-03-06 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-03-07 9:00 am","end":"2015-03-07 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-03-08 12:00 pm","end":"2015-03-08 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-03-09 9:30 am","end":"2015-03-09 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-03-10 7:30 am","end":"2015-03-10 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-03-11 7:30 am","end":"2015-03-11 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-12 7:30 am","end":"2015-03-12 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-03-13 7:30 am","end":"2015-03-13 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-03-14 9:00 am","end":"2015-03-14 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-03-15 12:00 pm","end":"2015-03-15 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-03-16 9:30 am","end":"2015-03-16 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-03-17 7:30 am","end":"2015-03-17 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-03-18 7:30 am","end":"2015-03-18 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-19 7:30 am","end":"2015-03-19 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-03-20 7:30 am","end":"2015-03-20 10:00 pm","allDay":false},{"title":"Holiday","start":"2015-03-21 9:00 am","end":"2015-03-21 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-03-22 12:00 pm","end":"2015-03-22 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-03-23 9:30 am","end":"2015-03-23 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-03-24 7:30 am","end":"2015-03-24 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-03-25 7:30 am","end":"2015-03-25 2:00 am","allDay":false},{"title":"Holiday","start":"2015-03-26 7:30 am","end":"2015-03-26 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-03-27 7:30 am","end":"2015-03-27 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-03-28 9:00 am","end":"2015-03-28 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-03-29 12:00 pm","end":"2015-03-29 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-03-30 9:30 am","end":"2015-03-30 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-03-31 7:30 am","end":"2015-03-31 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-01 7:30 am","end":"2015-04-01 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-02 7:30 am","end":"2015-04-02 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-04-03 7:30 am","end":"2015-04-03 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-04-04 9:00 am","end":"2015-04-04 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-04-05 12:00 pm","end":"2015-04-05 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-04-06 9:30 am","end":"2015-04-06 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-04-07 7:30 am","end":"2015-04-07 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-08 7:30 am","end":"2015-04-08 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-09 7:30 am","end":"2015-04-09 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-04-10 7:30 am","end":"2015-04-10 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-04-11 9:00 am","end":"2015-04-11 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-04-12 12:00 pm","end":"2015-04-12 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-04-13 9:30 am","end":"2015-04-13 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-04-14 7:30 am","end":"2015-04-14 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-15 7:30 am","end":"2015-04-15 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-16 7:30 am","end":"2015-04-16 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-04-17 7:30 am","end":"2015-04-17 10:00 pm","allDay":false},{"title":"9:00 am - 6:00 pm","start":"2015-04-18 9:00 am","end":"2015-04-18 6:00 pm","allDay":false},{"title":"12:00 pm - 6:00 pm","start":"2015-04-19 12:00 pm","end":"2015-04-19 6:00 pm","allDay":false},{"title":"9:30 am - 9:00 pm","start":"2015-04-20 9:30 am","end":"2015-04-20 9:00 pm","allDay":false},{"title":"7:30 am - 9:00 pm","start":"2015-04-21 7:30 am","end":"2015-04-21 9:00 pm","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-22 7:30 am","end":"2015-04-22 2:00 am","allDay":false},{"title":"7:30 am - 2:00 am","start":"2015-04-23 7:30 am","end":"2015-04-23 2:00 am","allDay":false},{"title":"7:30 am - 10:00 pm","start":"2015-04-24 7:30 am","end":"2015-04-24 10:00 pm","allDay":false}]
            //events: '/includes/events.php'

            eventClick: function(calEvent, jsEvent, view) {

                alert(calEvent.title);


            }
        })



        $("#tab-upcoming").on( "click", function() {

            $('.tab-upcoming').show();

            $('#calendar').fullCalendar('render');

        });

    });

})( jQuery );
