<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of #main , #wrapper
 * Extra information is an include, so it can be accessed by SubsPlus sans WP stuff
 *
 * @package WordPress
 */
?>

<?php if (!is_front_page() && strlen(get_the_author()) != 0 && is_page() && !is_page('news')) { ?>

  <p class="last_mod">Last updated <?php the_modified_date(); ?></p>

<?php } elseif (is_front_page()) {

} else { ?>
  <p class="last_mod">&nbsp;</p>

<?php } ?>

</div><!-- #main -->

</div><!-- #wrapper -->
<?php wp_footer(); ?>

<?php
require_once("footer_inc.php"); // so subjectsplus can access, too ?>