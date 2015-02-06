<?php
/**
 * Template Name: Splash_Libraries
 * The template for the Books splash page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header();
?>

<?php the_post(); ?>

<div class="container_12 track_me_Page_Click">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="grid_6">
    <div class="breather">
      <h2>Libraries</h2>

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/architecture_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Architecture Library</strong><br />
        <a href="http://arc.miami.edu/the-school/facilities/architecture-reference-library">Paul Buisson Architecture Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/?show_lib=3">Map</a></li>
        <li><a href="/hours/#architecture_lib">Hours</a></li>
      </ul>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/business_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Business Library</strong><br />
        <a href="http://library.miami.edu/business/">Judi Prokop Newman Information Resource Center</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/?show_lib=4">Map</a></li>
        <li><a href="http://library.miami.edu/business/hours/">Hours</a></li>
      </ul>



      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/law_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Law Library *</strong><br />

        <a href="http://www.law.miami.edu/library/">Law Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/">Map</a></li>
        <li><a href="http://www.law.miami.edu/library/hours.php">Hours</a></li>
      </ul>


      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/rsmas.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Marine Library</strong><br />
        <a href="http://www.library.miami.edu/rsmaslib/">Rosenstiel School of Marine and Atmospheric Science Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/?show_lib=6#marine_map">Map</a></li>
        <li><a href="/hours/#marine_lib">Hours</a></li>
      </ul>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/med_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Medical Library *</strong><br />
        <a href="http://calder.med.miami.edu/">Louis Calder Memorial Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="http://calder.med.miami.edu/directions.html">Map</a></li>
        <li><a href="http://calder.med.miami.edu/">Hours</a></li>
      </ul>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/music_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Music Library</strong><br />
        <a href="http://library.miami.edu/musiclib/">Marta and Austin Weeks Music Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/?show_lib=2">Map</a></li>
        <li><a href="/hours/#music_lib">Hours</a></li>
      </ul>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/richter_lib.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/><strong>Richter Library (main)</strong><br />
        <a href="">Otto G. Richter Library</a>
      </p>
      <ul class="horiz_list" style="">
        <li><a href="/maps-directions/?show_lib=1">Map</a></li>
        <li><a href="/hours/">Hours</a></li>
      </ul>

      <br style="clear: both;" />
      <p>* The Law and Medical libraries are administered independently and have separate library catalogs.</p>
    </div></div>
  <div class="grid_6">
    <div class="breather">
      <h2>Collections</h2>

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/chc_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://www.library.miami.edu/chc/">Cuban Heritage Collection</a></strong><br />
        The CHC collects, preserves, and provides access to primary and secondary sources that relate to Cuba and the Cuban diaspora from colonial times to the present.
      </p>

      <br style="clear:both;" />


      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/speccoll_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://www.library.miami.edu/specialcollections/">Special Collections</a></strong><br />
        The Special Collections Department acquires, preserves, and provides access to rare and unique scholarly resources.
      </p>


      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/digcoll_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://merrick.library.miami.edu/cdm/">UM Digital Collections</a></strong><br />
        Digital Collections features a growing collection of digital objects, projects, and publications.
      </p>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/repository_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://scholarlyrepository.miami.edu/">UM Scholarly Repository</a></strong><br />
        The Scholarly Repository features selected research and scholarly works prepared by faculty, students, and staff at UM.
      </p>


      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/archives_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://www.library.miami.edu/universityarchives/">University Archives</a></strong><br />
        The University Archives is the repository of official historical records of the University of Miami.
      </p>

    </div>

  </div>

</div>
<br />



<?php get_footer(); ?>