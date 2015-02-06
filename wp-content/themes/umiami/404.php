<?php
/**
 * The template for displaying 404 pages (Not Found).
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
      <h1 class="page-title">Page not Found</h1>
    </header><!-- .entry-header --> 
  </div>

  <div class="grid_8">
    <div class="breather">

      <p>We looked everywhere, and we can't find that page.</p>
      <p>Try <strong>searching</strong> for the page you want, or <strong>
          select a category</strong> from the navigational menu above.
      </p>
      <br />
      <form id="head_search" action="<?php bloginfo('stylesheet_directory'); ?>/resolver.php" method="post">
        <input type="hidden" name="searchtype" value="website" />
        <input id="search_tabs" type="text"  value="" name="searchterms" class="searchinput-4" size="40" autocomplete="off" />
        <input type="submit" value="Search" name="submitsearch" />
      </form>
    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>    
  </div>
</div><!-- .container_12 -->
<?php get_footer(); ?>