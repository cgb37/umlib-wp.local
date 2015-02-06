<?php
/**
 * Template Name: Splash_Research
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



if (class_exists("uml_Librarianify")) {
  $check_lib = get_field("contact");

  $our_lib = new uml_Librarianify($check_lib);


  if ($our_lib->_fail != TRUE) {
    $assoc_lib = $our_lib->display();
  } else {
    $assoc_lib = "";
  }
}
 */
get_header();
?>



<div class="container_12">
  <div class="grid_12" style="">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
  </div>
  <div class="grid_2 feature_bar_intro">Term Paper Strategy</div>
  <div class="grid_2">
    <div class=" feature_bar">
      <h4>Week 1</h4>
      <p>Start!</p></div></div>
  <div class="grid_2">
    <div class=" feature_bar">
      <h4>Week 2</h4>
      <p>Do background reading &amp; narrow your topic.</p>
    </div>
  </div>
  <div class="grid_2">
    <div class=" feature_bar">
      <h4>Week 3/4</h4>
      <p>Research your topic.</p></div>
  </div>
  <div class="grid_2">
    <div class=" feature_bar">
      <h4>Week 5/6</h4>
      <p>Plan &amp; write your paper.</p></div>
  </div>
  <div class="grid_2">
    <div class=" feature_bar">
      <h4>Week 7/8</h4>
      <p>Revise &amp; rewrite.</p></div>
  </div>
  <div class="clear"></div>
  <div class="grid_12" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;"></div>
  <div class="clear"></div>

  <div class="grid_8">
    <div class="breather">
<?php the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">&nbsp;
<?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'twentyeleven') . '</span>', 'after' => '</div>')); ?>
        </div><!-- .entry-content -->
        <footer class="entry-meta">
<?php edit_post_link(__('Edit', 'twentyeleven'), '<span class="edit-link">', '</span>'); ?>
        </footer><!-- .entry-meta -->
      </article><!-- #post-<?php the_ID(); ?> -->

    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
<?php print uml_getTips();
print uml_showStaff(get_field("contact"));  ?>
  </div>
</div><!-- .container_12 -->

<?php get_footer(); ?>