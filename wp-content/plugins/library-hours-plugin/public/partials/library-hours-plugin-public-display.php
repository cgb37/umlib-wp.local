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
				<h1 class="page-title"><a href="/news/">Hours of Operation</a></h1>
			</header><!-- .entry-header -->


			<?php
			$postlist = get_posts(array("post_type" => "libhours_post_type", "posts_per_page" => "10"));
			?>

			<ul>

				<?php
				foreach ( $postlist as $post): ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); ?>
						</a>
						<div>
							<?php the_title(); ?>
						</div></li>

				<?php
				endforeach;
				?>
			</ul>


		</div>

		<div class="grid_9">
			<div class="breather track_me_Post_Click">

				<div id="primary">
					<div id="content" role="main">



						<?php //var_dump(get_post(get_the_ID())); ?>


						<?php while ( have_posts() ) : the_post(); ?>




							<nav id="nav-single">
								<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
								<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
							</nav><!-- #nav-single -->



							<?php //var_dump(get_current_post(get_the_ID())); ?>
							<h1><?php the_title(); ?></h1>




							<?php $openHours = new Open_Hours(); ?>

							<?php $ct = $openHours->current_time('timestamp');
									echo $openHours->date_formatter($ct);

							?>

							<?php $data = $openHours->get_formatted_times(get_the_ID()); ?>
							<?php foreach($data as $datum): ?>
								<ul>
								<?php foreach($datum as $key => $day): ?>
									<li><?php echo $key; ?> open => <?php echo $day['open']; ?> close => <?php echo $day['close']; ?></li>
								<?php endforeach; ?>
								</ul>
							<?php endforeach; ?>




							<hr>

							<h2>Holidays</h2>

							<?php $args = array(
								'orderby' => 'wpcf-start-date',
								'order' => 'ASC',

							); ?>
							<?php $child_posts = types_child_posts('holiday', $args); ?>

							<ul>

								<?php
								foreach ($child_posts as $child_post) {

									if($child_post->fields['holiday-closed'] == '2') {
										$is_open = 'Closed';
									}

									echo "<li>".$child_post->post_title
									     ." ".strftime('%a %b %e', $child_post->fields['start-date']+$time_offset)
									     ." ".strftime('%a %b %e', $child_post->fields['end-date']+$time_offset)
									     ." ".$is_open
									     ."</li>";
								}
								?>
							</ul>

							<?php //var_dump($child_posts); ?>
							<hr>

							<h2>Events</h2>
							<?php $args = array(
								'orderby' => 'wpcf-start-date',
								'order' => 'ASC',

							); ?>
							<?php $child_posts = types_child_posts('event', $args); ?>
							<ul>
								<?php
								foreach ($child_posts as $child_post) {
									echo "<li>".$child_post->post_title
									     ." ".strftime('%a %b %e %l:%M %p', $child_post->fields['start-date']+$time_offset)
									     ." ".strftime('%a %b %e %l:%M %p', $child_post->fields['end-date']+$time_offset)
									     ."</li>";
								}
								?>
							</ul>
							<?php //var_dump($child_posts); ?>
							<?php comments_template( '', true ); ?>

						<?php endwhile; // end of the loop. ?>

					</div><!-- #content -->
				</div><!-- #primary -->
			</div>
		</div>

		<div class="grid_3">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- .container_12 -->

<?php get_footer(); ?>