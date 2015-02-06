<?php
/**
 * Template Name: Splash_Books
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

<div class="container_12">
  <div class="grid_12" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
    <div class="phases">
      <h4>Looking for Books?</h4>
      <p>Use the library catalog (search box below).  We also have <a href="/sp/subjects/databases.php?letter=ebooks">ebooks</a> and <a href="/sp/subjects/databases.php?letter=audiobooks">audiobooks</a>.</p>
    </div>
    <div class="phases">    
      <h4>New Books?</h4>
      <p>See our <a href="/new-acquisitions/">new acquisitions</a> to find out the most recent books we own, sorted by subject areas.</p>
    </div>
    <div class="phases">
      <h4>How Long?</h4>
      <p>Check our <a href="/borrowing/">borrowing policy</a> to find out how long you can check out an item from the Libraries.</p>
    </div>
    <div class="phases">    
      <h4>My Books</h4>
      <p><a href="http://catalog.library.miami.edu/patroninfo">Log in to MyLibrary</a> to see what you have  checked out.  <a href="https://triton.library.miami.edu/">Use ILLiad</a> to check on ILL items.</p>
    </div>
  </div>
  <div class="grid_8" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
    <div class="breather">
      <br />
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/book.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/> Looking for <strong>books</strong>?  Start with the catalog:</p>

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

        <input maxlength="75" name="searcharg" size="20"  style="font-size: larger;" />

        <input type="hidden" id="iiiFormHandle_1"/>
        <input name="Search" type="submit" id="Search" value="Search" style="font-size: larger;" />
      </form>
      <br />
      <ul class="horiz_list" style="">
        <li><a href="http://catalog.library.miami.edu/search/X">Advanced Search</a></li>
        <li><a href="http://catalog.library.miami.edu/help">Catalog Help</a></li>
      </ul>

      <br style="clear:both;" />

    </div></div>
  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <div class="tip">
      <h2>Can't Find It?</h2>
      <ul>
        <li><a href="http://catalog.library.miami.edu/help">Search Tips</a></li>
        <li><a href="/ask-a-librarian/">Ask a Librarian</a></li>
        <li><a href="/interlibrary-loan/">Interlibrary Loan</a></li>
        <li><a href="http://catalog.library.miami.edu/acquire">Suggest a Purchase</a></li>

      </ul>
    </div>
    <div class="tipend"></div>
  </div>

</div>
<br />



<?php get_footer(); ?>