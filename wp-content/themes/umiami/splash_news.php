<?php
/**
 * Template Name: Splash_News
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

<div class="container_12 track_me_Page_Click">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="grid_9">
    <div class="breather">

		<div id="primary">
			<div id="content" role="main">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=5'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

	<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php $wp_query = null; $wp_query = $temp;?>

			</div><!-- #content -->
		</div><!-- #primary -->

            </div>
  </div>

  <div class="grid_3">
<?php require_once("sidebar_news.php"); ?>
  </div>
</div><!-- .container_12 -->


<?php get_footer(); ?>
