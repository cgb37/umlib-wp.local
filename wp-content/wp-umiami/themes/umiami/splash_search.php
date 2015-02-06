<?php
/**
 * Template Name: Splash_Search
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
    <div class="breather"><p>These are the major
        search tools that can be used to find resources owned or licensed by the UM Libraries.   If you need help with your
        searching, please use our <a href="/ask-a-librarian/">Ask A Librarian</a> service.</p></div>
    <br />
  </div>

  <div class="grid_7">
    <div class="breather">      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/articlesplus_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://miami.summon.serialssolutions.com/">Articles+</a></strong><br />
        Find full-text articles from journals and newspapers,
        plus records from the catalog and digital collections.
        It is a good place to start your research. <a href="http://library.miami.edu/summon/">more</a>
      </p></div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  Narrow your search results by format, subject, date, etc. by using the filters on the left side of the search results screen.   If you already have an article citation, use Citation Linker to go directly to the article.</p></div>
  <br style="clear: both;" />
  <br />
  <div class="grid_7">
    <div class="breather">      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/catalog_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://catalog.library.miami.edu/">Library Catalog</a></strong><br />
        Find books, DVDs, music, maps, special collections materials, and other items owned by the Libraries.  Great if you are looking for a specific item. <a href="http://catalog.library.miami.edu/help">more</a>
      </p>
    </div>
  </div>
  <div class="grid_5">      <p class="searchtip">Tip:  Use the search drop-downs to select a search index and limit your search to a particular branch library or format.</p>
    <p class="searchtip">Tip: If the Library doesn't own the book you need, use our <a href="/interlibrary-loan/">Interlibrary Loan</a> service to borrow it from another library.</p>
  </div>
  <br style="clear: both;" />
  <br />

  <div class="grid_7">
    <div class="breather"><p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/citation_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;" alt="photo by Flickr user Lall" /><strong><a href="http://mt7kx4ww9u.search.serialssolutions.com/?SS_Page=refiner&SS_RefinerEditable=yes">Citation Linker</a></strong><br />
        Use if you already have a citation to an article or paper and want the full text.
      </p>
    </div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  You need to include at least the journal title and start page number in order to look up a citation.
      Use Articles+ if your Citation Linker search is unsuccessful, or if you have incomplete citation information.</p></div>
  <br style="clear: both;" />
  <br />

  <div class="grid_7">
    <div class="breather"><p> <img alt="Image by Flickr user eurleif" class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/databases_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://new.library.miami.edu/sp/subjects/databases.php">Databases</a></strong><br />
        Find the titles of databases, or browse databases by subject or format.
        This will only identify databases that might be helpful to you,
        <strong>it will not search within the databases themselves</strong>.   Databases include indexes,
        abstracts, and full-text articles from a variety of sources and may
        contain digital images, video, and audio files.
      </p>
    </div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  See <a href="http://libguides.miami.edu/">Subject Guides</a> for lists of core databases for broad subject areas, or consult with a <a href="http://new.library.miami.edu/sp/subjects/staff.php?letter=Subject%20Librarians%20A-Z">Subject Librarian</a>.</p></div>
  <br style="clear: both;" />
  <br />

  <div class="grid_7">
    <div class="breather"><p> <img alt="Image based on one by Flickr user Firebottle" class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/journals_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://mt7kx4ww9u.search.serialssolutions.com/">E-Journals</a></strong><br />
        Find the titles of e-journals or browse e-journals by subject.
        <strong>This search will not search within the e-journals themselves.</strong> </div>
  </div>
  <div class="grid_5"></div>
  <br style="clear: both;" />
  <br />

  <div class="grid_7">
    <div class="breather">      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/um_digital_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://merrick.library.miami.edu/digital_initiatives.php">UM Digital Collections</a></strong><br />
        Find digitized images, letters, streaming videos and more from UM's unique &amp; special collections.  <a href="http://merrick.library.miami.edu/cdm4/help.php">more</a>
      </p>
    </div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  You can browse UM Digital Collections by collection and repository, and narrow your search by subject, creator, format, time period, and place.</p></div>
  <br style="clear: both;" />
  <br />

  <div class="grid_7">
    <div class="breather"><p> <img alt="Image by Flickr user Muffet" class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/manuscript_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://scholarlyrepository.miami.edu/">UM Manuscript Collections / Finding Aids</a></strong><br />
        Find manuscript and archival collections owned by Special Collections,
        the Cuban Heritage Collection, University Archives, or one of our branch libraries.  Finding Aids describe
        the historical context, content, creator(s), materials, and organization of the Libraries' manuscript & archival collections.   These collections typically contain papers, correspondence, photos, postcards, memorabilia,
        etc. from individuals, such as the Margory Stoneman Douglas Collection, or from organizations, such as the Pan Am Collection.
      </p>
    </div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  You can browse Finding Aids by collections, subject, creator, or repository.
      Click the "Request" link next to each collection title to request materials from that collection.
      Manuscript & archival collections may only be used within the special collections department/repository holding the collection.</p></div>

  <br style="clear: both;" />
  <br />
  <div class="grid_7">
    <div class="breather"> <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/repository_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://scholarlyrepository.miami.edu/">UM Electronic Theses &amp; Dissertations</a></strong><br />
        Find the electronic theses and dissertations written
        at UM, as well as selected research and scholarly works prepared by UM faculty,
        students, and staff.  Items published in the Repository include published articles, conference papers,
        proceedings, lectures, projects, reports, and presentations. <a href="http://scholarlyrepository.miami.edu/faq.html">more</a>
      </p>
      </div>
  </div>
  <div class="grid_5"><p class="searchtip">Tip:  You can browse the materials held in the Scholarly Repository by collection, discipline, and author.</p></div>
  <br style="clear: both;" />
  <br />

<!--

images:  http://www.flickr.com/photos/calliope/306564541/
http://www.flickr.com/photos/eurleif/255241547/
http://www.flickr.com/photos/thefirebottle/122895549/
  <div class="grid_6">
    <div class="breather">
      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/articlesplus_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://miami.summon.serialssolutions.com/">Articles+</a></strong><br />
        Find full-text articles from journals and newspapers,
        plus records from the catalog and digital collections.
        It is a good place to start your research. <a href="http://www.library.miami.edu/search/summon/">more</a>
      </p>
      <p class="searchtip">Tip:  Narrow your search results by format, subject, date, etc. by using the filters on the left side of the search results screen.   If you already have an article citation, use Citation Linker to go directly to the article.</p>

      <br style="clear:both;" />


      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/catalog_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://catalog.library.miami.edu/">Library Catalog</a></strong><br />
        Find books, DVDs, music, maps, special collections materials, and other items owned by the Libraries.  Great if you are looking for a specific item. <a href="http://catalog.library.miami.edu/help">more</a>
      </p>
      <p class="searchtip">Tip:  Use the search drop-downs to select a search index and limit your search to a particular branch library or format.</p>
      <p class="searchtip">Tip: If the Library doesn't own the book you need, use our <a href="/interlibrary-loan/">Interlibrary Loan</a> service to borrow it from another library.</p>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/citation_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://mt7kx4ww9u.search.serialssolutions.com/?SS_Page=refiner&SS_RefinerEditable=yes">Citation Linker</a></strong><br />
        Use if you already have a citation to an article or paper and want the full text.
      </p>
      <p class="searchtip">Tip:  You need to include at least the journal title and start page number in order to look up a citation.
        Use Articles+ if your Citation Linker search is unsuccessful, or if you have incomplete citation information.</p>

      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/archives_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://dev-www.library.miami.edu/sp/subjects/databases.php">Databases</a></strong><br />
        Find the titles of databases, or browse databases by subject or format.
        The Databases Search will only identify databases that might be helpful to you,
        <strong>it will not search within the databases themselves</strong>.   Databases include indexes,
        abstracts, and full-text articles from a variety of sources and may also
        contain specialized content like digital images, video, and audio files.
      </p>
      <p class="searchtip">Tip:  See <a href="http://libguides.miami.edu/">Subject Guides</a> for lists of core databases for broad subject areas, or consult with a <a href="http://dev-www.library.miami.edu/sp/subjects/staff.php?letter=Subject%20Librarians%20A-Z">Subject Librarian</a>.</p>
      <br style="clear:both;" />
      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/archives_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://mt7kx4ww9u.search.serialssolutions.com/">E-Journals</a></strong><br />
        Find the titles of e-journals or browse e-journals by subject.
        <strong>This search will not search within the e-journals themselves.</strong>
      </p>

      <br style="clear:both;" />
    </div>
  </div>
  <div class="grid_6">
    <div class="breather">
      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/digcoll_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://merrick.library.miami.edu/digital_initiatives.php">UM Digital Collections</a></strong><br />
        Find digitized images, letters, streaming videos and more from UM's unique &amp; special collections.  <a href="http://merrick.library.miami.edu/cdm4/help.php">more</a>
      </p>
      <p class="searchtip">Tip:  You can browse UM Digital Collections by collection and repository, and narrow your search by subject, creator, format, time period, and place.</p>
      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/repository_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://scholarlyrepository.miami.edu/">UM Manuscript Collections / Finding Aids</a></strong><br />
        Find manuscript and archival collections owned by Special Collections,
        the Cuban Heritage Collection, University Archives, or one of our branch libraries.  Finding Aids describe
        the historical context, content, creator(s), materials, and organization of the Libraries' manuscript & archival collections.   These collections typically contain papers, correspondence, photos, postcards, memorabilia,
        etc. from individuals, such as the Margory Stoneman Douglas Collection, or from organizations, such as the Pan Am Collection.
      </p>
      <p class="searchtip">Tip:  You can browse Finding Aids by collections, subject, creator, or repository.
        Click the "Request" link next to each collection title to request materials from that collection.
        Manuscript & archival collections may only be used within the special collections department/repository holding the collection.</p>
      <br style="clear:both;" />

      <p> <img class="lib_pix" src="<?php bloginfo('stylesheet_directory'); ?>/images/repository_icon.jpg" align="left" style="float: left; margin-right: 1em; margin-bottom: 0em;"/><strong><a href="http://scholarlyrepository.miami.edu/">UM Electronic Theses &amp; Dissertations</a></strong><br />
        Find the electronic theses and dissertations written
        at UM, as well as selected research and scholarly works prepared by UM faculty,
        students, and staff.  Items published in the Repository include published articles, conference papers,
        proceedings, lectures, projects, reports, and presentations. <a href="http://scholarlyrepository.miami.edu/faq.html">more</a>
      </p>
      <p class="searchtip">Tip:  You can browse the materials held in the Scholarly Repository by collection, discipline, and author.</p>
    </div>
  </div>


-->

</div>

<br />



<?php get_footer(); ?>
