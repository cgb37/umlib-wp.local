<?php
/**
 * The template for displaying all pages.
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
<div class="container_12">

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <?php print $patron_tip; ?>
  </div>

  <div class="grid_8">
    <div class="breather track_me_Page_Click">
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