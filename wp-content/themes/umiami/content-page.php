<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$our_tip = get_post_meta($post->ID, 'Tip', true);

if ($our_tip) {
  $the_tip = "<div class=\"tip\">$our_tip</div>";
}

// Check for personalizations
$tip_faculty = get_post_meta($post->ID, 'Faculty', true);
$tip_undergrad = get_post_meta($post->ID, 'Undergraduate', true);
$tip_graduate = get_post_meta($post->ID, 'Graduate', true);
$tip_alumni = get_post_meta($post->ID, 'Alumni', true);

if ($tip_faculty) {
  $patron_tip = "<strong>Faculty:</strong> " . $tip_faculty;
} elseif ($tip_undergrad) {
  $patron_tip = "<strong>Undergraduates:</strong> " . $tip_undergrad;
} elseif ($tip_graduate) {
  $patron_tip = "<strong>Grad Students:</strong> " . $tip_graduate;
} elseif ($tip_alumni) {
  $patron_tip = "<strong>Alumni:</strong> " . $tip_alumni;
} else {
  $patron_tip = "";
}

if ($patron_tip) {
  $patron_tip = "<div class=\"patron_tip\">$patron_tip</div>";
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="page-header">
    <h1 class="page-title"><?php the_title(); ?></h1>
  </header><!-- .entry-header -->
<?php print $patron_tip . $the_tip; ?>
  <div class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages(array('before' => '<div class="page-link"><span>' . __('Pages:', 'twentyeleven') . '</span>', 'after' => '</div>')); ?>
  </div><!-- .entry-content -->
  <footer class="entry-meta">
    <?php edit_post_link(__('Edit', 'twentyeleven'), '<span class="edit-link">', '</span>'); ?>
  </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
