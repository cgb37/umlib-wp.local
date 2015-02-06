<?php
// Check if we have access to the WP function, and if so grab the correct footer into

if (function_exists('get_bloginfo')) {
  $our_site = end(explode("/", get_bloginfo('url')));
} else {
  $our_site = "";
}

$social_icons = "";

//echo $our_site;
switch ($our_site) {
   case "specialcollections":
   case "specialcollectionsbeta":
    $library_address = "<strong>Special Collections | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br />1300 Memorial Drive, 8th Floor, Coral Gables, Florida 33124-0320<br />
        phone: (305) 284-3247<br />fax: (305) 284-4027";
    $social_icons = "<p id=\"social_icons_small\">
      <a href=\"http://www.facebook.com/pages/Coral-Gables-FL/University-of-Miami-Special-Collections/111414245539082\"><img src=\"" . THEME_BASE_DIR . "/images/facebook.png\"  alt=\"Find Us on Facebook\" title=\"Find Us on Facebook\" /></a>
      <a href=\"https://twitter.com/um_spec_coll\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/twitter.png\"  alt=\"Twitter\" title=\"Twitter\" /></a>
      <a href=\"http://instagram.com/um_spec_coll\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/instagram-icon.png\"  alt=\"Instagram\" title=\"Instagram\" /></a>
    </p>";
    break;
   case "rsmaslib":
  case "rsmas":
    $library_address = "<strong>Rosenstiel School of Marine & Atmospheric Science Library | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br />4600 Rickenbacker Causeway Miami, Florida 33149<br />
        phone: (305) 421-4060<br />fax: (305) 361-9306";
    break;
  case "musiclib":
  case "music":
    $library_address = "<strong>Marta & Austin Weeks Music Library | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br /> 5501 San Amaro Drive   P.O. Box 248165  Coral Gables, Florida 33124<br />
        phone: (305) 284-9885<br />fax: (305) 284-1041";
    $social_icons = "<p id=\"social_icons_small\">
      <a href=\"http://m.library.miami.edu\"><img src=\"" . THEME_BASE_DIR . "/images/mobile.png\"  alt=\"View Mobile Website\" title=\"View Mobile Website\" /></a>
      <a href=\"http://www.facebook.com/pages/University-of-Miami-Libraries/16409329419\"><img src=\"" . THEME_BASE_DIR . "/images/facebook.png\"  alt=\"Find Us on Facebook\" title=\"Find Us on Facebook\" /></a>
      <a href=\"https://twitter.com/WeeksMusicLib\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/twitter.png\"  alt=\"Twitter\" title=\"Twitter\" /></a>
      <a href=\"" . PATH_TO_SP . "subjects/video.php\"><img src=\"" . THEME_BASE_DIR . "/images/youtube.png\"  alt=\"View Library Produced Videos\" title=\"View Library Produced Videos\" /></a>
    </p>";
    break;
  case "universityarchives":
    $library_address = "<strong>University Archives | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br />1300 Memorial Drive, Coral Gables, Florida 33124-0320<br />
        phone: (305) 284-3247<br />fax: (305) 284-4027";
    break;
  case "architecture":
    $library_address = "<strong>Paul Buisson Architecture Library | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br />1223 Dickinson Drive, Coral Gables FL 33146<br />
        phone: (305) 284-5282";
    break;
  case "chcbeta":
  case "chc":
     $library_address = "<strong>Cuban Heritage Collection | <a href=\"http://library.miami.edu\">UM Libraries</a></strong><br />1300 Memorial Drive, Coral Gables, Florida 33124-0320<br />
        (305) 284-4900<br />
        Email:  <a href=\"mailto:chc@miami.edu\">chc@miami.edu</a>";
    $social_icons = "<p id=\"social_icons_small\">
	<a href=\"" . PATH_TO_CHILD . "/feed/\"><img src=\"" . THEME_BASE_DIR . "/images/rss_26.png\"  alt=\"Visit the CHC Blog\" title=\"Visit the CHC Blog\" /></a>
	<a href=\"" . PATH_TO_CHILD . "/community/subscribe/\"><img src=\"" . THEME_BASE_DIR . "/images/mailing_list.png\"  alt=\"Join our Mailing List\" title=\"Join our Mailing List\" /></a>
      <a href=\"http://www.facebook.com/umchc\"><img src=\"" . THEME_BASE_DIR . "/images/facebook.png\"  alt=\"Find Us on Facebook\" title=\"Find Us on Facebook\" /></a>
	  <a href=\"https://twitter.com/umchc\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/twitter.png\"  alt=\"Twitter\" title=\"Twitter\" /></a>
	  <a href=\"http://vimeo.com/umchc\"><img src=\"" . THEME_BASE_DIR . "/images/vimeo.png\"  alt=\"Find Us on Vimeo\" title=\"Find Us on Vimeo\" /></a>
      <a href=\"http://www.flickr.com/photos/umdigital/collections/72157623554504931/\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/flickr.png\"  alt=\"Find us on Flickr\" title=\"Find Us on Flickr\" /></a>
    </p>";
    break;
  default:
    $library_address = "<strong>UM Libraries</strong> 1300 Memorial Drive, Coral Gables, Florida 33124-0320<br />
        (305) 284-3233";
    $social_icons = "<p id=\"social_icons_small\">
      <a href=\"http://m.library.miami.edu\"><img src=\"" . THEME_BASE_DIR . "/images/mobile.png\"  alt=\"View Mobile Website\" title=\"View Mobile Website\" /></a>
      <a href=\"http://www.facebook.com/pages/University-of-Miami-Libraries/16409329419\"><img src=\"" . THEME_BASE_DIR . "/images/facebook.png\"  alt=\"Find Us on Facebook\" title=\"Find Us on Facebook\" /></a>
      <a href=\"http://www.flickr.com/photos/umdigital/\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/flickr.png\"  alt=\"Find us on Flickr\" title=\"Find Us on Flickr\" /></a>
      <a href=\"https://twitter.com/UMiamiLibraries\" border=\"0\"><img src=\"" . THEME_BASE_DIR . "/images/twitter.png\"  alt=\"Twitter\" title=\"Twitter\" /></a><br />        
        <a href=\"http://library.miami.edu/support-the-libraries/\"><img src=\"" . THEME_BASE_DIR . "/images/support-uml.png\"  alt=\"Support UML\" title=\"Support UML\" style=\"margin-top: 10px;\" /></a><a href=\"http://library.miami.edu/uml-news-2014/\"><img src=\"" . THEME_BASE_DIR . "/images/uml-news.png\"  alt=\"UML in the News\" title=\"UML in the News\" style=\"margin-top: 10px;\" /></a>
    </p>";
}
?>

<br style="clear: both;" />
<br />
<br />
<div id="wide_footer" class="track_me_Footer_Click">
  <div id="footer_wrapper">
    <div style="float: left; position:relative; width: 590px; margin-left: 0px; color: #333;"><a href="http://www.miami.edu/">
        <img src="<?php print THEME_BASE_DIR; ?>/images/umiami_logo.png" alt="University of Miami" border="0" id="umiami_logo" /></a>
      <p style="line-height: 16pt;float: left;"><?php print $library_address; ?><br />
        <a href="http://www.miami.edu/index.php/copyright_notice/">&copy; <?php print date("Y"); ?></a> |
        <a href="http://www.miami.edu/index.php/privacy_statement/">Privacy</a> |
        <a href="/report-website-issue/">Report Site Issue</a> |
        <a href="/support-the-libraries/">Make a Gift</a>
      </p>
    </div>
    <div id="footer_feature" style="float: left; position:relative; text-align: right;width: 360px;">
<?php print $social_icons; ?>
    </div>

  </div>
</div>
</body>
</html>

<!--[if lte IE 7]>
<script type="text/javascript">
jQuery(document).ready(function($) {
// This is the z-index fix for IE
 $(function() {
    var zIndexNumber = 10000;
    $('div').each(function() {
        $(this).css('zIndex', zIndexNumber);
        zIndexNumber -= 5;
    });
    // make sure footer goes on top
    $("#footer").css('zIndex', 10001);

});

});
</script>
<![endif]-->