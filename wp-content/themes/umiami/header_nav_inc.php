<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15217512-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php
// Rotate Librarian images
$many_librarians = array("lbaker", "l.fralinger", "billjac", "trobar", "astoute", "a.clark", "mestorino", "cfavretto", "efish", "djui", "meimendez", "gsantana", "bskokan", "a.strickland", "nzavac");
$key = array_rand($many_librarians);
$random_librarian = $many_librarians[$key];

// Rotate Library images
$many_libraries = array(
  "Architecture Library" => array ("Architecture Library","http://library.miami.edu/architecture/","architecture_lib.jpg"),
  "Business Library" => array ("Business Library","http://library.miami.edu/business/","business_lib.jpg"),
  "Law Library" => array ("Law Library","http://www.law.miami.edu/library/", "law_lib.jpg"),
  "Marine Library" => array ("Marine Library","http://www.library.miami.edu/rsmaslib/", "rsmas.jpg"),
  "Medical Library" => array ("Medical Library","http://calder.med.miami.edu/", "med_lib.jpg"),
  "Music Library" => array ("Music Library","http://library.miami.edu/musiclib/", "music_lib.jpg"),
  "Richter Library (main)" => array ("Richter Library (main)","http://library.miami.edu/libraries-collections/", "richter_lib.jpg")
  );
$key2 = array_rand($many_libraries);
$rlib_name = $many_libraries[$key2][0];
$rlib_url = $many_libraries[$key2][1];
$rlib_img = $many_libraries[$key2][2];

?>
<div id="wrapper">
  <div id="supernav" class="track_me_TopNavigation_Click" >
    <div id="superzone">
      <div id="logo"><a href="<?php print PATH_FROM_ROOT; ?>/index.php"><img src="<?php print THEME_BASE_DIR; ?>/images/logo.png" alt="University of Miami Libraries" border="0" /></a></div>

        <?php
            if (IS_INDEX) {
                $get_date = date("Y-m-d");
                $weekday = date("l");

                $openHours = new Open_Hours();
                $today = $openHours->get_branch_hours();

                $todays_hours = array();
            }
        ?>
        <?php if (IS_INDEX) { ?>
            <div class="icon"><img src="<?php print THEME_BASE_DIR; ?>/images/clock_green.png" alt="clock" /></div>
            <div class="text hours tour_1" style="margin-right: 50px;"><a href="<?php print PATH_FROM_ROOT; ?>/hours/" title="Click to see more hours">Richter hours:<br />
                    <?php
                    if($today['is_holiday'] == true) {
                        if($today['is_closed'] == 2) {
                            echo 'Closed';
                        } else {
                            echo $today['open']." - ".$today['close'];
                        }
                    } else {
                        echo $today['open']." - ".$today['close'];
                    }

                    ?></a>
            </div>
        <?php } ?>

      <div class="icon"><img src="<?php print THEME_BASE_DIR; ?>/images/question_green.png" alt="ask a librarian" /></div>
      <div class="text tour_2"><a href="<?php print PATH_FROM_ROOT; ?>/ask-a-librarian/">Ask a Librarian</a></div>

      <div class="icon" style="margin-left: 50px;"><img src="<?php print THEME_BASE_DIR; ?>/images/talk_bubble_green.png" alt="tell us" /></div>
      <div class="text tour_3"><a href="<?php print PATH_TO_SP; ?>subjects/talkback.php">Comments</a> <span id="new_comment"></span></div>

      <?php if (!IS_INDEX) { ?>
        <form id="head_search" action="<?php print THEME_BASE_DIR; ?>/resolver.php" method="post">
          <div id="search_container">
            <fieldset style="" id="searchzone">
              <input type="text" name="searchterms" id="searchy" autocomplete="off"  />
              <input type="submit" value="go" id="topsearch_button2" name="submitsearch" alt="Search" />
            </fieldset>
            <fieldset id="search_options">
              <ul>
                <li class="active"><input type="radio" name="searchtype" value="website" checked="checked" />website</li>
                <li><input type="radio" name="searchtype" value="catalog_keyword" />catalog</li>
                <li><input type="radio" name="searchtype" value="article" />articles+</li>
                <li style="border: none;"><input type="radio" name="searchtype" value="digital" />digital collections</li>
              </ul>
            </fieldset>
          </div>
        </form>

      <?php } ?>

    </div>
  </div>

  <div id="header">
    <div id="nav" class="track_me_Navigation_Click">
      <ul id="nav_menu">
        <li class="tight mega"><a href="<?php print PATH_FROM_ROOT; ?>/books/">BOOKS</a>
        <div style="left: 0em; width: 380px;" class="mega_child">
        <div style="background-color: transparent;
    border: medium none;
    display: block;
    float: left;
    line-height: 1.2em;
    margin: 1em;
    min-height: 20px;
    padding: 0 1em;
    position: relative;">
        <p>Looking for books? Start with the catalog:</p>
      <form action="http://catalog.library.miami.edu/search/" method="get" name="search" id="search">
        <input type="hidden" id="iiiFormHandle_1">

        <select name="searchtype" id="searchtype">
          <option value="X" selected="selected">Keyword</option>
          <option value="t">Title</option>
          <option value="a">Author</option>
          <option value="d">Subject</option>
<!--
          <option value="c">LC Call Number</option>

          <option value="l">Local Call Number</option>
          <option value="g">SuDocs Number</option>
          <option value="i">ISSN/ISBN Number</option>
          <option value="o">OCLC Number</option>
          <option value="m">Music Pub. Number</option> -->
        </select>

        <input type="hidden" name="SORT" id="SORT" value="D" />

        <input maxlength="75" name="searcharg" size="20" />

        <input type="hidden" id="iiiFormHandle_1"/>
        <input name="Search" type="submit" id="Search" value="Search" />
      </form>
        </div>
            <ul>
              <li><a href="http://catalog.library.miami.edu/">Catalog home</a></li>
              <li><a href="<?php print PATH_TO_SP; ?>subjects/new_acquisitions.php">New Acquisitions</a></li>
            </ul>
            <ul>
              <li><a href="http://miami.lib.overdrive.com/">Overdrive E-Books</a></li>
            </ul>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/books/">Books Overview</a>, <a href="<?php print PATH_FROM_ROOT; ?>/suggest-a-purchase/">Recommend a Purchase</a></div>
          </div></li>
        <li class="tight tour_4 mega"><a href="<?php print PATH_FROM_ROOT; ?>/articles/">ARTICLES</a>
                <div style="left: 0em; width: 380px;" class="mega_child">
        <div style="background-color: transparent;
    border: medium none;
    display: block;
    float: left;
    line-height: 1.2em;
    margin: 1em;
    min-height: 20px;
    padding: 0 1em;
    position: relative;">
        <p>Search for Articles across many databases:</p>
      <form action="http://miami.summon.serialssolutions.com/search" method="GET" id="summon_search">
        <input type="hidden" value="ContentType,Newspaper Article, true" name="s.fvf[]" />
        <input type="hidden" value="ContentType,Book Review, true" name="s.fvf[]" />
        <input type="hidden" value="ContentType,Trade Publication Article, true" name="s.fvf[]" />
        <input type="text" name="s.q" value="" size="40" />
        <input type="submit" value="Go" /> &nbsp;
      </form>
        </div>
            <ul>
              <li><a href="<?php print PATH_TO_SP; ?>subjects/databases.php">Databases A-Z</a></li>
            </ul>
            <ul>
              <li><a href="http://mt7kx4ww9u.search.serialssolutions.com/">Journal List</a></li>
            </ul>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/articles/">Articles Overview</a></div>
          </div></li>
        <li class="tight mega" style=""><a href="<?php print PATH_FROM_ROOT; ?>/media/">CD / DVDs</a>
        <div style="left: 0em; width: 490px;" class="mega_child">
        <div style="background-color: transparent;
    border: medium none;
    display: block;
    float: left;
    line-height: 1.2em;
    margin: 1em;
    min-height: 20px;
    padding: 0 1em;
    position: relative;">
        
      <form action="http://catalog.library.miami.edu/search/" method="get" name="search" id="search" style="float: left;">
      <p>Looking for Music or Movies? Use the Catalog:</p>
        <input type="hidden" id="iiiFormHandle_1">

        <select name="searchtype" id="searchtype" style="">
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

        <input maxlength="75" name="searcharg" size="20"  style="" /><br /><br />

           limit to:
       <select id="label4" name="searchscope">
       <option value="17" selected="selected"> DVDs/Videos </option>
        <option value="15"> Music CDs</option>
        <option value="8"> Music Library</option>
        <option value="16"> Music Recordings</option>
        <option value="18"> Music Scores</option>
        <option value="19"> Streaming Audio/Video</option>
        <option value="11">Entire Collection</option>
        </select>

        <input type="hidden" id="iiiFormHandle_1"/>
        <input name="Search" type="submit" id="Search" value="Search" />
      </form>
                  <div class="mega_feature" style="margin: 0 0 0 3em; padding: 0; text-align: center;">
              <a href="http://library.miami.edu/udvd/"><img src="<?php print THEME_BASE_DIR; ?>/images/udvd_square.png" title="Try UDVD for your DVD Needs" alt="Try UDVD for your DVD Needs" /></a><br />
            </div>
        </div>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/media/">CD/DVDs Overview</a>, <a href="http://library.miami.edu/musiclib/">Music Library</a>, <a href="http://library.miami.edu/udvd/">UDVD</a>, <a href="<?php print PATH_FROM_ROOT; ?>/suggest-a-purchase/">Recommend a Purchase</a></div>
          </div></li>
        <li class="research mega"><a href="<?php print PATH_FROM_ROOT; ?>/research/">RESEARCH</a>
          <div style="left: 0em; width: 520px;" class="mega_child">
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/research/getting-started/">Getting Started</a></li>
              <li><a href="http://libguides.miami.edu/">Research Guides</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/research/consultations/">Research Consultations</a></li>
              <li><a href="<?php print PATH_TO_SP; ?>subjects/staff.php?letter=Subject Librarians A-Z">Subject Librarians</a></li>

            </ul>
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/citation/">Citation Help</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/workshops/">Workshops</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/tutorials/">Tutorials</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/copyright/">Copyright</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/scholarly-communications/">Scholarly Communications & Publishing</a></li>
            </ul>
            <div class="mega_feature">
              <img src="<?php print PATH_TO_SP; ?>assets/users/_<?php print $random_librarian; ?>/headshot.jpg" alt="Ask a Librarian" /><br /><br />
              Need Help?  <a href="<?php print PATH_FROM_ROOT; ?>/ask-a-librarian/">Ask a Librarian</a>
            </div>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/research/">Research Overview</a></div>
          </div></li>
        <li class="libraries mega tour_5"><a href="<?php print PATH_FROM_ROOT; ?>/libraries-collections/">LIBRARIES & COLLECTIONS</a>
          <div class="mega_child">
            <ul>
              <li><a href="http://library.miami.edu/architecture/">Architecture</a></li>
              <li><a href="http://library.miami.edu/business/">Business</a></li>
              <li><a href="http://www.law.miami.edu/library/">Law</a></li>
              <li><a href="http://library.miami.edu/rsmaslib/">Marine</a></li>
              <li><a href="http://calder.med.miami.edu/">Medical</a></li>
              <li><a href="http://library.miami.edu/musiclib/">Music</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/">Richter (interdisciplinary)</a></li>
            </ul>
            <ul>
              <li><a href="http://library.miami.edu/chc/">Cuban Heritage Collection</a></li>
              <li><a href="http://library.miami.edu/specialcollections/">Special Collections</a></li>
              <li><a href="http://merrick.library.miami.edu/">UM Digital Collections</a></li>
              <li><a href="http://library.miami.edu/oral-histories/">UM Oral Histories</a></li>
              <li><a href="http://scholarlyrepository.miami.edu/">UM Scholarly Repository</a></li>
              <li class="last"><a href="http://library.miami.edu/universityarchives/">University Archives</a></li>
            </ul>
            <div class="mega_feature">
              <img src="<?php print THEME_BASE_DIR; ?>/images/<?php print $rlib_img; ?>" alt="<?php print $rlib_name; ?>" /><br />
              <p style="line-height: 1.5em;text-align: center;"><a href="<?php print $rlib_url; ?>"><?php print $rlib_name; ?></a></p>
            </div>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/libraries-collections/">Collections Overview</a>,
              <a href="<?php print PATH_TO_SP; ?>subjects/new_acquisitions.php">New Acquisitions</a>,
              <a href="<?php print PATH_FROM_ROOT; ?>/suggest-a-purchase/">Recommend a Purchase</a></div>
          </div>
        </li>
        <li class="services mega"><a href="<?php print PATH_FROM_ROOT; ?>/services/">SERVICES</a>
          <div class="mega_child" style="width: 360px;">
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/borrowing/">Access &amp; Borrowing</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/ada/">ADA/Disability Services</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/course-reserves/">Course Reserves</a></li>

              <li><a href="<?php print PATH_FROM_ROOT; ?>/interlibrary-loan/">Interlibrary Loan</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/printing/">Printing</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/teaching-support/">Teaching Support</a></li>
            </ul>

            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/computers/">Computers</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/medialab/">Digital Media Lab</a></li>
              <li><a href="<?php print PATH_TO_SP; ?>subjects/gis/">GIS Services</a></li>

              <li><a href="<?php print PATH_FROM_ROOT; ?>/reserve-equipment/">Reserve Equipment</a></li>
              <li><a href="http://library.miami.edu/graduate-study/">Graduate Study Room</a></li>
              <li><a href="http://libcal.miami.edu/booking/richter-study">Reserve Group Study Room</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/rooms-spaces/">Rooms &amp; Spaces</a></li>
            </ul>

            <div class="mega_more">See also <a href="<?php print PATH_TO_SP; ?>subjects/staff.php">Staff List</a>,
              <a href="<?php print PATH_FROM_ROOT; ?>/patron/">Information by Patron Type</a></div>
          </div>
        </li>
        <li class="about mega"><a href="<?php print PATH_FROM_ROOT; ?>/about/">ABOUT</a>

          <div class="mega_child" style="width: 350px;">
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/patron/visitor/">Visitor Information</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/employment/">Employment</a></li>
              <li><a href="<?php print PATH_TO_SP; ?>subjects/faq.php">FAQs</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/forms/">Forms</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/policies/">Policies</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/publications/">Publications</a></li>

            </ul>
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/hours/">Hours</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/floor-plans/">Floor Plans</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/departments/">Library Departments</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/maps/">Maps &amp; Directions</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/service-desks/">Service Desks</a></li>
              <li class="last"><a href="<?php print PATH_TO_SP; ?>subjects/staff.php">Staff List</a></li>
            </ul>
            <div class="mega_more">See also <a href="<?php print PATH_FROM_ROOT; ?>/about/">About the Libraries Overview</a></div>
          </div>
        </li>
        <li class="login mega tour_6" rel="accounts"><a href="<?php print PATH_FROM_ROOT; ?>/patron/" style="">Accounts+</a>
          <div class="mega_child" style="width: 350px;">
            <div class="mega_intro"><span style="width: 155px;display: inline-block;">Accounts</span>
              <span style="display: inline-block; width: 160px;">Information for</span>
            </div>
            <ul>
              <li><a href="http://catalog.library.miami.edu/patroninfo">MyLibrary</a></li>
              <li><a href="https://www.courses.miami.edu/webapps/login/">Blackboard</a></li>
              <li><a href="https://triton.library.miami.edu/">ILLiad (Interlibrary Loan)</a></li>
              <li><a href="http://aeon.library.miami.edu/">Aeon</a></li>
              <li class="last"><a href="https://myum.miami.edu/">MyUM</a></li>
            </ul>
            <ul>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/patron/undergrad/">Undergraduate</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/patron/grad/">Graduate Student</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/patron/faculty/">Faculty</a></li>
              <li><a href="<?php print PATH_FROM_ROOT; ?>/patron/alumnus/">Alumnus</a></li>
              <li class="last"><a href="<?php print PATH_FROM_ROOT; ?>/patron/visitor/">Visitor</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div id="main">