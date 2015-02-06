<?php
/*
  Template Name: Search Page TEST
 * Doesn't seem to actually do anything.
 */

get_header();
?>
<div class="container_12">    

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
    <?php print $patron_tip; ?>
  </div>

  <div class="grid_8">
    <div class="breather">


      <div id="cse" style="width: 100%;">Loading</div>
      <script src="http://www.google.com/jsapi" type="text/javascript"></script>
      <script type="text/javascript"> 
        var search_term = '<?php print $_GET["s"]; ?>'; // added agd
        google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
        google.setOnLoadCallback(function() {
          var customSearchControl = new google.search.CustomSearchControl(
          '002898155598291241637:l9_tyv9ncva');

          customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
          var options = new google.search.DrawOptions();
          options.setAutoComplete(true);
          customSearchControl.draw('cse', options);
          // Added agd -- also need to set the search_term var above
          if (search_term) {
            customSearchControl.execute(search_term);
          }
        }, true);
      </script>

      <style type="text/css">
        .gsc-control-cse {
          font-family: Arial, sans-serif;
          border-color: #FFFFFF;
          background-color: #FFFFFF;
        }
        input.gsc-input {
          border-color: #777777;
        }
        input.gsc-search-button {
          border-color: #ff9966;
          background-color: #ff6600;
        }
        .gsc-tabHeader.gsc-tabhInactive {
          border-color: #777777;
          background-color: #777777;
        }
        .gsc-tabHeader.gsc-tabhActive {
          border-color: #333333;
          background-color: #333333;
        }
        .gsc-tabsArea {
          border-color: #333333;
        }
        .gsc-webResult.gsc-result,
        .gsc-results .gsc-imageResult {
          border-color: #FFFFFF;
          background-color: #FFFFFF;
        }
        .gsc-webResult.gsc-result:hover,
        .gsc-imageResult:hover {
          border-color: #000000;
          background-color: #FFFFFF;
        }
        .gs-webResult.gs-result a.gs-title:link,
        .gs-webResult.gs-result a.gs-title:link b,
        .gs-imageResult a.gs-title:link,
        .gs-imageResult a.gs-title:link b {
          color: #ff6600;
        }
        .gs-webResult.gs-result a.gs-title:visited,
        .gs-webResult.gs-result a.gs-title:visited b,
        .gs-imageResult a.gs-title:visited,
        .gs-imageResult a.gs-title:visited b {
          color: #ff6600;
        }
        .gs-webResult.gs-result a.gs-title:hover,
        .gs-webResult.gs-result a.gs-title:hover b,
        .gs-imageResult a.gs-title:hover,
        .gs-imageResult a.gs-title:hover b {
          color: #444444;
        }
        .gs-webResult.gs-result a.gs-title:active,
        .gs-webResult.gs-result a.gs-title:active b,
        .gs-imageResult a.gs-title:active,
        .gs-imageResult a.gs-title:active b {
          color: #777777;
        }
        .gsc-cursor-page {
          color: #ff6600;
        }
        a.gsc-trailing-more-results:link {
          color: #ff6600;
        }
        .gs-webResult .gs-snippet,
        .gs-imageResult .gs-snippet,
        .gs-fileFormatType {
          color: #333333;
        }
        .gs-webResult div.gs-visibleUrl,
        .gs-imageResult div.gs-visibleUrl {
          color: #cccccc;
        }
        .gs-webResult div.gs-visibleUrl-short {
          color: #cccccc;
        }
        .gs-webResult div.gs-visibleUrl-short {
          display: none;
        }
        .gs-webResult div.gs-visibleUrl-long {
          display: block;
        }
        .gsc-cursor-box {
          border-color: #FFFFFF;
        }
        .gsc-results .gsc-cursor-box .gsc-cursor-page {
          border-color: #777777;
          background-color: #FFFFFF;
          color: #ff6600;
        }
        .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
          border-color: #333333;
          background-color: #333333;
          color: #ff6600;
        }
        .gs-promotion {
          border-color: #CCCCCC;
          background-color: #E6E6E6;
        }
        .gs-promotion a.gs-title:link,
        .gs-promotion a.gs-title:link *,
        .gs-promotion .gs-snippet a:link {
          color: #0000CC;
        }
        .gs-promotion a.gs-title:visited,
        .gs-promotion a.gs-title:visited *,
        .gs-promotion .gs-snippet a:visited {
          color: #0000CC;
        }
        .gs-promotion a.gs-title:hover,
        .gs-promotion a.gs-title:hover *,
        .gs-promotion .gs-snippet a:hover {
          color: #444444;
        }
        .gs-promotion a.gs-title:active,
        .gs-promotion a.gs-title:active *,
        .gs-promotion .gs-snippet a:active {
          color: #00CC00;
        }
        .gs-promotion .gs-snippet,
        .gs-promotion .gs-title .gs-promotion-title-right,
        .gs-promotion .gs-title .gs-promotion-title-right *  {
          color: #333333;
        }
        .gs-promotion .gs-visibleUrl,
        .gs-promotion .gs-visibleUrl-short {
          color: #00CC00;
        }
      </style>

    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <?php print uml_getTips(); ?>
  </div>
</div><!-- .container_12 -->

<?php get_footer(); ?>