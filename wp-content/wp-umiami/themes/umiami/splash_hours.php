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


<div class="container_12 track_me_Page_Click">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>
  <br style="clear:both;" />
  <div class="grid_12">
    <!--<div class="libraries_header">
      <img class="lib_pix" src="<?php //bloginfo('stylesheet_directory'); ?>/images/richter_lib.jpg" align="left" alt="Richter Library" title="Richter Library"  />
      Richter (main)
    </div>-->

    <div class="libraries_header" style="padding-left: 1.5em;">
      <a href="/architecture/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/architecture_lib.jpg" align="left" alt="Architecture Library" title="Architecture Library" /></a>
      <a href="/architecture/hours/">Architecture</a>
    </div>

    <div class="libraries_header">
      <a href="/business/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" align="left" alt="Business Library" title="Business Library" /></a>
      <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" align="left" alt="Business Library" title="Business Library" /></a>-->
      <a href="/business/hours/">Business</a>
      <!--<a href="http://www.bus.miami.edu/research-library/hours-services/index.html">Business</a>-->
    </div>

        <div class="libraries_header">
      <a href="/rsmaslib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/rsmas.jpg" align="left" alt="Marine Library" title="Marine Library" /></a>
      <a href="/rsmaslib/hours/">Marine</a>
    </div>

        <div class="libraries_header">
      <a href="/musiclib/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/music_lib.jpg" align="left" alt="Music Library" title="Music Library" /></a>
      <a href="/musiclib/hours/">Music</a>
    </div>

        <div class="libraries_header">
      <a href="/chc/hoursdirections/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/chc_icon.jpg" align="left" alt="Cuban Heritage Coll." title="Cuban Heritage Coll." /></a>
      <a href="/chc/hoursdirections/">Cuban Heritage Coll.</a>
    </div>

        <div class="libraries_header">
      <a href="/specialcollections/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/speccoll_icon.jpg" align="left" alt="Special Collections" title="Special Collections"/></a>
      <a href="/specialcollections/hours/">Special Collections</a>
    </div>
    <div class="libraries_header">
      <a href="/universityarchives/hours/"><img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/universityarchives_icon.jpg" align="left" alt="University Archives" title="University Archives"  /></a>
      <a href="/universityarchives/hours/">University Archives</a>
    </div>


    <br style="clear:both;" />
    <h2>Richter Library</h2>

    <div id="page_lvl_tabs" style="width: 750px;">
      <ul>
        <li class="active"><a href="#tabs-1" rel="tab-1">This Week's Hours</a></li>
        <li><a href="#tabs-2" rel="tab-2">Upcoming Hours</a></li>
        <li><a href="#tabs-3" rel="tab-3">Exceptions</a></li>
        <li><a target="_blank" href="http://library.miami.edu/wp-content/uploads/2011/09/RichterHoursCalendarView.pdf">Printable Hours (.pdf)</a></li>
      </ul>
      <div class="tab-1 breather">
        <br />
        <?php print $schedule7; ?>
        <br />
        <strong>*NOTE: The library stacks tower closes one hour before the overall library closing (1AM Sun-Thurs, 9PM Fri-Sat).  </strong>
      </div>
      <div class="tab-2 breather" style="display: none;">
        <br />
        <table style="border: none;">
          <tr>
            <td width="200" style="background-color: #fff; padding: 0 1em; margin-top: 2em;"><br /><strong><div id="txtHint"><?php print $schedule_box; ?></div></strong></td>
            <td><div id="txtCal"><?php print $content_two; ?></div></td>
          </tr>
        </table>


        <br />


      </div>
      <div class="tab-3 breather" style="display: none;">
        <p><strong>Exceptions to the Richter Library Building Hours<br />Fall 2014
        </strong></p>
<table class="item_listing" width="600" border="0" cellspacing="0" cellpadding="0">
  <tr class="even">
    <td align="left" valign="top"><p>Day</p></td>
    <td align="left" valign="top"><p>Library Hours</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 21 (Fri)</p></td>
    <td align="left" valign="top"><p>7:30 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 22 (Sat)</p></td>
    <td align="left" valign="top"><p>9:00 a.m. – 6 .p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 23 (Sun)</p></td>
    <td align="left" valign="top"><p>Noon – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 24 (Mon) – Nov. 25 (Tue)</p></td>
    <td align="left" valign="top"><p>7:30 a.m. – 9 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 26 (Wed)</p></td>
    <td align="left" valign="top"><p>7:30 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 27 (Thu) (Thanksgiving)</p></td>
    <td align="left" valign="top"><p>CLOSED</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 28 (Fri)</p></td>
    <td align="left" valign="top"><p>9 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 29 (Sat)</p></td>
    <td align="left" valign="top"><p>9 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Nov. 30 (Sun) – Dec. 17 (Wed)</p></td>
    <td align="left" valign="top"><p>24 hours ( 9 a.m. Nov. 30 – 9    p.m.&nbsp; Dec. 17</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Dec. 18 (Thu) – Dec. 23 (Tue)</p></td>
    <td align="left" valign="top"><p>Thu: 7:30 a.m. – 9 p.m.<br />
      Fri: 7:30 a.m. – 6 p.m.<br />
      Sat: 9 a.m. – 6 p.m.<br />
      Sun: noon – 6 p.m.<br />
      Mon-Tue: 7:30 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Dec. 24 (Wed) – Dec. 26 (Fri)</p></td>
    <td align="left" valign="top"><p>CLOSED</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Dec. 27 (Sat) – Dec. 30 (Tue)</p></td>
    <td align="left" valign="top"><p>Sat: 9 a.m. – 6 p.m.<br />
      Sun: noon – 6 p.m.<br />
      Mon-Tue: 7:30 a.m. – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Dec. 31 (Wed) – Jan. 1 (Thu)</p></td>
    <td align="left" valign="top"><p>CLOSED</p></td>
  </tr>
</table>
<p><strong>Spring 2015</strong></p>
<table class="item_listing" width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><br />
      Day </td>
    <td align="left" valign="top"><p>Library Hours</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Jan. 2 (Fri) – Jan. 11 (Sun)</p></td>
    <td align="left" valign="top"><p>Mon-Thu:&nbsp; 7:30 a.m. – 9    p.m.<br />
      Fri: 7:30 a.m. – 6 p.m.<br />
      Sat: 9 a.m. – 6 p.m.<br />
      Sun: Noon – 6 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Jan. 19 (Mon) (MLK)</p></td>
    <td align="left" valign="top"><p>1 p.m. – 9 p.m.</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Mar. 7 (Sat) – Mar. 15 (Sun)</p></td>
    <td align="left" valign="top"><p>Mon-Thu:&nbsp; 7:30 a.m. – 9    p.m.<br />
      Fri: 7:30 a.m. – 6 p.m.<br />
      Sat: 9 a.m. – 6 p.m.<br />
      Sun: Noon – 6 p.m. (May 8)<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    :&nbsp; Noon – 9 p.m. (May 15)</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>Apr. 19 (Sun) – May 6 (Wed)</p></td>
    <td align="left" valign="top"><p>24 hours (9 a.m. Apr 19 – 9    p.m. May 6)</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>May 7 (Thu) – May 24 (Sun)</p></td>
    <td align="left" valign="top"><p>Mon-Thu:&nbsp; 7:30 a.m. – 9    p.m.<br />
      Fri: 7:30 a.m. – 6 p.m.<br />
      Sat: 9 a.m. – 6 p.m.<br />
      Sun: Noon – 6 p.m. (May 17)<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    : Noon – 9 p.m. (May 24)</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>May 25 (Mon)</p></td>
    <td align="left" valign="top"><p>CLOSED</p></td>
  </tr>
  <tr>
    <td align="left" valign="top"><p>May 26 (Tue) – May 31 (Sun)</p></td>
    <td align="left" valign="top"><p>Tue-Thu:&nbsp; 7:30 a.m. – 9    p.m.<br />
      Fri: 7:30 a.m. – 6 p.m.<br />
      Sat: 9 a.m. – 6 p.m.<br />
      Sun: Noon – 9 p.m.</p></td>
  </tr>
</table>
      </div>
    </div>

    <br /><br />

    <h2>Branch Libraries</h2>
    <table class="item_listing" width="450" border="0" cellspacing="0" cellpadding="0">
      <tr class="even">
        <td width="225">
        Architecture Library</td>
        <td width="225">
      <a href="/architecture/hours/">View</a>
      </td>
      </tr>
      <tr class="odd">
        <td> Business Library</td>
        <td><a href="http://library.miami.edu/business/hours/">View</a></td>
      </tr>
      <tr class="even">
        <td> Marine Library</td>
        <td><a href="/rsmaslib/hours/">View</a></td>
      </tr>
      <tr class="odd">
        <td> Music Library</td>
        <td><a href="/musiclib/hours/">View</a></td>
      </tr>
    </table>

    <br />
    <h2>Collections</h2>
    <table class="item_listing" width="450" border="0" cellspacing="0" cellpadding="0">
      <tr class="even">
        <td width="225"> Cuban Heritage Collection</td>
        <td width="225"><a href="/chc/hoursdirections/">View</a></td>
      </tr>
      <tr class="odd">
        <td> Special Collections</td>
        <td><a href="/specialcollections/hours/">View</a></td>
      </tr>
      <tr class="even">
        <td> University Archives</td>
        <td><a href="/universityarchives/hours/">View</a></td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
</div>


<?php /*echo date('l jS \of F Y h:i:s A');*/  get_footer(); ?>