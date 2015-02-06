<?php
/**
 * Template Name: Splash_Books
 * The template for the Books splash page.
 *
 * @package WordPress
 * @subpackage umiami
 */
get_header();
?>

<?php the_post(); ?>

<div class="container_12 track_me_Page_Click">
  <div class="grid_12 dashit">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <div class="phases">
      <h4>Looking for Books?</h4>
      <p>Use the library catalog (search box below).  We also have <a href="http://library.miami.edu/sp/subjects/databases.php?letter=bytype&type=E-Books">ebooks</a>.</p>
    </div>
    <div class="phases">
      <h4>New Books?</h4>
      <p>See our <a href="/sp/subjects/new_acquisitions.php">new acquisitions</a> to find out the most recent books we own, sorted by subject areas.</p>
    </div>
    <div class="phases">
      <h4>How Long?</h4>
      <p>Check our <a href="/borrowing/">borrowing policy</a> to find out how long you can check out an item from the Libraries.</p>
    </div>
    <div class="phases">
      <h4>My Books</h4>
      <p><a href="https://catalog.library.miami.edu/patroninfo">Log in to MyLibrary</a> to see what you have  checked out.  <a href="https://triton.library.miami.edu/">Use ILLiad</a> to check on ILL items.</p>
    </div>
  </div>
  <div class="grid_8 dashit">
    <div class="breather">
      <br />
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/book.gif" style="float: left; margin-right: 1em; margin-bottom: 2em;"/> Looking for <strong>books</strong>?  Start with the catalog:</p>

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
        <p><br />
          <input type="radio" name="searchscope" value="12" /> Books (Print)
          <input type="radio" name="searchscope" value="14" /> Audio Books
          <input type="radio" name="searchscope" value="13" /> E-Books
          <input type="radio" name="searchscope" value="11" checked="checked" /> Entire Collection
        </p>
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
        <li><a href="/suggest-a-purchase/">Suggest a Purchase</a></li>

      </ul>
    </div>
    <div class="tipend"></div>
        <div class="tip">
      <h2>Overdrive for E-Books</h2>
      <a href="http://miami.lib.overdrive.com/"><img src="http://library.miami.edu/wp-content/themes/umiami/images/overdrive_promo.jpg" width="280" alt="E-books" /></a>
    </div>
    <div class="tipend"></div>
  </div>

</div>
<br />



<?php get_footer(); ?>