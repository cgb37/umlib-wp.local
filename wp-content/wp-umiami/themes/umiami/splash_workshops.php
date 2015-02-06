<?php
/**
 * Template Name: Splash_Workshops
 *
 *Used for the Workshop and Tutorials page in order to display video in the colorbox
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
/*
  // Check for cookie
  if (isset($_COOKIE["uml_patron_type"])) {
  // check if valid patron type
  if (class_exists("uml_Patronizer")) {
  $our_patronizer = new uml_Patronizer($_COOKIE["uml_patron_type"]);
  }

  $patron_tip = $our_patronizer->personalization();
  } else {
  $patron_tip = "";
  }

 */

get_header();


/*
if (class_exists("uml_Librarianify")) {

  $check_lib = get_field("contact");

  if (trim($check_lib) != "") {

    // allow for multiple staffers
    $staffers = explode(",", $check_lib);

    if (isset($staffers[0])) {
      foreach ($staffers as $staffer) {
        $our_lib = new uml_Librarianify($staffer);

        if ($our_lib->_fail != TRUE) {

          $assoc_lib .= $our_lib->display();
        } else {
          $assoc_lib .= "";
        }
      }
    }
  }
}
*/

?>
<script type="text/javascript" src="http://library.miami.edu/sp/assets/jquery/jquery.colorbox-min.js"></script>

<style type="text/css">@import url(http://library.miami.edu/sp/assets/css/colorbox.css);</style>

<script type="text/javascript" language="javascript">
  $(document).ready(function(){

    $(".ajax").colorbox({iframe:true, innerWidth:640, innerHeight:480});

  });
</script>

<div class="container_12 track_me_Page_Click">

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <?php print $patron_tip; ?>
  </div>

  <div class="grid_8">
    <div class="breather">
      <?php the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">&nbsp;
          <?php the_content(); ?>

        </div><!-- .entry-content -->
        <footer class="entry-meta">

        </footer><!-- .entry-meta -->
      </article><!-- #post-<?php the_ID(); ?> -->

    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <?php
    print uml_getTips();
    print uml_showStaff(get_field("contact"));
    ?>
  </div>
</div><!-- .container_12 -->

<?php get_footer(); ?>