<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><a href="/news/">News and Events</a></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="grid_9">
    <div class="breather track_me_Post_Click">

		<div id="primary">
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>

					<nav id="nav-single">
						<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
					</nav><!-- #nav-single -->

					<?php get_template_part( 'content', 'single' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
                 </div>
  </div>

  <div class="grid_3">
<?php require_once("sidebar_news.php"); ?>
  </div>
</div><!-- .container_12 -->

<?php get_footer(); ?>