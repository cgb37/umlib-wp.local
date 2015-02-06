<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage umiami
 * @since
 */

// set timezone
date_default_timezone_set('America/New_York');

if ($_SERVER['HTTP_HOST'] != "localhost") {
  define("PATH_FROM_ROOT", "");
  //define("PATH_TO_SP", "http://library.miami.edu/sp/");
  define("PATH_TO_SP", "http://sp.library.miami.edu/");
} else {
  define("PATH_FROM_ROOT", "/dev-wp");
  define("PATH_TO_SP", "http://localhost/devl-sp/");
}

$lstrWPContentURL = WP_CONTENT_URL;

if( isset( $_SERVER['HTTPS'] ) )
{
	$lstrWPContentURL = str_replace( 'http://', 'https://', $lstrWPContentURL );
}

define("THEME_BASE_DIR", $lstrWPContentURL . "/themes/umiami");
define("THIS_BRANCH", "main");

// set this for use in the includes
if (is_page('Home')) {
  define("IS_INDEX", TRUE);
} else {
  define("IS_INDEX", FALSE);
}
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
  <!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
    <link type="text/css" media="print" rel="stylesheet" href="<?php print THEME_BASE_DIR; ?>/print.css" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <!--[if lt IE 8]>
            <link rel="stylesheet" type="text/css" href="<?php print THEME_BASE_DIR; ?>/ie_fixes.css" />
    <![endif]-->
    <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?php print THEME_BASE_DIR; ?>/ie_fixes_all.css" />
    <![endif]-->
    <?php
// NOTE:  js added via enqueue in functions.php file

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();

    //add ga event tracker
	wp_enqueue_script( 'ga_event_tracker', THEME_BASE_DIR . '/js/event_tracker.js', array( 'jquery') );
    ?>

  </head>

  <body <?php body_class(); ?>>
    <?php if (isset($no_nav)) {
      return;
    } ?>
<?php
require_once("header_nav_inc.php"); // in include so it can also be used by subjectsplus ?>