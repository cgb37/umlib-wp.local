<?php
/**
 * Template Name: Splash_Redirect
 *
 * To use with plugin UM Track and Redirect
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
?>
<html>
<head>
<title><?php the_title(); ?></title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
</head>
<body>
<?php the_post(); ?>
<?php the_content(); ?>
</body>