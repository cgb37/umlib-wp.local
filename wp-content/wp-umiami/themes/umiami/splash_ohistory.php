<?php
/**
 * Template Name: Splash_Oral_History
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
?>
<style>
 .oh-header {
  background-image: url(<?php print THEME_BASE_DIR; ?>/images/ohistory.jpg); 
  background-clip:content-box; 
  background-repeat: no-repeat;
  margin-left: 5px;
 }

.oh-navcats h2 {
  padding: 0; margin: 0; background-color:#D1D688; border: none; padding: .5em 1em;
}

.oh-navcats h2 a {
  color: #333;
  text-decoration: none;
}


.oh-navcats h2:hover {
  background-color: #A2AD00;
}
</style>


<div class="container_12 oh-header">    
  <div class="grid_4">
  <a href="/oral-histories/" alt="Back to Oral Histories home" title="Back to Oral Histories home"><span style="height: 130px; width: 300px; display: block;">&nbsp;</span></a>
  </div>
  <div class="grid_8" style="">
    <div class="oh-navcats" style="margin-bottom: 4px;"><h2><a href="/oral-histories/oral-history-collections">Oral History Collections</a></h2></div>
    <div class="oh-navcats" style="margin-bottom: 4px;"><h2><a href="http://merrick.library.miami.edu/digitalprojects/oralhistories.html">Interviews Available Online</h2></a></div>
    <div class="oh-navcats" style=""><h2><a href="/oral-histories/oral-history-resources">Oral History Resources</h2></a></div>
  </div>
</div>
  <div class="container_12"> 
<br style="clear:both;" />
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



<?php get_footer();  ?>

