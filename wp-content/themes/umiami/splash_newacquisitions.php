<?php
/**
 * Template Name: Splash_NewAcquisitionsList
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

date_default_timezone_set('US/Eastern');

$month = sprintf("%02s", (date('m') -1));
$year = date('Y');

get_header(); ?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
  </div>

  <div class="grid_8">
    <div class="breather">

		<div id="primary">
			<div id="content" role="main">
<p>This section links to lists of books and other materials added to the library catalog during the previous month. RSS feeds distribute list updates; a subscription icon <img border="0" src="rssfeed.png"> is included within each category of new materials. <a href="/rssinfo/">About RSS feeds.</a></p>
	
		
		<h6>All Resources Added this Week: <a href="view?view=0">Authors</a> | <a href="view?view=1">Titles</a> | <a href="view?view=2">Call Numbers</a></h6>
		<h6>&nbsp;</h6>
		
		<h6>Distinctive Collections -- <?php echo  date("F",strtotime(-date('j') . ' days')) . ' ' . $year ?></h6>
		<div id="main-collections">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td><ul>
			  <li><a href="view?acq=00<?php echo $year . $month ?>&view=0">Architecture Library</a></li>
			  <li><a href="view?acq=01<?php echo $year . $month ?>&view=0">Contemporary Fiction</a></li>
			  <li><a href="view?acq=02<?php echo $year . $month ?>&view=0">Cuban Heritage Collection</a></li>
			  <li><a href="view?acq=03<?php echo $year . $month ?>&view=0">Government Documents</a></li>
			  <li><a href="view?acq=04<?php echo $year . $month ?>&view=0">Graphic Novels</a></li>
			  <li><a href="view?acq=05<?php echo $year . $month ?>&view=0">Juveline Collection</a></li>
			  <li><a href="view?acq=06<?php echo $year . $month ?>&view=0">Marine Library</a></li>
			  <li><a href="view?acq=07<?php echo $year . $month ?>&view=0">Reference Collection</a></li>
			</ul></td>
		      <td><ul>
	      <li><a href="view?acq=08<?php echo $year . $month ?>&view=0">Video &amp; DVD Collection</a></li>
				<li>Music Library
					<ul>
						<li><a href="view?acq=09<?php echo $year . $month ?>&view=0">Books, Dissertations, Theses</a></li>
						<li>Jazz CD's <a href="view?acq=10<?php echo $year . $month ?>&view=1">Performer/Composer</a> | <a href="view?acq=10<?php echo $year . $month ?>&view=2">Titles</a></li>
						<li>Scores <a href="view?acq=11<?php echo $year . $month ?>&view=1">Composer</a> | <a href="view?acq=11<?php echo $year . $month ?>&view=2">Titles</a></li>
						<li>Sound Recordings <a href="view?acq=12<?php echo $year . $month ?>&view=1">Performer/Composer</a> | <a href="view?acq=12<?php echo $year . $month ?>&view=2">Titles</a></li>
					</ul>
				</li>
				<li><a href="view?acq=13<?php echo $year . $month ?>&view=0">Special Collections</a></li>
			</ul></td>
	        </tr>
	      </table>
		</div>
		<h6>&nbsp;</h6>
		<h6>Richter Library New Acquisitions -- <?php echo date("F",strtotime(-date('j') . ' days')) . ' ' . $year ?></h6>
		<div id="new-acq">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td width="44%"><ul>
			  <li><a href="view?acq=1400<?php echo $year . $month ?>&view=0">Africana</a></li>
			  <li><a href="view?acq=1401<?php echo $year . $month ?>&view=0">Anthropology</a></li>
			  <li><a href="view?acq=1402<?php echo $year . $month ?>&view=0">Architecture</a></li>
			  <li><a href="view?acq=1403<?php echo $year . $month ?>&view=0">Art &amp; Art History</a></li>
			  <li><a href="view?acq=1404<?php echo $year . $month ?>&view=0">Biology</a></li>
			  <li><a href="view?acq=1405<?php echo $year . $month ?>&view=0">Business</a></li>
			  <li><a href="view?acq=1406<?php echo $year . $month ?>&view=0">Chemistry</a></li>
			  <li><a href="view?acq=1407<?php echo $year . $month ?>&view=0">Classics</a></li>
			  <li><a href="view?acq=1408<?php echo $year . $month ?>&view=0">Communication</a></li>
			  <li><a href="view?acq=1409<?php echo $year . $month ?>&view=0">Computer Science</a></li>
			  <li><a href="view?acq=1410<?php echo $year . $month ?>&view=0">Economics</a></li>
			  <li><a href="view?acq=1411<?php echo $year . $month ?>&view=0">Education</a></li>
			  <li><a href="view?acq=1412<?php echo $year . $month ?>&view=0">Engineering</a></li>
			  <li><a href="view?acq=1413<?php echo $year . $month ?>&view=0">English Literature</a></li>
			  <li><a href="view?acq=1414<?php echo $year . $month ?>&view=0">Environmental Science</a></li>
			  <li><a href="view?acq=1415<?php echo $year . $month ?>&view=0">Foreign Languages &amp; Literature</a></li>
			  <li><a href="view?acq=1416<?php echo $year . $month ?>&view=0">Geography &amp; Regional Studies</a></li>
			  <li><a href="view?acq=1417<?php echo $year . $month ?>&view=0">Geology</a></li>
			</ul></td>
		      <td width="56%"><ul>		
	      <li><a href="view?acq=1418<?php echo $year . $month ?>&view=0">Health Science</a></li>
				<li><a href="view?acq=1419<?php echo $year . $month ?>&view=0">History</a></li>
				<li><a href="view?acq=1420<?php echo $year . $month ?>&view=0">International Studies</a></li>
				<li><a href="view?acq=1421<?php echo $year . $month ?>&view=0">Judaic Studies</a></li>
				<li><a href="view?acq=1422<?php echo $year . $month ?>&view=0">Latin American Studies</a></li>
				<li><a href="view?acq=1423<?php echo $year . $month ?>&view=0">Mathematics</a></li>
				<li><a href="view?acq=1424<?php echo $year . $month ?>&view=0">Nursing</a></li>
				<li><a href="view?acq=1425<?php echo $year . $month ?>&view=0">Philosophy</a></li>
				<li><a href="view?acq=1426<?php echo $year . $month ?>&view=0">Physics &amp; Astronomy</a></li>
				<li><a href="view?acq=1427<?php echo $year . $month ?>&view=0">Political Science</a></li>
				<li><a href="view?acq=1428<?php echo $year . $month ?>&view=0">Psychology</a></li>
				<li><a href="view?acq=1429<?php echo $year . $month ?>&view=0">Religious Studies</a></li>
				<li><a href="view?acq=1430<?php echo $year . $month ?>&view=0">Sociology</a></li>
				<li><a href="view?acq=1431<?php echo $year . $month ?>&view=0">Statistics</a></li>
				<li><a href="view?acq=1432<?php echo $year . $month ?>&view=0">Theatre Arts</a></li>
				<li><a href="view?acq=1433<?php echo $year . $month ?>&view=0">Women's Studies</a></li>
			</ul></td>
	        </tr>
	      </table>	
		</div>

			</div><!-- #content -->
		</div><!-- #primary -->
        
            </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
<?php print uml_getTips();
print uml_showStaff(get_field("contact"));  ?>
  </div>
</div><!-- .container_12 -->


<?php get_footer(); ?>
