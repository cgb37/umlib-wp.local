<?php
/**
 * Template Name: Patron
 * Special template for one of the patron type pages
 *
 * @package WordPress
 * @subpackage umiami
 */

//determine page's patron type

$our_type = explode("/", get_page_link());
array_pop($our_type); // strip off trailing slash
$patron_type = end($our_type); // i.e., faculty
// Theory:  This var should be secure, becuase the only way this template is run
// is when someone has selected this template type, so nonsense in the get_page_link()
// would not load this template

if (!isset($_COOKIE["uml_patron_type"]) || ($_COOKIE["uml_patron_type"] != $patron_type)) {
  $patron_tip = '
        <div class="patron_tip">
          <p>Would you like to start viewing the UM Libraries website as <strong>' . $patron_type . '</strong>?</p>
          <ul class="horiz_list">
            <li><a href="index.php?ptype=' . $patron_type . '">Yes, please!</a></li>
            <li><a href="patron/">Wait, tell me more</a></li>
            <li><a class="nothanks" href="">No, thanks</a></li>
          </ul>

        </div>';
} else {
  $patron_tip = '
          <div class="patron_tip">
          <p>You are viewing the UM Libraries website as <strong>' . $patron_type . '</strong>.  Would you like
            to remove the cookie?</p>
          <ul class="horiz_list">
            <li><a class="emptycookie" href="">Yes, forget about me!</a></li>
          </ul>          

        </div>';
}

// If we have a patron type (based on URL), give options

if (isset($_GET["ptype"])) {

  if (class_exists("uml_Patronizer")) {
    $our_patronizer = new uml_Patronizer($_GET["ptype"]);
  }

//Actions and Filters
  if (isset($our_patronizer)) {
    //Actions
    add_action('loop_start', array(&$our_patronizer, 'makeCookie'), 1);

    //Filters
  }
}

if (class_exists("uml_Librarianify")) {
  $check_lib = get_field("contact");

  $our_lib = new uml_Librarianify($check_lib);


  if ($our_lib->_fail != TRUE) {
    $assoc_lib = $our_lib->display();
  } else {
    $assoc_lib = "";
  }
}

get_header();
?>

<?php the_post(); ?>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header --> 
    <?php print $patron_tip; ?>

  </div>
  <div class="grid_8">    
    <div class="breather">&nbsp;

      <?php the_content(); ?>  

      <?php
      $query = new WP_Query(array('patron_views' => $patron_type, 'orderby' => 'title', 'order' => 'ASC'));

      if ($query->found_posts >= 1) {
        print "
          <p>The information on the following pages might be of interest to you:</p>
          <ul>";
        foreach ($query->posts as $post) {
          print "<li><a href=\"$post->guid\">$post->post_title</a></li>";
        }
        print "</ul>";
      }


      //var_dump($query);
      ?>
    </div>

  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
<?php print uml_getTips();
print $assoc_lib; ?>
  </div>
</div>

<br />


<?php get_footer(); ?>

<script type="text/javascript" language="javascript">
  $(document).ready(function(){
    $(".nothanks").live('click', function() {
      $(".patron_tip").fadeOut();
      return false;
    });
    
    $(".emptycookie").live('click', function() {
      $.cookie('uml_patron_type', null, { expires: 1, path: '/' });
      $(".patron_tip").fadeOut();
      $("#mascot2").removeClass("lightup");
      $("#user_type").fadeOut(700);
      return false;
    });    
            
  });
</script>