<?php
/*
Template Name: available-computers.php
*/

get_header();


?>


<style>
 /*
.wrappie {
width: 900px;
margin:1%;
 }
 */


h3 {

  font-size: 2.1em;
 }


.legend_label {

display: inline;
  margin-right:1%;
  margin-left:1%;
 }


.computer {

 display: inline-block;
  margin-right: 5px;
 padding: 5px;
   margin-bottom: 5px;
 height:10px;
 width:10px;
 background: none repeat scroll 0% 0% rgb(165, 201, 166);


 }

.tip .computer, .computer_off, .computer_in_use  {


 }
.tip .computer_off {

 }

.tip .computer_in_use {


 }

.computer_off {

 display: inline-block;
  margin-right: 5px;
 padding: 5px;
background: #E0E0E0;
   margin-bottom: 5px;
 height:10px;
 width:10px;

 }


.computer_in_use {

 display: inline-block;
  margin-right: 5px;
 padding: 5px;
 background: none repeat scroll 0% 0% rgb(224, 164, 150);
   margin-bottom: 5px;
 height:10px;
 width:10px;


 }
.groupName {

  margin-bottom: 5px;
  // padding: 5px;
   font-family: sans-serif;
  //background: none repeat scroll 0% 0% rgb(99, 99, 99);
  //color: rgb(240, 240, 240);

 }

</style>



<div class="container_12">

  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <?php print $patron_tip;
uml_isReferred();  ?>
  </div>

  <div class="grid_8">
    <div class="breather">
      <?php the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">&nbsp;

<?php



// Disabled Cache to ensure the data is current. could result in slower load times
$ini = ini_set("soap.wsdl_cache_enabled","0");

function printComputers() {

//Creates a SOAP Connection (Change URL to match your installation
$client = new SoapClient("http://129.171.178.56/LabStats/WebServices/Statistics.asmx?WSDL");

// Sets variable results to equal the results from our XML request
$results = $client->GetGroupedCurrentStats()->GetGroupedCurrentStatsResult->GroupStat;



$results = array_reverse($results);


foreach ($results as $entry) {
  /*
	echo "<tr>";
	echo "<td>" . $entry->groupName . "</td>";
	echo "<td>" . $entry->offCount . "</td>";
	echo "<td>" . $entry->availableCount . "</td>";
	echo "<td>" . $entry->inUseCount . "</td>";
	echo "<td>" . $entry->totalCount . "</td>";
	echo "<td>" . $entry->percentInUse*100 . "</td>";
	echo "</tr>";
  */

  if ($entry->groupName == "Eaton Residential College (ERC)"
      || $entry->groupName  == "Hecht Residential College (HRC)"
      || $entry->groupName  == "Mahoney Residential College (MRC)"
      || $entry->groupName  == "Stanford Residential College (SRC)"
      || $entry->groupName  == "Music Library"
      )

    {

  } else {

    $real_count = $entry->availableCount;

	echo "<h2>" . $entry->groupName . "</h2>";

	if ($real_count  == 0) {
	  echo "<h3>None Available</h3>";

	} else {

	echo "<h3>" . $real_count . " available" . "</h3>";

	}

		echo str_repeat("<div class='computer'></div>", $entry->availableCount);

		echo str_repeat("<div class='computer_in_use'></div>", $entry->inUseCount);

			echo str_repeat("<div class='computer_off'></div>",$entry->offCount) ;



  }
}

echo "</table>";

}


echo printComputers();



?>





        </div><!-- .entry-content -->
        <footer class="entry-meta">

        </footer><!-- .entry-meta -->
      </article><!-- #post-<?php the_ID(); ?> -->

    </div>
  </div>

  <div class="grid_4">
    <?php
    print uml_getTips();
    print uml_showStaff(get_field("contact"));
    ?>
  </div>
 
</div><!-- .container_12 -->

<?php get_footer(); ?>