<?php
/**
 * Template Name: Splash-Tour
 * The template for displaying the home page WITH TOUR!
 *
 * @package WordPress
 * @subpackage umiami
 * @since 
 */
get_header();

$bg_images = array(
    array(
        "title" => "Hotels along Biscayne Boulevard from Bayfront Park, Miami, Florida",
        "collection" => "South Florida Postcards",
        "collection_url" => "http://merrick.library.miami.edu/specialCollections/asm0299/",
        "link" => "http://merrick.library.miami.edu/u?/asm0299,601",
        "image" => "coral_gables.jpg"
    ),
    array(
        "title" => "Miami's International Airport, gateway to Latin American countries",
        "collection" => "South Florida Postcards",
        "collection_url" => "http://merrick.library.miami.edu/specialCollections/asm0299/",
        "link" => "http://merrick.library.miami.edu/u?/asm0299,595",
        "image" => "airport.jpg"
    ),
    array(
        "title" => "Conservation Lab",
        "collection" => "",
        "collection_url" => "",
        "link" => "",
        "image" => "preservation.jpg"
    ),
    array(
        "title" => "Liberty Hotel, Miami, Florida, opposite Bay Front Park ",
        "collection" => "South Florida Postcards",
        "collection_url" => "http://merrick.library.miami.edu/specialCollections/asm0299/",
        "link" => "http://merrick.library.miami.edu/u?/asm0299,882",
        "image" => "liberty_hotel.jpg"
    ),
    array(
        "title" => "Football Team (1926)",
        "collection" => "UM Historical Photographs",
        "collection_url" => "http://merrick.library.miami.edu/archives/uathletics/",
        "link" => "http://merrick.library.miami.edu/u?/umathletics,518",
        "image" => "football.jpg"
    ),
    array(
        "title" => "Digital Media Lab",
        "collection" => "",
        "collection_url" => "http://merrick.library.miami.edu/cdm4/results.php?CISOOP1=any&CISOFIELD1=CISOSEARCHALL&CISOROOT=/chc0364&CISOBOX1=Viewbooks",
        "link" => "/medialab/",
        "image" => "dml_students.jpg"
    )
);

if ($_GET["selected"]) {
  $bg_selected = mt_rand($_GET["selected"], $_GET["selected"]);
} else {
  $bg_selected = mt_rand(0, 5);
}


$our_bg = "/images/background/" . $bg_images[$bg_selected]["image"];


  
if ($bg_images[$bg_selected]["collection"] != "") {

  $bg_overlay_data = '<p><a href="' . $bg_images[$bg_selected]["link"] . '">Image</a> from <a href="' . $bg_images[$bg_selected]["collection_url"] . '">' . $bg_images[$bg_selected]["collection"]
          . '</a> <p>';
} else {
  
  // make sure there actually is a link
  if ($bg_images[$bg_selected]["link"] != "") {
    $main_link = '<a href="' . $bg_images[$bg_selected]["link"] . '">' . $bg_images[$bg_selected]["title"] . '</a>';
  } else {
    $main_link = $bg_images[$bg_selected]["title"];
  }
  
  $bg_overlay_data = "<p>$main_link</p>";
}


//$selected_bg = uml_setSplashBgImg();
//$our_bg = "/images/background/" . $selected_bg;
?>
<div id="indexbody" style="position: relative; display: block;z-index: 0;">
  <img src="<?php bloginfo('stylesheet_directory');
print $our_bg ?>" style="position: relative; display: block; width: 955px;" />
  <div id="searchbox">
    <div id="searchtabs">
      <ul>
        <li class="active"><a href="http://miami.summon.serialssolutions.com/" rel="tc-1">Articles+</a></li>
        <li><a href="http://catalog.library.miami.edu/" rel="tc-2">Catalog</a></li>
        <!--<li><a href="" rel="tc-3">UM Digital</a></li>-->
        <li><a href="<?php print PATH_TO_SP; ?>subjects/databases.php" rel="tc-3">Databases</a></li>
        <li><a href="/search/" rel="tc-4">Website</a></li>
      </ul>
    </div>
    <div id="searchbody">
      <div class="search-1">       
        <form action="http://miami.summon.serialssolutions.com/search" method="GET" id="summon_search">
          <input type="hidden" value="ContentType,Newspaper Article, true" name="s.fvf[]" />
          <input type="hidden" value="ContentType,Book Review, true" name="s.fvf[]" />
          <input type="hidden" value="ContentType,Trade Publication Article, true" name="s.fvf[]" />
          <input type="text" name="s.q" value="" rel="" class="searchinput-1 tour_7" size="40" />
          <input type="submit" value="Search" /> &nbsp;
        </form>
        <p class="search_blurb">Find articles, books &amp; more  &nbsp; &nbsp; <span class="label"><a href="http://library.miami.edu/search/summon/help.html">Help</a></span></p>
      </div>
      <div class="search-2" style="display: none;">
        <?php $search_bottom_text = '<a href="https://catalog.library.miami.edu/">Catalog Home</a>, '; ?>
        <form action="http://catalog.library.miami.edu/search/" method="get" name="search" id="search">
          <select name="searchtype" id="searchtype">
            <option value="X" selected="selected">Keyword</option>
            <option value="t">Title</option>
            <option value="a">Author</option>
            <option value="d">Subject</option>
            <option value="c">LC Call Number</option>
            <option value="l">Local Call Number</option>
            <option value="g">SuDocs Number</option>
            <option value="i">ISSN/ISBN Number</option>
            <option value="o">OCLC Number</option>
            <option value="m">Music Pub. Number</option>
          </select>

          <input type="hidden" name="SORT" id="SORT" value="D" />
          <input maxlength="75" name="searcharg" class="searchinput-2" size="17" />
          <input type="hidden" id="iiiFormHandle_1"/>
          <input name="Search" type="submit" id="Search" value="Search" />
        </form>
        <p class="search_blurb">Find books, music, dvds &amp; more &nbsp; &nbsp; <span class="label"><a href="http://catalog.library.miami.edu/search/X">Advanced</a></span></p>
      </div>
      <div class="search-3" style="display: none;">
        <?php
        $db_path = PATH_TO_SP . "subjects/databases.php?letter=";
        $letters = range('A', 'Z');
        $alphabet = getLetters($letters, $_GET["letter"], 0, $db_path, "small", 0);
        print $alphabet;
        ?>
        <form action="<?php print PATH_TO_SP; ?>/subjects/databases.php" method="post" style="margin-left: 1em;">
          <input type="text" id="letterhead_suggest" size="30" class="searchinput-3" name="searchterm" /> 
          <input type="submit" value="Search" />
        </form>
      </div>
      <div class="search-4" style="display: none;">
        <form id="head_search" action="<?php bloginfo('stylesheet_directory'); ?>/resolver.php" method="post">
          <input type="hidden" name="searchtype" value="website" />
          <input id="search_tabs" type="text"  value="" name="searchterms" class="searchinput-4" size="40" autocomplete="off" />
          <input type="submit" value="Search" name="submitsearch" />
        </form>
        <p class="search_blurb">Search the UM Libraries website</p>
      </div>

    </div>
    <div id="search_extralinks" class="search-1">See also <a href="http://mt7kx4ww9u.search.serialssolutions.com/">E-Journals</a>, <a href="http://mt7kx4ww9u.search.serialssolutions.com/?SS_Page=refiner&SS_RefinerEditable=yes">Citation Linker</a>, <a href="<?php print PATH_FROM_ROOT; ?>/search-tools-overview">All Search Tools</a></div>
    <div id="search_extralinks" class="search-2" style="display: none;">See also <a href="http://catalog.library.miami.edu/">Catalog Home</a>, <a href="/sp/subjects/new_acquisitions.php">New Acquisitions</a></div>
    <div id="search_extralinks" class="search-3" style="display: none;">See also <a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bysub">Database by Subject</a>, <a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bytype">Database by Format</a></div>
  </div>

  <div id="bg_info_overlay" class="tour_8"><?php print $bg_overlay_data; ?></div>
</div>

<div id="listland">
  <div id="quicko" class="list_feature" style="width: 320px; background-image: none;"><h3>Quick Links</h3>
    <form id="quick_links" name="quick_linker" action="<?php bloginfo('stylesheet_directory'); ?>/resolver.php" method="POST" >
      <select name="quick_links" id="quick_links_jump" class="tour_9">
        <option value=""> -- Popular Resources -- </option>
        <option value="/visitors/">Visitor Information</option>
        <option value="/reserve-a-room/">Reserve a Room</option>
        <option value="/sp/subjects/faq.php">FAQs</option>
        <option value="/sp/subjects/new_acquisitions.php">New Acquisitions</option>
        <option value=""> ---- </option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=aph">Academic Search Premier</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.epnet.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=buh">Business Source Premier</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.epnet.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=jlh">CINAHL Plus</option>
        <!--<option value="https://iiiprxy.library.miami.edu/login?url=http://iplogin.lynda.com">LyndaCampus</option>-->
        <option value="https://iiiprxy.library.miami.edu/login?url=http://go.galegroup.com/ps/i.do?id=GALE|2NYT&v=2.1&u=miami_richter&it=aboutJournal&p=AONE&sw=w">New York Times</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ebscohost&defaultdb=psyh">PsycInfo</option>
        <option value="http://etd.library.miami.edu/">UM Theses &amp; Dissertations</option>      
        <option value="https://iiiprxy.library.miami.edu/login?url=http://webofknowledge.com/WOS">Web of Science</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://newfirstsearch.oclc.org/dbname=WorldCat;done=referer;FSIP">WorldCat</option>
      </select>
      <input type="submit" id="quick_links_submit" value="Go!" />
    </form>
  </div>
  <div id="uniquo" class="list_feature tour_9a" style="width: 310px; background-image: none;"><h3>Unique @ UM</h3>
    <ul>
      <li><a href="http://library.miami.edu/chc/">Cuban Heritage Collection</a></li>
      <li><a href="http://library.miami.edu/specialcollections/">Special Collections</a></li>
      <li><a href="http://merrick.library.miami.edu/">UM Digital Collections</a></li>
      <li><a href="http://scholarlyrepository.miami.edu/">UM Scholarly Repository</a></li>
      <li><a href="http://library.miami.edu/universityarchives/">University Archives</a></li>
    </ul>
  </div>
<!--
  <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="/support-the-libraries/">Make a Gift</a></h3>
    <div id="gifto_promo">
      <a href="http://new.library.miami.edu/2012/01/04/um-acquires-orange-bowl-collection/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/orange_bowl_promotion.jpg" alt="Make a Gift to the Libraries" title="Make a Gift to the Libraries" class="staff_picture" /></a>
      <p><strong>Preserving the Orange Bowl</strong><br />
        The Orange Bowl Committee has donated its archives to the UM Libraries. <a href="http://new.library.miami.edu/2012/01/04/um-acquires-orange-bowl-collection/">Read on . . .</a></p>
    </div>
-->
  <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="/library-website-tour/" class="invoke_tour">Tour the New Site</a></h3>
    <div id="gifto_promo">
      <a href="/library-website-tour/" class="invoke_tour"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/take_a_trip.jpg" alt="Take a tour, find out more (image by flickr user drcw)" title="Take a tour, find out more" class="staff_picture" style="margin-top: 10px;" /></a>
    </div>
  </div>
  <div style="clear: both; float: left; background-color: #fff; padding: 5px 20px 5px 0px; margin-top: -25px;" id="news_events"  class="tour_9b">
    <h3 class="">
      <a href="feed/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss_17.png" style="position: relative; top: 4px; padding-right: 5px; margin-left: 10px;" alt="subscribe to RSS feed" title="subscribe to RSS feed" /></a> 
      <a href="news/" style="color: #333;">News &amp; Events</a> 
      <a class="prev" id="spotlight_controls_prev" href="#"><span>prev</span></a>
      <a class="next" id="spotlight_controls_next" href="#"><span>next</span></a>

    </h3>
  </div>
</div>
<ul>


  <div id="mini_features" class="text_carousel">

    <?php
    global $post;
    $args = array('numberposts' => 9, 'category' => 5);
    $myposts = get_posts($args);
    foreach ($myposts as $post) : setup_postdata($post);

      // check for image
      if (has_post_thumbnail()) {
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        $featured_image = $featured_image[0]; // because the previous sent result as array
      } else {

        $featured_image = get_stylesheet_directory_uri() . "/images/generic_news_item.jpg";
      }


      if (get_field("link_image_to")) {
        $linkie = get_field("link_image_to");
      } else {
        $linkie = get_permalink();
      }

      $item = "<div class=\"mini_feature\"><a href=\"" . $linkie . "\"><img src=\"" . $featured_image . "\" class=\"staff_picture\" alt=\"Image for News Item\" width=\"75\" height=\"75\" /></a>
              <h3><a href=\"" . $linkie . "\">";
      // Grab short form of title if it exists
      if (get_field("front_page_title")) {
        $item .= get_field("front_page_title");
      } else {
        $item .= get_the_title();
      }
      $item .= "</a></h3>";

      if (get_field("front_page_blurb")) {
        $item .= get_field("front_page_blurb");
      } else {
        $item .= "<a href=\"" . get_permalink() . "\">Read full news story . . .</a>";
      }
      $item .= "</div>";
      $our_news[] = $item;
      ?>

    <?php endforeach;
    wp_reset_postdata(); ?>  

    <?php
    $our_news = array_reverse($our_news);

    // loop through our array of news items
    foreach ($our_news as $item) {
      print $item;
    }
    ?>

  </div> <!--Closes Mini-Feature Text Carousel -->

  <?php get_footer(); ?>
<!-- THE TOUR! -->
<link rel="stylesheet" type="text/css" media="all" href="<?php print THEME_BASE_DIR; ?>/website_tour.css" />
<script type="text/javascript" src="<?php print THEME_BASE_DIR; ?>/js/jquery.easing.1.3.js"></script>
		<!-- The JavaScript -->

        <script type="text/javascript">
			  $(document).ready(function(){
				/*
				the json config obj.
				name: the class given to the element where you want the tooltip to appear
				bgcolor: the background color of the tooltip
				color: the color of the tooltip text
				text: the text inside the tooltip
				time: if automatic tour, then this is the time in ms for this step
				position: the position of the tip. Possible values are
					TL	top left
					TR  top right
					BL  bottom left
					BR  bottom right
					LT  left top
					LB  left bottom
					RT  right top
					RB  right bottom
					T   top
					R   right
					B   bottom
					L   left
				 */
				var config = [
					{
						"name" 		: "tour_1",
						"bgcolor"	: "#d8db9d",
						"color"		: "#333",
						"position"	: "T",
						"text"		: "You can find today's hours here.  Click to see hours for other days, or at the other libraries.",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_2",
						"text"		: "Click on Ask a Librarian to find different ways of asking reference questions.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_3",
						"text"		: "Have an idea about how we can improve library services?  Click on comments, and someone will respond in 1-2 business days.",
						"position"	: "TR",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_4",
						"text"		: "Choose 'Books,' 'Articles,' or 'CD/DVDs' for help searching for these item types.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_5",
						"text"		: "Hover your mouse over these categories to reveal more options.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_6",
						"text"		: "Log into your different library accounts here.  You can also find information personalized by patron type.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_7",
						"text"		: "Search for items here.  Choose a different search type (Articles+, Catalog, Databases, Website) to search different collections.",
						"position"	: "T",
						"time" 		: 5000
					},
					{
						"name" 		: "tour_8",
						"text"		: "Like the big background image?  Hover over the link for an unobscured view.  Click on the link for more information.",
						"position"	: "T",
						"time" 		: 5000
					},
                    {
						"name" 		: "tour_9",
						"text"		: "Quickly find popular links.",
						"position"	: "T",
						"time" 		: 5000
					},
                                        {
						"name" 		: "tour_9a",
						"text"		: "Don't miss our unique collections!",
						"position"	: "BL",
						"time" 		: 5000
					},
                                        {
						"name" 		: "tour_9b",
						"text"		: "Keep up-to-date on Library news.  You can scroll through the news items using the orange arrows.",
						"position"	: "B",
						"time" 		: 5000
					}
				],
				//define if steps should change automatically
				autoplay	= false,
				//timeout for the step
				showtime,
				//current step of the tour
				step		= 0,
				//total number of steps
				total_steps	= config.length;
					
				//show the tour controls
				$(".invoke_tour").click(function() {
                  showControls();
                  return false;
                });
				
				/*
				we can restart or stop the tour,
				and also navigate through the steps
				 */
				$('#activatetour').live('click',startTour);
				$('#canceltour').live('click',endTour);
				$('#endtour').live('click',endTour);
				$('#restarttour').live('click',restartTour);
				$('#nextstep').live('click',nextStep);
				$('#prevstep').live('click',prevStep);
				
				function startTour(){
					$('#activatetour').remove();
					$('#endtour,#restarttour').show();
					if(!autoplay && total_steps > 1)
						$('#nextstep').show();
					showOverlay();
					nextStep();
				}
				
				function nextStep(){
					if(!autoplay){
						if(step > 0)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps-1)
							$('#nextstep').hide();
						else
							$('#nextstep').show();	
					}	
					if(step >= total_steps){
						//if last step then end tour
						endTour();
						return false;
					}
					++step;
					showTooltip();
				}
				
				function prevStep(){
					if(!autoplay){
						if(step > 2)
							$('#prevstep').show();
						else
							$('#prevstep').hide();
						if(step == total_steps)
							$('#nextstep').show();
					}		
					if(step <= 1)
						return false;
					--step;
					showTooltip();
				}
				
				function endTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					removeTooltip();
					hideControls();
					hideOverlay();
				}
				
				function restartTour(){
					step = 0;
					if(autoplay) clearTimeout(showtime);
					nextStep();
				}
				
				function showTooltip(){
					//remove current tooltip
					removeTooltip();
					
					var step_config		= config[step-1];
					var $elem			= $('.' + step_config.name);
					
					if(autoplay)
						showtime	= setTimeout(nextStep,step_config.time);
					
					var bgcolor 		= step_config.bgcolor;
					var color	 		= step_config.color;
					
					var $tooltip		= $('<div>',{
						id			: 'tour_tooltip',
						class 	: 'tooltip',
						html		: '<p>'+step_config.text+'</p><span class="tooltip_arrow"></span>'
					}).css({
						'display'			: 'none',
						'background-color'	: bgcolor,
						'color'				: color
					});
					
					//position the tooltip correctly:
					
					//the css properties the tooltip should have
					var properties		= {};
					
					var tip_position 	= step_config.position;
					
					//append the tooltip but hide it
					$('BODY').prepend($tooltip);
					
					//get some info of the element
					var e_w				= $elem.outerWidth();
					var e_h				= $elem.outerHeight();
					var e_l				= $elem.offset().left;
					var e_t				= $elem.offset().top + 30; //agd added some space (10 px)
					
					
					switch(tip_position){
						case 'TL'	:
							properties = {
								'left'	: e_l,
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TL');
							break;
						case 'TR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_TR');
							break;
						case 'BL'	:
							properties = {
								'left'	: e_l + 'px',
								'top'	: e_t - $tooltip.height() - 60 + 'px' // agd adjusted pixels up
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BL');
							break;
						case 'BR'	:
							properties = {
								'left'	: e_l + e_w - $tooltip.width() + 'px',
								'top'	: e_t - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_BR');
							break;
						case 'LT'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LT');
							break;
						case 'LB'	:
							properties = {
								'left'	: e_l + e_w + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_LB');
							break;
						case 'RT'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RT');
							break;
						case 'RB'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h - $tooltip.height() + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_RB');
							break;
						case 'T'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t + e_h + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_T');
							break;
						case 'R'	:
							properties = {
								'left'	: e_l - $tooltip.width() + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_R');
							break;
						case 'B'	:
							properties = {
								'left'	: e_l + e_w/2 - $tooltip.width()/2 + 'px',
								'top'	: e_t - $tooltip.height() - 60 + 'px' // agd adjusted pixels up
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_B');
							break;
						case 'L'	:
							properties = {
								'left'	: e_l + e_w  + 'px',
								'top'	: e_t + e_h/2 - $tooltip.height()/2 + 'px'
							};
							$tooltip.find('span.tooltip_arrow').addClass('tooltip_arrow_L');
							break;
					}
					
					
					/*
					if the element is not in the viewport
					we scroll to it before displaying the tooltip
					 */
					var w_t	= $(window).scrollTop();
					var w_b = $(window).scrollTop() + $(window).height();
					//get the boundaries of the element + tooltip
					var b_t = parseFloat(properties.top,10);
					
					if(e_t < b_t)
						b_t = e_t;
					
					var b_b = parseFloat(properties.top,10) + $tooltip.height();
					if((e_t + e_h) > b_b)
						b_b = e_t + e_h;
						
					
					if((b_t < w_t || b_t > w_b) || (b_b < w_t || b_b > w_b)){
						$('html, body').stop()
						.animate({scrollTop: b_t}, 500, 'easeInOutExpo', function(){
							//need to reset the timeout because of the animation delay
							if(autoplay){
								clearTimeout(showtime);
								showtime = setTimeout(nextStep,step_config.time);
							}
							//show the new tooltip
							$tooltip.css(properties).show();
						});
					}
					else
					//show the new tooltip
						$tooltip.css(properties).show();
				}
				
				function removeTooltip(){
					$('#tour_tooltip').remove();
				}
				
				function showControls(){
					/*
					we can restart or stop the tour,
					and also navigate through the steps
					 */
					var $tourcontrols  = '<div style="margin: 10px auto; width: 960px; "><div id="tourcontrols" class="tourcontrols">';
					//$tourcontrols += '<span style="float: left;">Welcome to the new UM Libraries Website!</span>';
					$tourcontrols += '<span class="button" id="activatetour"style="float:left;">Start the tour</span>';
						if(!autoplay){
							$tourcontrols += '<div class="nav" style="clear: none;float:left;"><span class="button" id="prevstep" style="display:none;">< Previous</span>';
							$tourcontrols += '<span class="button" id="nextstep" style="display:none;">Next ></span></div>';
						}
						$tourcontrols += '<div style=" float: right; margin-top: -2em;"><a id="restarttour" style="display:none;">Restart the tour</span>';
						$tourcontrols += '<a id="endtour" style="display:none;">End the tour</a></div>';
						$tourcontrols += '<span class="close" id="canceltour"></span>';
					$tourcontrols += '</div></div>';
					
					$('body').prepend($tourcontrols);
					$('#tourcontrols').animate({'top':'-10px'},1500);
				}
				
				function hideControls(){
					$('#tourcontrols').remove();
				}
				
				function showOverlay(){
					var $overlay	= '<div id="tour_overlay" class="overlay"></div>';
					$('#supernav').prepend($overlay);
				}
				
				function hideOverlay(){
					$('#tour_overlay').remove();
				}
				
			});
        </script>