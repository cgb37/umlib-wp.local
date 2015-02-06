<?php
/**
 * Template Name: Splash_Test
 * The template for displaying the home page.
 *
 * @package WordPress
 * @subpackage umiami
 * @since
 */
get_header();

?>
<div id="indexbody" style="position: relative; display: block;z-index: 0;">
  <img src="<?php /*bloginfo('stylesheet_directory');
     print $our_bg*/ print do_shortcode('[umbi_sc_image category="default"]'); ?>" style="position: relative; display: block; width: 955px;" />
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
     <!-- <p style="margin-top:0; font-size: 0.9em;">Articles+ is temporarily unavailable.  Please use e-journals or databases while it is being fixed.
      <a href="https://iiiprxy.library.miami.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=aph">Academic Search Premier</a> is a good multidisciplinary database.</p>
      -->
        <form action="http://miami.summon.serialssolutions.com/search" method="GET" id="summon_search">
          <input type="hidden" value="ContentType,Newspaper Article, true" name="s.fvf[]" />
          <input type="hidden" value="ContentType,Book Review, true" name="s.fvf[]" />
          <input type="hidden" value="ContentType,Trade Publication Article, true" name="s.fvf[]" />
          <input type="text" name="s.q" value="" rel="" class="searchinput-1" size="40" />
          <input type="submit" value="Search" /> &nbsp;
        </form>
        <p class="search_blurb">Find articles, books &amp; more  &nbsp; &nbsp; <span class="label"><a href="/summon-help/">Help</a></span></p>

        <div class="search_extralinks" style="display: block;">See also <a href="http://mt7kx4ww9u.search.serialssolutions.com/">E-Journals</a>, <a href="http://mt7kx4ww9u.search.serialssolutions.com/?SS_Page=refiner&SS_RefinerEditable=yes">Citation Linker</a>, <a href="<?php print PATH_FROM_ROOT; ?>/search-tools-overview">All Search Tools</a></div>
      </div>
      <div class="search-2" style="display: none;">
        <?php $search_bottom_text = '<a href="https://ibisweb.miami.edu/">Catalog Home</a>, '; ?>
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
          <p class="search_blurb">Limit to:
            <select name="searchscope" id="searchscope">
              <option value="10"> Architecture Library</option>
              <option value="14"> Audio-Books</option>
              <option value="12"> Books (Print)</option>
              <option value="5"> CDs/DVDs/Videos</option>
              <option value="7"> Cuban Heritage Coll.</option>
              <option value="13"> E-Books</option>
              <option value="4"> Gov. Documents & Maps</option>
              <option value="2"> Internet Resources</option>
              <option value="1"> Journals &  Serials</option>
              <option value="9"> Marine Science Library</option>
              <option value="15"> Music CDs</option>
              <option value="8"> Music Library</option>
              <option value="17"> DVDs/Videos</option>
              <option value="16"> Music Recordings</option>
              <option value="18"> Music Scores</option>
              <option value="3"> Richter Reference</option>
              <option value="6"> Special Colls & Archives</option>
              <option value="19"> E-Music/E-Audio/E-Video</option>
              <option value="11" selected="selected"> Entire Collection</option>
            </select>
            &nbsp; &nbsp; <span class="label"><a href="http://catalog.library.miami.edu/search/X">Advanced</a></span>
          </p>
        </form>

        <div class="search_extralinks">See also <a href="http://catalog.library.miami.edu/">Catalog Home</a>, <a href="<?php print PATH_TO_SP; ?>subjects/new_acquisitions.php">New Acquisitions</a></div>
      </div>
      <div class="search-3" style="display: none;">
        <?php
$db_path = PATH_TO_SP . "subjects/databases.php?letter=";
$letters = range('A', 'Z');
$letters[] = "Num";
$alphabet = getLetters($letters, $_GET["letter"], 0, $db_path, "small", 0);
print $alphabet;
?>
        <form action="<?php print PATH_TO_SP; ?>subjects/databases.php" method="post" style="margin-left: 1em;">
          <input type="text" id="letterhead_suggest" size="30" class="searchinput-3" name="searchterm" />
          <input type="submit" value="Search" />
        </form>
        <div class="search_extralinks">See also <a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bysub">Database by Subject</a>, <a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bytype">Database by Format</a></div>
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
  </div>

  <div id="bg_info_overlay" class="track_me_BackgroundImageLinks_Click"><?php /*print $bg_overlay_data;*/ print do_shortcode('[umbi_sc_info]'); ?></div>
</div>

<div id="listland">
  <div id="quicko" class="list_feature track_me_Quicklinks_Select" style="width: 320px; background-image: none;"><h3>Quick Links</h3>
    <form id="quick_links" name="quick_linker" action="<?php bloginfo('stylesheet_directory'); ?>/resolver.php" method="POST" >
      <select name="quick_links" id="quick_links_jump">
        <option value=""> -- Popular Resources -- </option>
        <option value="/visitors/">Visitor Information</option>
        <option value="http://libcal.miami.edu/booking/richter-study">Reserve a Room</option>
        <option value="<?php print PATH_TO_SP; ?>subjects/faq.php">FAQs</option>
        <option value="<?php print PATH_TO_SP; ?>subjects/new_acquisitions.php">New Acquisitions</option>
        <option value=""> ---- </option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=aph">Academic Search Premier</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.epnet.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=buh">Business Source Premier</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.epnet.com/login.aspx?authtype=ip,uid&profile=ehost&defaultdb=jlh">CINAHL Plus</option>
        <option value="http://www.miami.edu/lynda">Lynda</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://go.galegroup.com/ps/i.do?id=GALE|2NYT&v=2.1&u=miami_richter&it=aboutJournal&p=AONE&sw=w">New York Times</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://search.ebscohost.com/login.aspx?authtype=ip,uid&profile=ebscohost&defaultdb=psyh">PsycInfo</option>
        <option value="http://etd.library.miami.edu/">UM Theses &amp; Dissertations</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://webofknowledge.com/WOS">Web of Science</option>
        <option value="https://iiiprxy.library.miami.edu/login?url=http://newfirstsearch.oclc.org/dbname=WorldCat;done=referer;FSIP">WorldCat</option>
      </select>
      <input type="submit" id="quick_links_submit" value="Go!" />
    </form>
  </div>
  <div id="uniquo" class="list_feature track_me_UniqueAtUM_Click" style="width: 310px; background-image: none;"><h3>Unique @ UM</h3>
    <ul>
      <li><a href="http://www.library.miami.edu/chc/">Cuban Heritage Collection</a></li>
      <li><a href="http://www.library.miami.edu/specialcollections/">Special Collections</a></li>
      <li><a href="http://merrick.library.miami.edu/">UM Digital Collections</a></li>
      <li><a href="http://scholarlyrepository.miami.edu/">UM Scholarly Repository</a></li>
      <li><a href="http://www.library.miami.edu/universityarchives/">University Archives</a></li>
    </ul>
  </div>
  <?php
// alternate vids
$choose_vid = mt_rand(0, 1);
if ($choose_vid == 1) {
	$vid_link = "http://library.miami.edu/blog/2012/09/26/doctoral-students-can-be-immersed-in-cuban-originals-thanks-to-the-goizueta-foundation/";
	$vid_blurb_text = "Video: The Cuban Heritage Collection";
	$vid_img = "video_chc.jpg";
} else {
	$vid_link = "http://library.miami.edu/blog/2012/09/26/otto-g-richter-librarys-conservation-laboratory/";
	$vid_blurb_text = "Video: Conservation Lab";
	$vid_img = "video_conservation_lab.jpg";
}

//$lynda_words = array("Photoshop","Excel","jQuery","Audio","CAD","Color Correction","Mobile Apps","Illustration","Photography","Rendering","Web Development","Typography","Productivity","Infographics");
//shuffle($lynda_words);
$choose_udvd = mt_rand(1, 3);


?>



    <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><?php echo do_shortcode('[umfpi_title_bar]'); ?><!--<h3><a href="http://library.miami.edu/blog/2014/04/23/free-comic-book-day-at-richter/">Free Comic Book Day</a></h3>-->
    <div id="gifto_promo">
      <?php echo do_shortcode('[umfpi_image]'); ?>
      <!--<div style="float: left; position: relative;overflow: hidden;margin-top: 10px; width: 296px;  height: 138px; ">
        <a href="http://library.miami.edu/specialcollections/2014/05/15/now-accepting-applications-the-dave-abrams-and-gene-banning-pan-am-research-grant/">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mini_feature/pan_am_banner.jpg" alt="Pan Am" class="staff_picture" style="position: absolute;" /></a></div>-->
    </div>
 <!--

  <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="http://library.miami.edu/udvd/">Browse Richter DVDs with UDVD</a></h3>
    <div id="gifto_promo">
      <div style="float: left; position: relative;overflow: hidden;margin-top: 10px; width: 296px;  height: 138px; ">
        <a href="http://library.miami.edu/udvd/">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mini_feature/UDVD-<?php print $choose_udvd; ?>.png" alt="Browse Richter DVDs with UDVD" class="staff_picture" style="position: absolute;" /></a></div>
    </div>

 <span style="position: absolute; top: 432px; left: 666px;color: #ccc;z-index: 20001; font-size: 12px;font-style: italic;">
      <?php print $lynda_words[0]; ?><br />&nbsp; &nbsp;<?php print $lynda_words[1]; ?><br /><?php print $lynda_words[3]; ?></span>
  <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="http://library.miami.edu/printing/">New Laptop Printing Drivers</a></h3>
    <div id="gifto_promo">
      <div style="float: left; position: relative;overflow: hidden;margin-top: 10px; width: 296px;  height: 138px; ">
        <a href="http://library.miami.edu/printing/">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mini_feature/printing_help.png" alt="Laptop Printing Help" class="staff_picture" style="position: absolute;" /></a></div>
    </div>
  <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="http://library.miami.edu/blog/2013/08/02/mango/">Mango Languages</a></h3>
    <div id="gifto_promo">
      <div style="float: left; position: relative;overflow: hidden;margin-top: 10px; width: 296px;  height: 138px; ">
        <a href="http://library.miami.edu/blog/2013/08/02/mango/">
          <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mini_feature/mango_lango.jpg" alt="Mango Languages" class="staff_picture" style="position: absolute;" /></a></div>
    </div>

      <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="http://library.miami.edu/50/">50 Years of the Richter Library</a></h3>
        <div id="gifto_promo">
          <div style="float: left; position: relative;overflow: hidden;margin-top: 10px; width: 296px;  height: 138px; ">
          <a href="http://library.miami.edu/50/">
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/mini_feature/50_horiz_banner.jpg" alt="Richter Library 50th Anniversary" class="staff_picture" style="position: absolute;" />
          </a></div>
        </div>

    <div id="gifto" class="list_feature" style="width: 322px; background-image: none;"><h3><a href="/support-the-libraries/">Make a Gift</a></h3>
      <div id="gifto_promo">
        <a href="http://new.library.miami.edu/2012/01/04/um-acquires-orange-bowl-collection/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/orange_bowl_promotion.jpg" alt="Make a Gift to the Libraries" title="Make a Gift to the Libraries" class="staff_picture" /></a>
        <p><strong>Preserving the Orange Bowl</strong><br />
          The Orange Bowl Committee has donated its archives to the UM Libraries. <a href="http://new.library.miami.edu/2012/01/04/um-acquires-orange-bowl-collection/">Read on . . .</a></p>
      </div>
    -->
  </div>
  <div style="" id="news_events">
    <h3 class="">
      <a href="feed/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss_17.png" style="position: relative; top: 4px; padding-right: 5px; margin-left: 10px;" alt="subscribe to RSS feed" title="subscribe to RSS feed" /></a>
      <a href="news/" style="color: #333;">News &amp; Events</a>
      <a class="prev" id="spotlight_controls_prev"><span>prev</span></a>
      <a class="next" id="spotlight_controls_next"><span>next</span></a>

    </h3>
  </div>
</div>
<?php // to set this sticky image, you'll also need to tweak the umiami/js/front_page_data.js around line 101 ?>
<!--<div style="float: right; position: relative;overflow: hidden; padding-top: 2px; width: 296px;  height: 138px; ">
        <a href="https://library.miami.edu/blog/2014/10/27/help-us-help-you-take-our-short-survey/">
          <img src="https://library.miami.edu/wp-content/uploads/2014/10/libQual_BannerButton-home.png" alt="Take a survey, improve the Libraries!" class="staff_picture" style="position: absolute; background-color: #FFF; box-shadow: none; top: 8px;"></a></div>-->

<div id="mini_features" class="text_carousel">

  <?php
uml_getCarouselPosts(9);
?>

</div> <!--Closes Mini-Feature Text Carousel -->

<?php get_footer(); ?>
