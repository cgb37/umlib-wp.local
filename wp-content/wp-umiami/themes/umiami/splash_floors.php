<?php
/**
 * Template Name: Splash Floor Plans (Real Nov 2014)
 * The template for displaying the floor plans
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

function getMapLetters($table, $selected = "A", $numbers = 1, $abc_link='', $size='normal', $showsearch = 0, $introtext = '', $special = '') {

  //$selected = scrubData($selected);

  if ($size == "normal") {
    $alphabet = "<div id=\"letterhead\" align=\"center\">";
  } else {
    $alphabet = "<div id=\"letterhead_small\" align=\"center\">";
  }

  if ($introtext != "") {
    $alphabet .= "<span style=\"font-weight: bold;margin-right: .5em;font-size: larger;\">$introtext</span>";
  }

  foreach ($table as $value) {
    if ($value == $selected) {
      $alphabet .= "<span id=\"selected_letter\">$value</span> ";
    } else {
      $alphabet .= "<a href=\"$abc_link$value\">$value</a>";
    }
  }

  if ($showsearch != 0) {
    $alphabet .= "<input type=\"text\" id=\"letterhead_suggest\" size=\"30\"  />
        ";
  }

  if ($special == "floormap") {
    $alphabet .= "<select class=\"jumper\">
        <option value=\"\">-- Take me to --</option>
        <option value=\"?floor=3&visible=admin\">Administration</option>
        <option value=\"?floor=8&visible=info\">Archives</option>
        <option value=\"?floor=1&visible=audiobooks\">Audiobooks</option>
        <option value=\"?floor=1&visible=bestsellers\">Bestsellers</option>
        <option value=\"?floor=1&visible=charging\">Charging Station</option>
        <option value=\"?floor=2&visible=chc\">Cuban Heritage Collection</option>
        <option value=\"?floor=1&visible=circ_desk\">Circulation Desk</option>
        <option value=\"?floor=1&visible=dml\">Digital Media Lab</option>
        <option value=\"?floor=3&visible=eo\">Education &amp; Outreach</option>
        <option value=\"?floor=3&visible=exploratory\">Faculty Exploratory</option>
        <option value=\"?floor=2&visible=faculty_reading\">Faculty Reading Room</option>
        <option value=\"?floor=1&visible=graphic\">Graphic Novels</option>
        <option value=\"?floor=2&visible=grad_study\">Graduate Study Rooms</option>
        <option value=\"?floor=1&visible=group\">Group Study (1st Floor)</option>
        <option value=\"?floor=2&visible=group\">Group Study (2nd Floor)</option>
        <option value=\"?floor=3&visible=hr\">Human Resources</option>
        <option value=\"?floor=1&visible=info_desk\">Information Desk</option>
        <option value=\"?floor=3&visible=infolit\">Information Literacy Lab</option>
        <option value=\"?floor=3&visible=ia\">Instructional Advancement</option>
        <option value=\"?floor=2&visible=journals\">Journals A-D1</option>
        <option value=\"?floor=1&visible=journals\">Journals D2-Z</option>
        <option value=\"?floor=3&visible=319\">Library Conference Room (343)</option>
        <option value=\"?floor=2&visible=map_collection\">Map Collection</option>
        <option value=\"?floor=3&visible=communications\">Marketing, Communication & Events</option>
        <option value=\"?floor=2&visible=microfiche\">Microfiche</option>
        <option value=\"?floor=2&visible=microfilm\">Microfilm</option>
        <option value=\"?floor=1&visible=new_books\">New Book Collection</option>
        <option value=\"?floor=2&visible=oversize\">Oversize Journals</option>
        <option value=\"?floor=1&visible=popmags\">Popular Magazines</option>
        <option value=\"?floor=1&visible=refstacks\">Reference Stacks</option>
        <option value=\"?floor=8&visible=info\">Special Collections</option>
        <option value=\"?floor=1&visible=seminar\">Seminar Room</option>
        <option value=\"?floor=1&visible=travel\">Travel Books</option>
        </select>";
  }

  $alphabet .= "</div>";

  return $alphabet;
}

function outputFloor($selected_floor) {
  print "<img src=\"" . get_bloginfo('stylesheet_directory') . "/images/floors/" . $selected_floor . "\" usemap=\"#floor_map\" id=\"ourmap\" />";
}
?>
<div class="container_12">

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="grid_12">
    <br />
    <div class="breather">
      <?php
      // $letters = array("1st Floor", "2nd Floor", "Mezzanine", "3rd Floor", "4th Floor", "5th Floor", "6th Floor", "7th Floor", "8th Floor", "9th Floor");
      $letters = array("1", "2", "M", "3", "4", "5", "6", "7", "8", "9");
      $url_path = "?floor=";
      //$letters = range('A', 'Z');

      $alphabet = getMapLetters($letters, $_GET["floor"], 0, $url_path, 'normal', 0, 'Floor: ', "floormap");
      print $alphabet;

      // Choose our floor image
      if (!isset($_GET["floor"])) {
        $_GET["floor"] = "1";
      }

      switch ($_GET["floor"]) {
        case "1":
          ?>

          <map name="floor_map" id="floor_map">
            <area shape="rect" coords="605,47,876,174" href="journals" alt="" id="p-journals" />
            <area shape="rect" coords="570,149,589,174" href="audiobooks" alt="" id="p-audiobooks" />
            <area shape="rect" coords="539,41,589,150" href="dvds" alt="" id="p-dvds" />
            <area shape="rect" coords="478,56,521,82" href="bestsellers" alt=""  id="p-bestsellers" />
            <!--<area shape="rect" coords="343,12,369,41" href="newspapers" alt=""  id="p-newspapers" />-->

            <area shape="rect" coords="343,189,369,220" href="newspapers" alt=""  id="p-newspapers" />
            <area shape="rect" coords="343,113,369,186" href="new_books" alt="" id="p-new_books" />
            <area shape="rect" coords="343,58,369,112" href="graphic_novels" alt="" id="p-graphic" />
            <area shape="rect" coords="343,14,369,57" href="travel" alt="" id="p-travel" />

            <area shape="rect" coords="343,82,369,113" href="popular_magazines" alt="" id="p-popmags" />
            <!--
            <area shape="rect" coords="343,41,369,82" href="travel" alt="" id="p-travel" />
            <area shape="rect" coords="343,113,369,186" href="graphic_novels" alt="" id="p-graphic" />
            <area shape="rect" coords="343,186,369,301" href="new_books" alt="" id="p-new_books" />-->
            <area shape="rect" coords="530,194,680,255" href="dml" alt="" id="p-dml" />
            <area shape="rect" coords="680,194,761,255" href="seminar" alt="" id="p-seminar" />
            <area shape="rect" coords="637,255,800,301" href="group_study" alt="" id="p-group" />
            <area shape="rect" coords="778,348,876,560" href="ref_stacks" alt="" id="p-refstacks" />
            <area shape="rect" coords="416,403,702,492" href="information_commons" alt="" id="p-info_commons" />
            <area shape="rect" coords="194,375,327,485" href="information_desk" alt="" id="p-info_desk" />
            <area shape="rect" coords="48,312,150,384" href="circulation_desk" alt="" id="p-circ_desk" />
            <!--<area shape="rect" coords="170,255,222,312" href="" alt="Elevator" id="p-elevator" />-->
            <area shape="rect" coords="380,390,739,502" href="javascript:;" alt="" />
            <area shape="rect" coords="643,519,680,554" href="printer" alt="" id="p-printer" />
            <area shape="rect" coords="545,519,582,554" href="printer" alt="" id="p-printer" />
            <area shape="rect" coords="443,519,481,554" href="printer" alt="" id="p-printer" />
            <area shape="rect" coords="345,519,380,554" href="printer" alt="" id="p-printer" />
            <area shape="rect" coords="443,52,474,82" href="charging-station" alt="" id="p-charging" />
          </map>

          <div id="elevator" style="margin-top: 200px; margin-left: 200px;" class="floor">
            Looking for an elevator to the stacks?  Take this one to the second floor and then follow the signs leading right.
          </div>
          <div id="charging"  style="margin-top: 90px; margin-left: 390px;" class="floor"><h2>Charging Station</h2>
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/charging.jpg"; ?>" style="float:left;margin-right: 1em;"  /> Computer or phone low on power? Check out a key from the circulation desk for your own charging station. Good for 3 hours.
          </div>
          <div id="journals" class="floor" style="margin-top: 170px; margin-left: 600px;"><h2>Journals D2-Z</h2>
            Bound journals--we also have many more <a href="http://mt7kx4ww9u.search.serialssolutions.com/">journals available online</a>.  The rest of the bound journals
            are on the <a href="?floor=2&visible=journals">Second floor</a>.

            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/1_journals_img.jpg"; ?>"  />
          </div>
          <div id="audiobooks" class="floor" style="margin-top: 180px; margin-left: 300px;"><h2>Audiobooks</h2>
            Browse our audiobook collection.  You can also search for audiobooks in the <a href="http://catalog.library.miami.edu">catalog</a>, or use our <a href="http://miami.lib.overdrive.com/">Overdrive service</a> to download them to your device of choice!
          </div>
          <div id="dvds" class="floor" style="margin-top: 180px; margin-left: 300px;"><h2>DVDs</h2>
            Browse our thousands of DVDs – organized by genre and available for 7-day checkout. You can browse from home with
             <a href="http://library.miami.edu/udvd/">UDVD</a>.
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/dvds.jpg"; ?>"  />
          </div>
          <div id="bestsellers" class="floor" style="margin-top: 90px; margin-left: 390px;"><h2>Bestsellers</h2>
            Popular series and authors from all genres. Check out our <a href="http://miami.lib.overdrive.com/">downloadable collection</a> too.
          </div>
          <div id="newspapers" class="floor" style="margin-top: 20px; margin-left: 390px;"><h2>Newspapers</h2>
            A collection of print newspapers.  Many other newspapers are <a href="http://library.miami.edu/sp/subjects/databases.php?letter=bytype&type=News_and_Newspapers">available online</a>.
          </div>
          <div id="travel" class="floor" style="margin-top: 50px; margin-left: 390px;"><h2>Travel</h2>
            Guides to the sights both local and worldwide.
          </div>
          <div id="popmags" class="floor" style="margin-top: 90px; margin-left: 390px;"><h2>Popular Magazines</h2>
            The latest issues for browsing and covering your face as you nap.
          </div>
          <div id="graphic" class="floor" style="margin-top: 115px; margin-left: 390px;"><h2>Graphic Novels</h2>
            From Maus to Batman, Death Note to Fables: a full range of graphic story-telling.
            <iframe  width="300" height="169" src="http://www.youtube.com/embed/nHlw8k8oF50" frameborder="0" allowfullscreen></iframe>
          </div>
          <div id="new_books" class="floor" style="margin-top: 195px; margin-left: 390px;"><h2>New Books</h2>
            Be the first to check out the new arrivals to Richter Library! All genre of books are on display and can be checked out for 3 weeks.
            You can also see our list of <a href="http://library.miami.edu/sp/subjects/new_acquisitions.php">New Acquisitions</a>.
          </div>
          <div id="dml" class="floor" style="margin-top: 270px; margin-left: 440px;"><h2>Digital Media Services</h2>
            Home to the <a href="http://library.miami.edu/medialab/">Digital Media Lab</a>.
          </div>
          <div id="seminar" class="floor" style="margin-top: 260px; margin-left: 580px;"><h2>Seminar Room</h2>
            Occasionally booked for small classes, but otherwise available for quiet computer work.
          </div>
          <div id="group" style="margin-top: 300px; margin-left: 500px;" class="floor">
            <h2>Group Study</h2>
            <a href="http://libcal.miami.edu/booking/richter-study">Check availability and reserve a room</a> (requires registration for first use).  Room 121 is sometimes reserved
            for use by the <a href="http://www.as.miami.edu/writingcenter/location">Writing Center</a>.
          </div>
          <div id="refstacks" class="floor" style="margin-top: 400px; margin-left: 420px;"><h2>Reference Stacks</h2>
            Dictionaries, encyclopedias, guides and handbooks. Facts at your fingertips.
          </div>
          <div id="printer" class="floor" style="margin-top: 400px; margin-left: 420px;"><h2>Printers</h2>
            Problem with your print job?  Ask at the Information Desk.
            Question about the UPrint service?  <a href="http://www.miami.edu/finance/index.php/document_services_solutions/uprint/frequently_asked_questions_faq/">See the FAQ.</a>
          </div>
          <div id="info_commons" class="floor" style="margin-top: 270px; margin-left: 400px;"><h2>Information Commons</h2>
            You can find computers, scanners and printers in the Information Commons.  Need help?  Check with the Information Desk.
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/info_commons.jpg"; ?>"  />
          </div>

          <div id="info_desk" class="floor" style="margin-top: 220px; margin-left: 330px;width: 400px;"><h2>Information Desk</h2>
            <div style="float:left;width: 50%"><strong>Need help?</strong>  Stop by the Information desk.</div>
            <div style="float:left;width: 45%">tel: 305-284-4722<br />
              text: 305-809-7770<br />
              richterreference@miami.edu
            </div>
            <iframe src="http://player.vimeo.com/video/45460938" frameborder="0" width="375" height="211"></iframe>
          </div>

          <div id="circ_desk" class="floor" style="margin-top: 300px; margin-left: 170px;"><h2>Circulation & Reserves Desk</h2>
            Check out items here with your Cane Card, including books, media items + course reserves – but we also have MAC chargers, calculators, markers, flash drives and more. Visit our <a href="http://library.miami.edu/borrowing/">Access & Borrowing</a> page.
          </div>

          <?php
          print outputFloor("1_floor2014.png");
          $call_range = "Journals D2 - P (1980-), Journals Q - Z (2000-)";
          break;
        case "2":
          ?>
          <map name="floor_map" id="floor_map">
            <area shape="rect" coords="766,42,900,389" href="http://library.miami.edu/chc/" alt="" id="p-chc" />
            <area shape="rect" coords="443,235,471,289" href="" alt="" id="p-microfiche" />
            <area shape="rect" coords="329,235,389,289" href="" alt="" id="p-microfilm" />
            <area shape="rect" coords="116,235,318,289" href="" alt="" id="p-journals" />
            <area shape="rect" coords="694,112,742,209" href="http://dmschedule.library.miami.edu/roschedule.php?scheduleid=sc14a71c7fa266e5" alt="" id="p-group" />
            <area shape="rect" coords="336,112,374,201" href="http://dmschedule.library.miami.edu/roschedule.php?scheduleid=sc14a71c7fa266e5" alt="" id="p-group" />
            <area shape="rect" coords="204,134,243,215" href="http://dmschedule.library.miami.edu/roschedule.php?scheduleid=sc14a71c7fa266e5" alt="" id="p-group" />
            <area shape="rect" coords="104,134,142,215" href="http://dmschedule.library.miami.edu/roschedule.php?scheduleid=sc14a71c7fa266e5" alt="" id="p-group" />
            <area shape="rect" coords="44,147,89,209" href="" alt="" id="p-oversize_journals" />
            <area shape="rect" coords="374,60,594,82" href="" alt="" id="p-map_collection" />
            <area shape="rect" coords="374,8,742,51" href="" alt="http://library.miami.edu/rooms-spaces/faculty-reading-room/" id="p-faculty_reading" />
            <area shape="rect" coords="6,8,297,112" href="http://library.miami.edu/graduate-study/" alt="" id="p-grad_study" />
          </map>

          <div id="microfiche" class="floor" style="margin-top: 310px; margin-left: 330px;width: 300px;"><h2>Microfiche Reading Area</h2>
            The library has an extensive collection of serials and monographs on microfilm and microfiche. 4 state-of-the art readers are available for use, and allow you to print, email or save the material to a flash drive.
          </div>
          <div id="chc" class="floor" style="margin-top: 120px; margin-left: 310px;width: 300px;"><h2>Cuban Heritage Collection</h2>
          Primary and secondary sources relating to Cuba and the Cuban diaspora from colonial times to the present.  <a href="http://library.miami.edu/chc/">Visit our website for more information.</a>
          <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/chc.jpg"; ?>"  />  
            </div>
          <div id="microfilm" class="floor" style="margin-top: 310px; margin-left: 260px;width: 300px;"><h2>Microfilm Collection</h2>
            The library has an extensive collection of serials and monographs on microfilm and microfiche. 4 state-of-the art readers are available for use, and allow you to print, email or save the material to a flash drive.
          </div>
          <div id="journals" class="floor" style="margin-top: 310px; margin-left: 80px;width: 200px;"><h2>Journals A - D1</h2>
            Bound journals--we also have many more <a href="http://mt7kx4ww9u.search.serialssolutions.com/">journals available online</a>.  The rest of the bound journals
            are on the <a href="?floor=1&visible=journals">First floor</a>.
          </div>
          <div id="group" class="floor" style="margin-top: 220px; margin-left: 330px;width: 300px;"><h2>Group Study Rooms</h2>
            <a href="http://libcal.miami.edu/booking/richter-study">Check availability and reserve a room</a> (requires registration for first use).
          </div>
          <div id="oversize_journals" class="floor" style="margin-top: 130px; margin-left: 130px;width: 200px;"><h2>Oversize Journals</h2>
            Journals larger than 30.8 centimeters high (or wider than 24 centimeters) are shelved in this separate section.
          </div>
          <div id="map_collection" class="floor" style="margin-top: 100px; margin-left: 330px;width: 300px;"><h2>Map Collection</h2>
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/map.jpg"; ?>" style="float:left;margin-right: 1em;"  />  Our collection includes many types of maps at a variety of scales covering Florida and the world.
          </div>
          <div id="faculty_reading" class="floor" style="margin-top: 70px; margin-left: 330px;width: 300px;"><h2>Faculty Reading Room</h2>
            The faculty Reading room is reserved for faculty and doctoral students, as a quiet area for individual study. Study carrels, several computers and office supplies are available as well as a small storage area for research materials.   <a href="http://library.miami.edu/rooms-spaces/faculty-reading-room/">More information.</a>
          </div>
          <div id="grad_study" class="floor" style="margin-top: 20px; margin-left: 330px;width: 300px;"><h2>Graduate Study Rooms</h2>
            Study rooms are available for registered UM graduate students based on the Gables campus. You can check out an individual, locking study room for a 6-hour period. Locker keys are also available for check-out at the main Circulation Desk.  <a href="http://library.miami.edu/graduate-study/">Please read the full FAQ.</a>
          </div>
          <?php
          print outputFloor("2_floor_topless.png");
          $call_range = "Journals A - D1, Oversize Journals A - Z";
          break;
        case "3":
          ?>
          <map name="floor_map" id="floor_map">
            <area shape="rect" coords="786,201,904,251" href="1" alt="" id="p-communications" />
            <area shape="rect" coords="586,114,664,162" href="2" alt="" id="p-hr" />
            <area shape="rect" coords="586,13,904,114" href="3" alt="" id="p-admin" />
            <area shape="rect" coords="435,303,904,407" href="4" alt="" id="p-eo" />
            <area shape="rect" coords="164,319,330,407" href="6" alt="" id="p-319" />
            <area shape="rect" coords="164,234,330,319" href="7" alt="" id="p-infolit" />
            <area shape="rect" coords="81,234,164,372" href="8" alt="" id="p-exploratory" />
            <area shape="rect" coords="81,48,205,162" href="9" alt="" id="p-ia" />
          </map>

          <div id="communications" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Communications, Marketing & Events</h2>
            Planning and development for library print and online news, publications, and events.  
            <a href="http://library.miami.edu/sp/subjects/staff.php?letter=By%20Department#141">Contact information.</a>
          </div>
          <div id="hr" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Human Resources</h2>
            Libraries employment and employee relations for students, staff, and faculty.
            <a href="http://library.miami.edu/sp/subjects/staff.php?letter=By%20Department#124">Contact information.</a>
          </div>
          <div id="admin" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Library Administration</h2>
            Offices of the <a href="http://library.miami.edu/sp/subjects/staff.php?letter=By%20Department#101">Dean and University Librarian</a> 
            and <a href="http://library.miami.edu/sp/subjects/staff.php?letter=By%20Department#102">financial administration</a>.
          </div>
          <div id="eo" class="floor" style="margin-top: 130px; margin-left: 130px;width: 400px;"><h2>Education & Outreach Offices</h2>
            The University of Miami Libraries Education and Outreach unit provides information and research assistance to library users, both on and off campus.
            <a href="http://library.miami.edu/sp/subjects/staff.php?letter=By%20Department#118">Contact information.</a>
          </div>
          <div id="319" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Library Conference Room (343)</h2>
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/conference_room.jpg"; ?>"  />
          </div>
          <div id="infolit" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Information Literacy Lab</h2>
            A computer lab designed for library instruction.
            <img src="<?php print bloginfo('stylesheet_directory') . "/images/floors/lit_lab.jpg"; ?>"  />
          </div>
          <div id="exploratory" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>Faculty Exploratory</h2>
            An instruction room set aside for small faculty-only classes.
          </div>
          <div id="ia" class="floor" style="margin-top: 130px; margin-left: 130px;width: 300px;"><h2>University Instructional Advancement</h2>
            The Instructional Advancement Center is not affiliated with the library; <a href="http://www.miami.edu/it/index.php/iac">visit their website</a>.
          </div>



          <?php
          print outputFloor("3_floor_topless.png");
          $call_range = "";
          break;
        case "4":
          print outputFloor("4_floor.png");
          $call_range = "PQ7298 - PZ, Q - QG";
          break;
        case "5":
          print outputFloor("5_floor.png");
          $call_range = "JV7000-JZ, K, L, N, P - PQ7297";
          break;
        case "6":
          print outputFloor("6_floor.png");
          $call_range = "G, H, J - JV6999";
          break;
        case "7":
          print outputFloor("7_floor.png");
          $call_range = "BF311.P - E, F1 - f2199";
          break;
        case "8":
          
          $_GET["visible"] = "8info";
          ?>
          <map name="floor_map" id="floor_map">
            <area shape="rect" coords="310,336,457,408" href="info" alt="" id="p-8info" />
            
            </map>
          
          <div id="8info" class="floor" style="margin-top: 50px; margin-left: 190px;width: 500px"><h2>Special Collections & Archives</h2>
          <p>Special Collections preserves unique and valuable research materials, specializing in the histories of South Florida, the Caribbean, African-American experience, book arts, and much more. 
          Due to the nature of the collections, materials may be used only in the Special Collections Reading Room during our regular hours.</p>
          <p>The University Archives holds organizational records, photographs, clippings, scrapbooks, and other materials concerning many UM academic and administrative units.</p>
          </div>
          <?php 
          print outputFloor("8_floor.png");
          break;
        case "9":
          print outputFloor("9_floor.png");
          $call_range = "B-BF311.O, R - T";
          break;
        case "M":
          print outputFloor("mezzanine.png");
          $call_range = "A, U – Z";
          break;
      }

      //$our_floor = "<img src=\"" . get_bloginfo('stylesheet_directory') . "/images/floors/" . $selected_floor . "\" usemap=\"#floor_map\" id=\"ourmap\" />";
      ?>


      <?php  
      if (isset($call_range) && $call_range != "") {
        print "<div style=\"position: relative; top: -70px; left: 170px; color: #7E7D77; font-size: 14pt;\">
        Call Number Range:<br /> 
        <span style=\"font-size: 22pt !important;margin-bottom: 1em;color: #E0752F\">$call_range</span></div>";  
        }
      ?>
    </div>
  </div>

</div><!-- .container_12 -->

<?php get_footer(); ?>

<script type="text/javascript" language="javascript">
  $(document).ready(function(){

    var requested = '<?php print $_GET["visible"]; ?>'; // use to pop up item on page load

    if (requested.length > 0) {
      var holder = 'div[id=' + requested + ']';
      $(holder).stop().fadeTo('fast', 1).show();

    }

    function addFloorza(){
      var our_id = $(this).attr("id").split("-");
      var holder = 'div[id=' + our_id[1] + ']';
      $(".floor").hide();
      $(holder).stop().fadeTo('fast', 1).show();
      return;

    }

    function removeFloorza(){

      //$("div[id*=floor]").hide();
      //$(".floor").hide();
    }

    var floorzaConfig = {
      interval: 50,
      sensitivity: 4,
      over: addFloorza,
      timeout: 100,
      out: removeFloorza
    };

    $("area[id*=p-]").hoverIntent(floorzaConfig);

    // end hover //

    // Make it so clicking on the image will make the popover disappear
    $("#ourmap, .floor h2").click(function(){$(".floor").hide();})

    $("area").click(function() {return false;})

  });
</script>
<!--david testing-->