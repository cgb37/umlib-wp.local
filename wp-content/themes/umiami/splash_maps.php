<?php
/**
 * Template Name: Splash_Maps
 * The template for the Maps splash page.

 *
 * @package WordPress
 * @subpackage umiami
 * @since 
 */
get_header();
?>

<?php the_post(); ?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
  </div>
  <div class="grid_8">    
    <div class="breather">
      <h2>Coral Gables Campus</h2>
      <p><strong>Parking</strong>:  <a href="http://www.miami.edu/index.php/about_us/visit_um/directions_to_our_campuses/">Visitor Directions/Parking Information</a></p>
      <p><strong>Public Transportation</strong>:  The University of Miami Coral Gables campus is easily accessible from the 
        <a href="http://www.miamidade.gov/transit/metrorail-stations.asp#18">Metrorail University Station</a> on Ponce de Leon.  It is served by Metrobus routes 48, 56, and Midnight Owl (500).  Use the <a href="http://www.miami.edu/ref/index.php/parking_and_transportation/transportation_options/hurry_canes_shuttle/">Hurry 'Cane Shuttle</a> to get around the Coral Gables Campus.</p>
      <p><strong>Map of Libraries</strong>:  Use map for libraries and directions.</p>
      <div id="letterhead" align="center">
        <a rel="pop-1" href="?show_lib=1">Richter (Main)</a> 
        <a rel="pop-3" href="?show_lib=3">Architecture</a>
        <a rel="pop-4" href="?show_lib=4">Business</a>
        <a rel="pop-2" href="?show_lib=2">Music</a>
      </div>
      <!--This is the div that will be populated with the map -->
      <div id="map" style="width: 95%; height: 450px; border: 1px solid #333;"></div>
      <a name="marine_map"></a>
      <h2>Marine Campus</h2>
      <p><strong>Public Transportation</strong>:  The Rosenstiel School of Marine and Atmospheric Sciences offers a 
        <a href="http://www.rsmas.miami.edu/resources/shuttle-schedule/">free shuttle service</a> between 
        the <a href="http://www.miamidade.gov/transit/rail_vizcaya.asp">Metrorail Vizcaya Station</a> and the campus during the regular academic semester (from the first day of classes to the last day of classes each semester). It does not operate on University holidays, breaks or during the summer.  Vizcaya Station connects to Metrobus routes 12, 17, and 24.  Virginia Key is also directly accessible on Metrorail Bus route B from downtown Miami.</p>
      <br />
      <!--This is the div that will be populated with the map -->
      <div id="map2" style="width: 70%; height: 350px; width: 580px; border: 1px solid #333;"></div>

      <a name="medical_map"></a>
      <h2>Medical Campus</h2>
      <p><strong>Public Transportation</strong>:  Public transportation is available via the Metrobus routes 12, 22, 32, 95 and M; 
        and the <a href="http://www.miamidade.gov/transit/rail_civic.asp">Metrorail Civic Center Station</a> adjacent to the medical campus. </p>
      <br />
      <!--This is the div that will be populated with the map -->
      <div id="map3" style="width: 70%; height: 350px; width: 580px; border: 1px solid #333;"></div>
      <!-- fail nicely if the browser has no Javascript -->
      <noscript>
      <b>JavaScript must be enabled in order for you to use Google Maps.</b> However, it seems JavaScript is either disabled or not supported by your browser. 
      To view Google Maps, enable JavaScript by changing your browser options, and then 
      try again.
      </noscript>
    </div>
  </div>
  <div class="grid_4"  <?php uml_setSidebarBgImg(); ?>>
    <div class="tip">
      <h2>Campus Maps</h2>
      <ul>
        <li><a href="http://www.miami.edu/index.php/about_us/visit_um/maps/">Interactive Campus Maps</a></li>
      </ul>
    </div>
    <div class="tipend"></div>
    <div class="tip">
      <h2>Places to Stay</h2>
      <ul>
        <li><a href="http://www.miami.edu/finance/index.php/travel_management/hotels/">Local Hotels</a></li>
      </ul>
    </div>
    <div class="tipend"></div>
  </div>
</div>
<br />



<?php get_footer();
?>



<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  
  google.maps.event.addDomListener(window, 'load', function() {
      
    /////////////////////
    // Coral Gables Map
    /////////////////////
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: new google.maps.LatLng(25.71828,-80.27875),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    ////////////////
    // Marine Map
    ////////////////
    var map2 = new google.maps.Map(document.getElementById('map2'), {
      zoom: 15,
      center: new google.maps.LatLng(25.732401,-80.162762),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    ////////////////
    // Medical Map
    ////////////////
    var map3 = new google.maps.Map(document.getElementById('map3'), {
      zoom: 15,
      center: new google.maps.LatLng(25.790386,-80.210752),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });   
    
    /////////////////
    // our all-purpose infoWindow
    /////////////////
    var infoWindow = new google.maps.InfoWindow;

    var onMarkerClick = function() {
      var marker = this;
      
      infoWindow.setContent('<h3>' + marker.title + '</h3>' + marker.address + '<br /><a class="directions" href="http://maps.google.com/maps?daddr=' + marker.position + '">Get Directions</a>');

      infoWindow.open(marker.map, marker);
    };
    


    ////////////////////
    // Our event listener
    ////////////////////
    
    google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
    });

    var markers = new Array();


    markers[1] = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(25.72135, -80.27839),
      title: 'Otto G. Richter Library',
      address: '1300 Memorial Drive<br />Coral Gables, FL 33124-0320<br />tel. (305) 284-3233'
    });
    
    
    markers[2] = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(25.71921, -80.28032),
      title: 'Music Library',
      address: 'Marta and Austin Weeks Music Library<br />5501 San Amaro Drive<br />Coral Gables, FL 33124<br />tel. (305) 284-2429'
    });
    
    markers[3] = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(25.716405,-80.278902),
      title: 'Architecture Library',
      address: 'Paul Buisson Reference Library<br />1223 Dickinson Drive<br />Coral Gables FL 33146<br />tel. (305) 284-3438 '
    });
    
    
    markers[4] = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(25.720252,-80.276338),
      title: 'Business Library',
      address: 'Judi Prokop Newman Information Resource Center<br />P.O. Box 248027<br />Coral Gables, FL 33124<br />tel. (305) 284-4643'
    });
   
   
    markers[5] = new google.maps.Marker({
      map: map,
      position: new google.maps.LatLng(25.720735,-80.280329),
      title: 'Law Library',
      address: 'School of Law Library<br />1311 Miller Drive<br />Coral Gables, FL 33146<br />tel. (305) 284-3563 '
    });
    
    markers[6] = new google.maps.Marker({
      map: map2,
      position: new google.maps.LatLng(25.732401,-80.162762),
      title: 'Marine Library',
      address: 'Rosenstiel School of Marine and Atmospheric Science Library<br />4600 Rickenbacker Causeway<br />Miami, FL 33149<br />tel. (305) 421-4060'
    });
    
    markers[7] = new google.maps.Marker({
      map: map3,
      position: new google.maps.LatLng(25.790386,-80.210752),
      title: 'Medical Library',
      address: 'Louis Calder Memorial Library<br />1601 NW 10th Ave.<br />Miami, FL 33136<br />tel. (305) 243-6403'
    });
  

    // Get our desired library from URL
    var requested = '<?php print $_GET["show_lib"]; ?>';

    // This code block makes sure the map is done loading before listening
    // fixes a panning issue
    google.maps.event.addListenerOnce(map, 'idle', function(){

      // Set up our event listeners
      for (var i = 1; i < markers.length; i++) {
  
        google.maps.event.addListener(markers[i], 'click', onMarkerClick);
  
        // check if someone wanted to link directly to an infoWindow
        if (requested == i) {

          centerMap(i);
        
        }
 
      }
  
    });
    function centerMap(id) {
      google.maps.event.trigger(markers[id], 'click');
    }

    // Some jquery
    $(document).ready(function(){
      $("a[rel*=pop-]").click(function() {
        var pop_id = $(this).attr("rel").split("-");
        centerMap(pop_id[1]);
        return false;
      });
    
    });
  });
  
</script>
