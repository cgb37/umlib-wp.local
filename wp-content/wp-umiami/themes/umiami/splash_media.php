<?php
/**
 * Template Name: Splash_Media
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
  <div class="grid_12" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
        <div class="phases">
      <h4>Looking for Media?</h4>
      <p>You can limit your catalog search to CDs, DVDs &amp; Video.</p>
    </div>
        <div class="phases">
      <h4>Browsable DVDs</h4>
      <p>We now have browsable DVDs on the first floor of Richter, and <a href="http://library.miami.edu/udvd">UDVD</a> to help you find the one you want.</p>
    </div>
        <div class="phases">
      <h4>How Long?</h4>
      <p>Check our <a href="/borrowing/">borrowing policy</a> to find out how long you can check out an item from the Libraries.</p>
    </div>
            <div class="phases">
      <h4>New Media?</h4>
      <p>See our <a href="/sp/subjects/new_acquisitions.php">new acquisitions</a> to find out the most recent items we own.</p>
    </div>
  </div>
  <div class="grid_8"  style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
    <div style="margin: 1em 0; padding: 1em; ">
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/media.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 3em;"/> Looking for <strong>Music or Movies</strong>?  Start with the catalog:</p>

      <form action="http://catalog.library.miami.edu/search/" method="get" name="search" id="search">
        <input type="hidden" id="iiiFormHandle_1">

        <select name="searchtype" id="searchtype" style="font-size: larger;">
          <option value="X" selected="selected">Keyword</option>
          <option value="t">Title</option>
          <option value="a">Author</option>
          <option value="d">Subject</option>

          <option value="c">LC Call Number</option>

          <option value="l">Local Call Number</option>
          <option value="g">SuDocs Number</option>
          <option value="i">ISSN/ISBN Number</option>
          <option value="o">OCLC Number</option>
          <option value="m">Music Pub. Number</option>
        </select>

        <input type="hidden" name="SORT" id="SORT" value="D" />

        <input maxlength="75" name="searcharg" size="20"  style="font-size: larger;" /><br /><br />

           limit to:
       <select id="label4" name="searchscope"  style="font-size: larger;">
       <option value="17"> DVDs/Videos </option>
       <!--
       <option value="10"> Architecture Library</option>
        <option value="14"> Audiobooks</option>
        <option value="12"> Books (Print)</option>
        <option value="7"> Cuban Heritage Coll</option>
        <option value="13"> E-Books</option>
        <option value="4"> Gov. Documents & Maps</option>
        <option value="2"> Internet Resources</option>
        <option value="1"> Journals & Serials</option>
        <option value="9"> Marine Science Library</option> -->
        <option value="15" selected="selected"> Music CDs</option>
        <option value="8"> Music Library</option>
        <option value="16"> Music Recordings</option>
        <!--<option value="3"> Richter Reference</option>-->
        <option value="18"> Music Scores</option>
        <!--<option value="6"> Special Colls & Archives</option>-->
        <option value="19"> Streaming Audio/Video</option>
        <option value="11">Entire Collection</option>
        </select>

        <input type="hidden" id="iiiFormHandle_1"/>
        <input name="Search" type="submit" id="Search" value="Search"  style="font-size: larger;" />
      </form>

      <br />
      <ul class="horiz_list" style="">
        <li><a href="http://catalog.library.miami.edu/search/X">Advanced Search</a></li>
        <li><a href="http://catalog.library.miami.edu/help">Catalog Help</a></li>
      </ul>
    </div>

  </div>
    <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <div class="tip">
        <h2>Can't Find It?</h2>
        <ul>
          <li><a href="/ask-a-librarian">Ask a Librarian</a></li>
          <li><a href="/interlibrary-loan/">Interlibrary Loan</a></li>
          <li><a href="/suggest-a-purchase/">Suggest a Purchase</a></li>

        </ul>
      </div>
      <div class="tipend"></div>
    </div>
</div>
<br />



<?php get_footer(); ?>
