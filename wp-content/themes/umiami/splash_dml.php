<?php
/**
 * Template Name: Splash_DML
 * The template for the DML splash page.
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

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
  </div>
  <br style="clear:both;" /><br />
  
  <div class="grid_2" align="center">
    <a href="/medialab"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-home.png" align="center" width="75"  /></a>
      <p><a href="/medialab">DML Home</a></p>
  </div>
  <div class="grid_2" align="center">
    
      <a href="/medialab/equipment/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-equipment.png" align="center" width="75" /></a>
        <p><a href="/medialab/equipment/">Equipment</a></p>
    
  </div>
  <div class="grid_2" align="center">
          <a href="/medialab/services/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-services.png" align="center" width="75" /></a>
      <p align="center"><a href="/medialab/services/">Services</a></p>
  </div>
  <div class="grid_2" align="center">
          <a href="/medialab/printing/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-printing.png" align="center" width="75" /></a>
      <p><a href="/medialab/printing/">Printing</a></p>
  </div>
  <div class="grid_2" align="center"><a href="/medialab/gallery/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-gallery.png" alt="" width="75" align="center" /></a>
    <p><a href="/medialab/gallery/">Gallery</a>  </p>
  </div>
  <div class="grid_2" align="center"><a href="/medialab/help/"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/dml-help.png" alt="" width="75" align="center" /></a>
    <p><a href="/medialab/help/">Help</a>  </p>
  </div>
  <div class="clear"></div>
  <div class="grid_12" style="border-bottom: 1px solid #ccc; padding-bottom: 1em;"></div>
  <div class="clear"></div>

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
    <?php print uml_getTips();
    print uml_showStaff(get_field("contact"));  ?>
  </div>
</div><!-- .container_12 -->
<br />



<?php get_footer(); ?>