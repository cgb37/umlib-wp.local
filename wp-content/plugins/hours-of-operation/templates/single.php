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

							<?php $time_offset = "18000"; ?>

							<?php
								$monday_open = get_post_meta( get_the_ID(), 'monday_open' );
								$monday_close = get_post_meta( get_the_ID(), 'monday_close' );
								$tuesday_open = get_post_meta( get_the_ID(), 'tuesday_open' );
								$tuesday_close = get_post_meta( get_the_ID(), 'tuesday_close' );
								$wednesday_open = get_post_meta( get_the_ID(), 'wednesday_open' );
								$wednesday_close = get_post_meta( get_the_ID(), 'wednesday_close' );
								$thursday_open = get_post_meta( get_the_ID(), 'thursday_open' );
								$thursday_close = get_post_meta( get_the_ID(), 'thursday_close' );
								$friday_open = get_post_meta( get_the_ID(), 'friday_open' );
								$friday_close = get_post_meta( get_the_ID(), 'friday_close' );
								$saturday_open = get_post_meta( get_the_ID(), 'saturday_open' );
								$saturday_close = get_post_meta( get_the_ID(), 'saturday_close' );
								$sunday_open = get_post_meta( get_the_ID(), 'sunday_open' );
								$sunday_close = get_post_meta( get_the_ID(), 'sunday_close' );

							?>


							<table width="50%">
								<tr>
									<td>Monday</td>
									<td><?php echo date('h:i a', $monday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $monday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Tuesday</td>
									<td><?php echo date('h:i a', $tuesday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $tuesday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Wednesday</td>
									<td><?php echo date('h:i a', $wednesday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $wednesday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Thursday</td>
									<td><?php echo date('h:i a', $thursday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $thursday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Friday</td>
									<td><?php echo date('h:i a', $friday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $friday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Saturday</td>
									<td><?php echo date('h:i a', $saturday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $saturday_close[0]+$time_offset);?></td>
								</tr>
								<tr>
									<td>Sunday</td>
									<td><?php echo date('h:i a', $sunday_open[0]+$time_offset);?></td>
									<td><?php echo date('h:i a', $sunday_close[0]+$time_offset);?></td>
								</tr>
							</table>


							<hr>

							<h2>Holidays</h2>
							<?php
							$child_posts = types_child_posts('holiday'); ?>

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
							<?php $child_posts = types_child_posts('event'); ?>
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
			<?php //require_once("sidebar_news.php"); ?>
		</div>
	</div><!-- .container_12 -->

<?php get_footer(); ?>