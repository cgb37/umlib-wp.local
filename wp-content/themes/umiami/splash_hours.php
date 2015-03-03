<?php
/**
 * Template Name: Splash_Hours
 * The template for the Books splash page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header();

// Connect
$get_date = date("Y-m-d");
//$get_date = "2011-01-01";
$weekday = date("l");

$today = get_schedule($get_date, $weekday);

$schedule7 = show_seven_day_schedule($get_date);

// For the calendar box
include("inc/class.sscalendar.php");

//Select current month and year to display on little calendar - added by Rendon and Buckard 1/19/12


$Time = time();
# if variables are m OR y are empty, default to today
if( isset($_GET['m']) == '' || isset($_GET['y']) ==''){
  $Month = date( 'm', $Time );
  $Day = date( 'd', $Time );
  $Year = date( 'Y', $Time );
}elseif( $_GET['m'] == '' || $_GET['y'] ==''){
  $Month = date( 'm', $Time );
  $Day = date( 'd', $Time );
  $Year = date( 'Y', $Time );
}
# if the next/previous month/year links was clicked
# grab the dates from the url string
# and select all corresponding records to display
elseif( isset( $_GET['m'] ) != '' && isset( $_GET['y'] ) != '' && isset( $_GET['d'] ) == '' ){
  $DateTemp = strtotime( $_GET['y'].'-'.$_GET['m'].'-' . 1 );
  $Month = date( 'm', $DateTemp );
  $Day = date( 'd', $DateTemp ); # the first day of the next/previous month
  $Year = date( 'Y', $DateTemp );
}
# else by default the day of the year link was clicked
# grab the dates from the url string
# and select all corresponding records to display
elseif( isset( $_GET['m'] ) != '' && isset( $_GET['y'] ) != '' && isset( $_GET['d'] ) != '' ){
  $DateTemp = strtotime( $_GET['y'].'-'.$_GET['m'].'-' . $_GET['d'] );
  $Month = date( 'm', $DateTemp );
  $Day = date( 'd', $DateTemp );
  $Year = date( 'Y', $DateTemp );
}
# else the default is the curent date
else{
  $Month = date( 'm', $Time );
  $Day = date( 'd', $Time );
  $Year = date( 'Y', $Time );
}
$Date = $Year.'-'.$Month.'-'.$Day;
$date_link_string = 'm='.$Month.'&d='.$Day.'&y='.$Year;

$Today = date( 'Y-m-d', date( $Time ) );
$Weekday = date( 'l', strtotime( $Today ) );
$DefaultDateDisplay = date( 'l, F j, Y', strtotime( $Today ) );
//End - current month and year to display on little calendar

	$ClickedDateDisplay = date( 'l, F j, Y', strtotime( $get_date ) );
	$Weekday = date( 'l', strtotime( $get_date ) );
	$schedule = get_schedule( $get_date, $Weekday );
	$schedule_box = '<div id="schedule_box">';
	$schedule_box .= '<p class="display_date">'. $ClickedDateDisplay . '</p>';
	$schedule_box .= '<p class="display_schedule">'.$schedule.'</p>';
	$schedule_box .= '</div>';

# Display the calendar
$ssCal = new ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 1, $DayLinks = 1 );
$content_two .= $ssCal->printCalendar();


?>
<script>
function showContent( str, file, divId ){

	$fileName = "http://library.miami.edu/wp-content/themes/umiami/" + file;

	if( str == "" ){
		document.getElementById(divId).innerHTML="";
		return;
	}

	if( window.XMLHttpRequest ){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}else{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
	}

	xmlhttp.onreadystatechange = function(){
		if( xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
			document.getElementById(divId).innerHTML=xmlhttp.responseText;
		}
	}

	xmlhttp.open( "GET", $fileName+"?q="+str, true);
	xmlhttp.send();

}
</script>
<style>
#SmCurrentDayCell {background: #CCC;}
</style>

<?php the_post(); ?>

<div class="pure-g">

  <div class="pure-u-1">
     <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="pure-g">
    <div class="breather libraries-container">
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
            <a href="/architecture/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/architecture_lib.jpg" alt="Architecture Library" title="Architecture Library" /></a>
            <p><a href="/architecture/hours/">Architecture</a></p>
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
             <a href="/business/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" alt="Business Library" title="Business Library" /></a>
            <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" align="left" alt="Business Library" title="Business Library" /></a>-->
            <p><a href="/business/hours/">Business</a></p>
            <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html">Business</a>-->
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
            <a href="/rsmaslib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/rsmas.jpg" alt="Marine Library" title="Marine Library" /></a>
            <p><a href="/rsmaslib/hours/">Marine</a></p>
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
           <a href="/musiclib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/music_lib.jpg" alt="Music Library" title="Music Library" /></a>
            <p><a href="/musiclib/hours/">Music</a></p> 
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
             <a href="/chc/hoursdirections/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/chc_icon.jpg" alt="Cuban Heritage Coll." title="Cuban Heritage Coll." /></a>
            <p><a href="/chc/hoursdirections/">Cuban Heritage Coll.</a></p>
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
            <a href="/specialcollections/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/speccoll_icon.jpg" alt="Special Collections" title="Special Collections"/></a>
            <p><a href="/specialcollections/hours/">Special Collections</a></p>
        </div>
        <div class="pure-u-1-2 pure-u-sm-1-4 pure-u-md-1-5 pure-u-lg-1-8">
            <a href="/universityarchives/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/universityarchives_icon.jpg" alt="University Archives" title="University Archives"  /></a>
            <p><a href="/universityarchives/hours/">University Archives</a></p>
        </div>
    </div>
  </div>


   <!--main content-->
    <div class="pure-u-1">
      <div class="breather track_me_Page_Click">
        <h2>Richter Library</h2>
         
         <div id="page_lvl_tabs">
            <ul>
                <li class="active"><a href="#tabs-1" rel="tab-1">This Week's Hours</a></li>
                <li><a href="#tabs-2" rel="tab-2">Upcoming Hours</a></li>
                <li><a href="#tabs-3" rel="tab-3">Exceptions</a></li>
                <li><a href="http://library.miami.edu/wp-content/uploads/2011/09/RichterHoursCalendarView.pdf" target="_blank">Printable Hours (.pdf)</a></li>
            </ul>
            
            <div class="tab-1 breather">
                <br />
                <?php print $schedule7; ?>                
                <p><strong>*NOTE: The library stacks tower closes one hour before the overall library closing (1AM Sun-Thurs, 9PM Fri-Sat).</strong></p>
            </div>

            <div class="tab-2 breather" style="display: none;">
              <br />
              <table style="border: none;">
                <tr>
                  <td class="calitem">                  
                    <div id="txtHint"><strong><?php print $schedule_box; ?></strong></div>
                  </td>
                  <td class="calitem"><div id="txtCal"><?php print $content_two; ?></div></td>
                </tr>
              </table>
            </div>

            <div class="tab-3 breather" style="display: none;">
              <p><strong>Exceptions to the Richter Library Building Hours<br />Fall 2014
              </strong></p>
                  <table class="form_listing" style="background-color: #FFF;">
                    <tr class="even">
                      <td class="time-entry"><strong>Day</strong></td>
                      <td class="time-entry"><strong>Library Hours</strong></td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 21 (Fri)</td>
                      <td class="time-entry">7:30 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 22 (Sat)</td>
                      <td class="time-entry">9:00 a.m. – 6 .p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 23 (Sun)</td>
                      <td class="time-entry">Noon – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 24 (Mon) – Nov. 25 (Tue)</td>
                     <td class="time-entry">7:30 a.m. – 9 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 26 (Wed)</td>
                      <td class="time-entry">7:30 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 27 (Thu) (Thanksgiving)</td>
                      <td class="time-entry">CLOSED</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 28 (Fri)</td>
                      <td class="time-entry">9 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 29 (Sat)</td>
                      <td class="time-entry">9 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Nov. 30 (Sun) – Dec. 17 (Wed)</td>
                      <td class="time-entry">24 hours <br/>( 9 a.m. Nov. 30 – 9 p.m. Dec. 17)</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Dec. 18 (Thu) – Dec. 23 (Tue)</td>
                     <td class="time-entry">Thu: 7:30 a.m. – 9 p.m.<br />
                        Fri: 7:30 a.m. – 6 p.m.<br />
                        Sat: 9 a.m. – 6 p.m.<br />
                        Sun: noon – 6 p.m.<br />
                        Mon-Tue: 7:30 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Dec. 24 (Wed) – Dec. 26 (Fri)</td>
                      <td class="time-entry">CLOSED</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Dec. 27 (Sat) – Dec. 30 (Tue)</td>
                      <td class="time-entry">Sat: 9 a.m. – 6 p.m.<br />
                        Sun: noon – 6 p.m.<br />
                        Mon-Tue: 7:30 a.m. – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Dec. 31 (Wed) – Jan. 1 (Thu)</td>
                      <td class="time-entry">CLOSED</td>
                    </tr>
                  </table>

                  <p><strong>Spring 2015</strong></p>
                  <table class="form_listing" style="background-color: #FFF;">
                    <tr class="even">
                      <td class="time-entry"><strong>Day</strong></td>
                      <td class="time-entry"><strong>Library Hours</strong></td>
                    </tr>
                    <tr>
                      <td class="time-entry">Jan. 2 (Fri) – Jan. 11 (Sun)</td>
                      <td class="time-entry">Mon-Thu: 7:30 a.m. – 9 p.m.<br />
                        Fri: 7:30 a.m. – 6 p.m.<br />
                        Sat: 9 a.m. – 6 p.m.<br />
                        Sun: Noon – 6 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Jan. 19 (Mon) (MLK)</td>
                      <td class="time-entry">1 p.m. – 9 p.m.</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Mar. 7 (Sat) – Mar. 15 (Sun)</td>
                      <td class="time-entry">Mon-Thu: 7:30 a.m. – 9 p.m.<br />
                        Fri: 7:30 a.m. – 6 p.m.<br />
                        Sat: 9 a.m. – 6 p.m.<br />
                        Sun: Noon – 6 p.m. (May 8)<br />
                        Noon – 9 p.m. (May 15)</td>
                    </tr>
                    <tr>
                      <td class="time-entry">Apr. 19 (Sun) – May 6 (Wed)</td>
                      <td class="time-entry">24 hours (9 a.m. Apr 19 – 9 p.m. May 6)</td>
                    </tr>
                    <tr>
                      <td class="time-entry">May 7 (Thu) – May 24 (Sun)</td>
                      <td class="time-entry">Mon-Thu:&nbsp; 7:30 a.m. – 9 p.m.<br />
                        Fri: 7:30 a.m. – 6 p.m.<br />
                        Sat: 9 a.m. – 6 p.m.<br />
                        Sun: Noon – 6 p.m. (May 17)<br />
                        Noon – 9 p.m. (May 24)</td>
                    </tr>
                    <tr>
                      <td class="time-entry">May 25 (Mon)</td>
                      <td class="time-entry">CLOSED</td>
                    </tr>
                    <tr>
                      <td class="time-entry">May 26 (Tue) – May 31 (Sun)</td>
                      <td class="time-entry">Tue-Thu: 7:30 a.m. – 9 p.m.<br />
                        Fri: 7:30 a.m. – 6 p.m.<br />
                        Sat: 9 a.m. – 6 p.m.<br />
                        Sun: Noon – 9 p.m.</td>
                    </tr>
                  </table>
              </div>

         </div><!--end tabs area-->

        <div class="pure-g">
            <div class="pure-u-1 pure-u-md-1-2">
                <div class="breather">
                <h2>Branch Libraries</h2>
                    <table class="item_listing hours-listing" width="100%">
                      <tr class="even">
                        <td class="lib">
                        Architecture Library</td>
                        <td class="lib-item">
                          <a href="/architecture/hours/">View</a>
                      </td>
                      </tr>
                      <tr class="odd">
                        <td class="lib">Business Library</td>
                        <td class="lib-item"><a href="http://library.miami.edu/business/hours/">View</a></td>
                      </tr>
                      <tr class="even">
                        <td class="lib">Marine Library</td>
                        <td class="lib-item"><a href="/rsmaslib/hours/">View</a></td>
                      </tr>
                      <tr class="odd">
                        <td class="lib">Music Library</td>
                        <td class="lib-item"><a href="/musiclib/hours/">View</a></td>
                      </tr>
                    </table>
                </div>
            </div>
            <div class="pure-u-1 pure-u-md-1-2">
                <div class="breather">
                <h2>Collections</h2>
                    <table class="item_listing hours-listing" width="100%">
                      <tr class="even">
                        <td class="lib">Cuban Heritage Collection</td>
                        <td class="lib-item"><a href="/chc/hoursdirections/">View</a></td>
                      </tr>
                      <tr class="odd">
                        <td class="lib">Special Collections</td>
                        <td class="lib-item"><a href="/specialcollections/hours/">View</a></td>
                      </tr>
                      <tr class="even">
                        <td class="lib">University Archives</td>
                        <td class="lib-item"><a href="/universityarchives/hours/">View</a></td>
                      </tr>
                    </table>
                </div>
            </div>
        </div>
         

     </div>
    </div><!--end main content-->    

</div><!-- .pure-g -->

<?php /*echo date('l jS \of F Y h:i:s A');*/  get_footer(); ?>
