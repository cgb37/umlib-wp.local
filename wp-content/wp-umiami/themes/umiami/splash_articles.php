<?php
/**
 * Template Name: Splash_Articles
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
      <h4>Search Everything!</h4>
      <p>Use Articles+ search to search across many databases and journals at the same time.</p>
    </div>
    <div class="phases">
      <h4>Favorite Database?</h4>
      <p>Databases aggregate articles from many different journals.  Look for your favorite in the A-Z list below.</p>
    </div>
    <div class="phases">
      <h4>Favorite Journal?</h4>
      <p>If you want to browse or search a specific journal, use the Journals section below.</p>
    </div>
    <div class="phases">
      <h4>Scholarly?</h4>
      <p>New to Research? Check out our <a href="/getting-started/">guide to getting started</a>.</p>
    </div>
  </div>
  <div class="grid_8">
    <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <br />
      <p> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/article.gif" align="left" style="float: left; margin-right: 1em; margin-bottom: 2em;"/> Want to search for articles across many databases?  Try Articles+.</p>
      
      <form action="http://miami.summon.serialssolutions.com/search" method="GET" id="summon_search">
        <input type="hidden" value="ContentType,Newspaper Article, true" name="s.fvf[]" />
        <input type="hidden" value="ContentType,Book Review, true" name="s.fvf[]" />
        <input type="hidden" value="ContentType,Trade Publication Article, true" name="s.fvf[]" />
        <input type="text" name="s.q" value="" size="40" />
        <input type="submit" value="Search" /> &nbsp;
      </form>

      <br />
      <ul class="horiz_list" style="">
        <!--<li><a href="/summon-about/">About Articles+ (aka Summon)</a></li>-->
        <li><a href="/summon-help/">Articles+ Help</a></li>
      </ul>

      <br style="clear:both;" />
    </div>
    <div class="breather" style="border-bottom: 1px dashed #f37421; padding-bottom: 1em;">
      <h2 style="border: none; color: #f37421;">Databases A-Z</h2>

      <?php
      //$letters = array ("A", "B", "C");
      $db_path = PATH_TO_SP . "subjects/databases.php?letter=";
      $letters = range('A', 'Z');

      $alphabet = getLetters($letters, $_GET["letter"], 0, $db_path, '', 0);
      print $alphabet;
      ?>

      <ul class="horiz_list" style="margin-top: 1em;">
        <li><a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bysub">Database by Subject</a></li>
        <li><a href="<?php print PATH_TO_SP; ?>subjects/databases.php?letter=bytype">Database by Type</a></li>
      </ul>

    </div>
    <div class="breather">
      <h2 style="border: none; color: #f37421;">Journals</h2>

      <?php
      /*
        //$letters = array ("A", "B", "C");
        // http://mt7kx4ww9u.search.serialssolutions.com/?V=1.0&L=MT7KX4WW9U&N=100&S=T_AZ&C=J

        $letters = range('A', 'Z');
        $alphabet2 = getLetters($letters, $_GET["letter"], 0, "http://mt7kx4ww9u.search.serialssolutions.com/?V=1.0&L=MT7KX4WW9U&N=100&S=T_AZ&C=");
        print $alphabet2;

       */
      ?>
      <div style="float: left; width: 175px;"><strong>Search Journals:</strong></div>
      <div style="float: left;">
        <form method="get" action="http://mt7kx4ww9u.search.serialssolutions.com/" name="SS_EJPSearchForm">
          <input value="1.0" name="V" type="hidden" />
          <input value="125" name="N" type="hidden" />
          <input type="hidden" name="L" value="MT7KX4WW9U" />
          <select name="S">
            <option value="AC_T_B">Title begins with</option>
            <option value="AC_T_M">Title equals</option>
            <option value="T_W_A">Title contains all words</option>
            <option value="I_M">ISSN equals</option>
          </select>
          <input id="SS_CFocusTag" name="C" />
          <input value="Search" type="Submit" />
        </form>
      </div>
      <br style="clear: both;" /><br />
      <div style="float: left; width: 175px;"><strong>Browse Journals:</strong></div>
      <div style="float: left;">
        <form method="get" action="http://mt7kx4ww9u.search.serialssolutions.com/">
          <input value="1.0" name="V" type="hidden" />
          <input value="MT7KX4WW9U" name="L" type="hidden" />
          <input value="SC" name="S" type="hidden" />
          <select name="C">
            <option value="">-- Please select a subject category --</option>
            <option value="01">Art, Architecture &amp; Applied Arts</option>
            <option value="BU">Business &amp; Economics</option>
            <option value="11">Earth &amp; Environmental Sciences</option>
            <option value="TE">Engineering &amp; Applied Sciences</option>
            <option value="GI">General</option>
            <option value="HE">Health &amp; Biological Sciences</option>
            <option value="06">History &amp; Archaeology</option>
            <option value="07">Journalism &amp; Communications</option>
            <option value="08">Languages &amp; Literatures</option>
            <option value="GO">Law, Politics &amp; Government</option>
            <option value="10">Music, Dance, Drama &amp; Film</option>
            <option value="RE">Philosophy &amp; Religion</option>
            <option value="LS">Physical Sciences &amp; Mathematics</option>
            <option value="SO">Social Sciences</option>
          </select>
          <input value="Search" type="submit" />

        </form>

      </div>

    </div>
    <br class="clear" />
          <ul class="horiz_list" style="margin-top: 1em;">
        <li><a href="http://mt7kx4ww9u.search.serialssolutions.com/">Journal List home</a></li>
      </ul>

  </div>
  <div class="grid_4"  <?php uml_setSidebarBgImg(); ?>>
    <div class="tip">
      <h2>Have a Citation (and want the article)?</h2>
      <ul>
        <li><a href="http://mt7kx4ww9u.search.serialssolutions.com/?SS_Page=refiner&SS_RefinerEditable=yes">Citation Linker</a></li>
        <li><a href="miami.summon.serialssolutions.com/search">Search Articles+</a></li>
        <li><a href="/sp/subjects/faq.php?faq_id=10">LibX toolbar</a></li>
      </ul>
    </div>
    <div class="tipend"></div>
    <div class="tip">
      <h2>Have an Article (and want to cite it)?</h2>
      <p>These tools can help you format and organize your citations:</p>
      <ul>
        <li><a href="http://www.easybib.com/">EasyBib</a></li>
        <li><a href="/citation-style-guides/">Online Citation Style Guides</a></li>
        <li><a href="/plagiarism/">Plagiarism (don't do it)</a></li>

      </ul>
    </div>
    <div class="tipend"></div>
  </div>
</div>
<br />



<?php get_footer(); ?>