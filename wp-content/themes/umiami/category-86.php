
<?php
/**
 * The template for displaying Events Calendar page.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header();
query_posts('order=asc&orderby=meta_value&meta_key=event_date');
?>
<div class="container_12">
  <div class="grid_12">
    <?php if (have_posts()) : ?>

      <header class="page-header">
        <h1 class="page-title">Library Events Calendar</h1>

        <?php
        $category_description = category_description();
        if (!empty($category_description))
          echo apply_filters('category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>');
        ?>
      </header><!-- .entry-header --> 
    </div>

    <div class="grid_9">
      <div class="breather">

        <section id="primary">
          <div id="content" role="main">

            <?php //twentyeleven_content_nav( 'nav-above' ); ?>

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

              <?php
              /* Include the Post-Format-specific template for the content.
               * If you want to overload this in a child theme then include a file
               * called content-___.php (where ___ is the Post Format name) and that will be used instead.
               */

              //get_template_part( 'content', get_post_format() );

              print "<div style=\"clear: both;\">";
              if (get_field("event_date")) {

                // event_date comes in one string like 20130131
                $orig_date = get_field("event_date");
                $today_date = date(YMD);
                $our_year = substr($orig_date, 0,4);
                $our_month = substr($orig_date, 4,2);
                $our_date = explode("/", get_field("event_date"));
                $day = substr($orig_date, 6,2);
                $month = date("M", mktime(0, 0, 0, $our_month));
                $calendar = "
                      <div class=\"calendar event_date\" style=\"float: left; margin-right: 2em;\">
                        <span class=\"month\">$month</span>
                        <span class=\"day\">$day</span>
                      </div>";
              } else {

                $calendar = "";
              }

              if (get_field("front_page_blurb")) {
                $blurb = get_field("front_page_blurb");
              } else {
                $blurb = "";
              }

              if (get_field("event_time")) {
                $event_time = get_field("event_time");
              } else {
                $event_time = "";
              }

              if (get_field("event_location")) {
                $event_location = " @ " . get_field("event_location");
              } else {
                $event_location = "";
              }

              if ($calendar != "") {
              ?>

              <div style="clear: both;float: left;  margin-bottom: 1em; padding: 1em 0;  border-bottom: 1px dashed #ccc;">
    <?php print $calendar; ?>
                <div class="news_event_listing"><h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'twentyeleven'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                  <p><strong><?php print $event_time . $event_location; ?></strong>
                  <br />
    <?php print $blurb; ?></p>
                </div>
              </div>


  <?php 

} // this ends the "is there a $calendar" loop

endwhile; ?>

            <?php twentyeleven_content_nav('nav-below'); ?>

          <?php else : ?>

            <article id="post-0" class="post no-results not-found">
              <header class="entry-header">
                <h1 class="entry-title"><?php _e('Nothing Found', 'twentyeleven'); ?></h1>
              </header><!-- .entry-header -->

              <div class="entry-content">
                <p><?php _e('Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven'); ?></p>
  <?php get_search_form(); ?>
              </div><!-- .entry-content -->
            </article><!-- #post-0 -->

<?php endif; ?>

        </div><!-- #content -->
      </section><!-- #primary -->

    </div>
  </div>

  <div class="grid_3">
<?php require_once("sidebar_news.php"); ?>
  </div>
</div><!-- .container_12 -->
<?php get_footer(); ?>




