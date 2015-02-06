<?php
/**
 * Template Name: Page_DB_List
 * The template for the db list splash page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0


ini_set('display_errors',1);
error_reporting(E_ALL ^ E_NOTICE); 

define('EXT_DB_HOST', 'localhost');   // You can connect to any DB you have access to
define('EXT_DB_NAME', 'sp');  	  // The name of the database
define('EXT_DB_USER', 'root');   	  // Your MySQL username
define('EXT_DB_PASSWORD', ''); 			// ...and password
define('EXT_DB_CHARSET', 'utf8');		// ... and charset - if you need to

MYSQL_CONNECT(EXT_DB_HOST, EXT_DB_USER, EXT_DB_PASSWORD) OR DIE("Unable to connect to database");

    @mysql_select_db(EXT_DB_NAME) or die("Unable to select database");
 
 
require_once($_SERVER["DOCUMENT_ROOT"] . "/sp/control/includes/config.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/sp/control/includes/functions.php");
 */

if (get_field("sidebar_tips")) {
  $tip_text = get_field("sidebar_tips");
  $the_tip = "<div class=\"tip\">" . $tip_text . "</div>";
}

// Check for personalizations
$tip_faculty = get_field("faculty_tips");
$tip_undergrad = get_field("undergrad_tips");
$tip_graduate = get_field("grad_tips");
$tip_alumni = get_field("alum_tips");

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

get_header();

?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
    <?php print $patron_tip; ?>
  </div>
  <div class="grid_8" style="">    
    <?php 
    //$letters = array ("A", "B", "C");
    $letters = range('A', 'Z');
    $alphabet = getLetters($letters, $_GET["letter"], 0, 'databases/');
    print $alphabet;
    ?>

<p>Here be databases beginning with that letter.</p>

  </div>
  <div class="grid_4" style="background: url(<?php bloginfo('stylesheet_directory'); ?>/images/books_bg.jpg); min-height: 500px; background-repeat: no-repeat;">
    <?php print $the_tip; ?>
  </div>
</div>

<?php get_footer(); ?>
