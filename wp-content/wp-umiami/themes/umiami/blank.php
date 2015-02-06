<?php
/**
 * Template Name: Blank Page
 * The template for displaying the only content.
 *
 * @package WordPress
 * @subpackage umiami
 * @since
 */
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php
/*
 * Print the <title> tag based on what is being viewed.
 */
global $page, $paged;

wp_title('|', true, 'right');

// Add the blog name.
bloginfo('name');

// Add the blog description for the home/front page.
$site_description = get_bloginfo('description', 'display');
if ($site_description && ( is_home() || is_front_page() ))
  echo " | $site_description";

// Add a page number if necessary:
if ($paged >= 2 || $page >= 2)
  echo ' | ' . sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));
?></title>
<?php
// NOTE:  js added via enqueue in functions.php file

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();

    ?>
</head>
<body style="margin: 0; padding: 0;" vlink="#7a0001" link="#7a0001" alink="#7a0001">
<a name="top"></a>
<?php the_post(); ?>
<?php the_content(); ?>
</body>
</html>