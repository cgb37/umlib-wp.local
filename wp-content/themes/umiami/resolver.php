<?php

/*
 * Deal with search strings
 *
 */

ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

include("../../../wp-blog-header.php");
//print_r($_POST);

$clean = array();
$clean["searchterms"] = sanitize_text_field($_POST['searchterms']);
$clean["searchtype"] = sanitize_text_field($_POST['searchtype']);
$clean["quick_links"] = esc_url($_POST['quick_links']);

if ($clean["searchterms"] == "") {
  $clean["searchterms"] = "NULL";
}
// This is for when someone submits a quick link from home page with javascript turned off
if (isset($clean["quick_links"]) && $clean["quick_links"] != "") {
  $string = $clean["quick_links"];
  header("Location: $string");
  break;
}


// make entry into database
  // connect
  $wpdb_sp = new wpdb(SP_USERNAME, SP_PASSWORD, SP_DB, SP_HOSTNAME);
  //$wpdb_sp->show_errors();

  $q = "INSERT INTO site_searches (term, type) VALUES ('" . $clean["searchterms"] . "', '" . $clean["searchtype"] . "')";

  $entry = $wpdb_sp->get_results($q);


switch ($clean["searchtype"]) {
  case "website":
    $string =    "http://library.miami.edu" . "/?s=" . $clean["searchterms"] . "&submit=Search";
    header("Location: $string");
    //$display_text = "This would do a website search for <strong>" . $clean["searchterms"] . "</strong>.";

    break;
  case "catalog_keyword":
    $string ="http://catalog.library.miami.edu/search/?searchtype=X&searcharg=" . $clean["searchterms"] . "&Search=SEARCH&searchscope=11";
    header("Location: $string");
    break;
  case "article":
    $string = "http://miami.summon.serialssolutions.com/search?s.fvf[]=ContentType%2CNewspaper+Article%2C+true&s.fvf[]=ContentType%2CBook+Review%2C+true&s.fvf[]=ContentType%2CTrade+Publication+Article%2C+true&s.q=" . $clean["searchterms"];
    header("Location: $string");
    break;
  case "digital":
    $string = "http://merrick.library.miami.edu/cdm4/results.php?CISOOP1=all&CISOFIELD1=CISOSEARCHALL&CISORESTMP=results.php&CISOVIEWTMP=item_viewer.php&CISOMODE=thumb&CISOGRID=thumbnail%2Ca%2C1%3Btitle%2Ca%2C1%3Bsubjec%2Ca%2C0%3Bdescri%2C200%2C0%3Bnone%2Ca%2C0%3B20%3Brelevancy%2Cnone%2Cnone%2Cnone%2Cnone&CISOBIB=title%2Ca%2C1%2CN%3Bsubjec%2Ca%2C0%2CN%3Bdescri%2C200%2C0%2CN%3Bnone%2Ca%2C0%2CN%3Bnone%2Ca%2C0%2CN%3B20%3Brelevancy%2Cnone%2Cnone%2Cnone%2Cnone&CISOTHUMB=20+%285x4%29%3Btitle%2Cnone%2Cnone%2Cnone%2Cnone&CISOTITLE=20%3Btitle%2Cnone%2Cnone%2Cnone%2Cnone&CISOHIERA=20%3Bsubjec%2Ctitle%2Cnone%2Cnone%2Cnone&CISOSUPPRESS=1&CISOBOX1=" . $clean["searchterms"] . "&CISOROOT=all";
    header("Location: $string");
    break;
}
get_header();
the_post();
?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title">Website Search</h1>
    </header><!-- .entry-header -->
  </div>
  <div class="breather">
  <p><?php print $display_text; ?></p>
  </div>
</div>

<?php
get_footer();

?>
