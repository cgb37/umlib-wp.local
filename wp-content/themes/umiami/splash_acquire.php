<?php
/**
 * Template Name: Splash_Acquire
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */
get_header();

//where to send emails
$mail_to = "efish@miami.edu";
//$mail_to = "d.roose@miami.edu";
//$mail_to = "d.gonzalez26@umiami.edu";
//$mail_to = "mcardenas@miami.edu";
?>

<style>
  table {}
</style>

<div class="container_12">
  <div class="grid_12">
    <header class="page-header">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
  </div>

  <div class="grid_8">
    <div class="breather">

      <div id="primary">
        <div id="content" role="main">
          <?php
          	$lobjElements = array(
          		array(
          			"type" => "title",
          			"value" => "Contact Information"
          			),
          		array(
          			"type" => "start_table"
          			),
          		array(
          			"type" => "input",
          			"label" => "Name:",
          			"name" => "suggest_user"
					),
          		array(
          			"type" => "input",
          			"label" => "E-mail address:",
          			"name" => "suggest_email"
					),
          		array(
          			"type" => "input",
          			"label" => "Phone number & area code:",
          			"name" => "suggest_phone"
					),
          		array(
          			"type" => "select",
          			"label" => "Choose affiliation:",
          			"name" => "suggest_status",
          			"options" => array(
          							"--Select Affiliation--" => "",
									"UM Undergraduate" => "Undergraduate",
          							"UM Graduate Student" => "Graduate",
          							"UM Faculty" => "Faculty",
          							"UM Staff" => "Staff",
          							"UM Alumni" => "Alumni",
          							"Other" => "Other"
   									)
					),
          		array(
          			"type" => "end_table"
					),
          		array(
          			"type" => "title",
          			"value" => "Suggested Item"
					),
				array(
          			"type" => "start_table"
          			),
          		array(
          			"type" => "input",
          			"label" => "Author:",
          			"name" => "suggest_author"
					),
          		array(
          			"type" => "input",
          			"label" => "Title:",
          			"name" => "suggest_title"
					),
          		array(
          			"type" => "input",
          			"label" => "Publisher, Date and Place of Publication:",
          			"name" => "suggest_publication"
					),
          		array(
          			"type" => "input",
          			"label" => "Where you saw this item mentioned:",
          			"name" => "suggest_where_seen"
					),
          		array(
          			"type" => "select",
          			"label" => "Format:",
					"name" => "suggest_format",
          			"options" => array(
          							"--Select Format--" => "",
									"Book" => "Book",
          							"E-book" => "E-book",
          							"DVD" => "DVD",
          							"CD" => "CD",
          							"Other (note in comments field)" => "Other",
   									)
					),
				array(
          			"type" => "textarea",
          			"label" => "Additional Comments:",
          			"name" => "suggest_comment"
					),
          		array(
          			"type" => "end_table"
					),
          		array(
          			"type" => "title",
          			"value" => "Skill Testing Question"
					),
          		array(
          			"type" => "start_table"
          			),
				array(
          			"type" => "math_test"
					),
          		array(
          			"type" => "end_table"
					),
          		array(
          			"type" => "submit_button",
          			"name" => "submit",
          			"value" => "Recommend for Purchase"
					)
			);

          if ($_SERVER['REQUEST_METHOD'] != "POST") {

          	?>
          	<p>Please complete as many fields as possible.  If you are a faculty member, you might want to
                contact your <a href="http://library.miami.edu/sp/subjects/staff.php?letter=Librarians%20by%20Subject%20Specialty">subject specialist</a> directly.</p>
        	<?php
          	echo web_mail_form($lobjElements,"/suggest-a-purchase/", "post");
          } else {

              $user = filter_var(trim($_POST['suggest_user']), FILTER_SANITIZE_STRING);
              $email = filter_var(trim($_POST['suggest_email']), FILTER_SANITIZE_STRING);
              $status = filter_var($_POST['suggest_status'], FILTER_SANITIZE_STRING);
              $phone = filter_var($_POST['suggest_phone'], FILTER_SANITIZE_STRING);

              $author = filter_var(trim($_POST['suggest_author']), FILTER_SANITIZE_STRING);
              $title = filter_var(trim($_POST['suggest_title']), FILTER_SANITIZE_STRING);
              $publication = filter_var($_POST['suggest_publication'], FILTER_SANITIZE_STRING);
              $where_seen = filter_var($_POST['suggest_where_seen'], FILTER_SANITIZE_STRING);
			  $format = filter_var($_POST['suggest_format'], FILTER_SANITIZE_STRING);
              $comment = filter_var($_POST['suggest_comment'], FILTER_SANITIZE_STRING);
              $now = date("D dS M h:m:s");
              $submit = $_POST['submit'];

          	  $lobjErrors = array();

              if (isset($submit)) {

              	$lboolIsHuman = web_mail_form_is_human();

              	if(!$lboolIsHuman)
              	{
              		$lobjErrors[] = "You did not pass the skill testing question.";
              	}
				
				if (empty($user)) {
                   $lobjErrors[] = "You forgot to enter your name.";
                }

                if (empty($email)) {
                   $lobjErrors[] = "You forgot to enter your email address.";
                }
				if (empty($status)) {
                  $lobjErrors[] = "You forgot to select the affiliation.";
                }				
                if (empty($title)) {
                  $lobjErrors[] = "You forgot to enter the title of the item.";
                }
                if (empty($author)) {
                  $lobjErrors[] = "You forgot to enter the author.";
                }
				if (empty($format)) {
                  $lobjErrors[] = "You forgot to select the format.";
                }
                if ((!empty($email)) && (!empty($title)) && (!empty($status)) && (!empty($user)) && (!empty($author)) && (!empty($format)) && $lboolIsHuman) {

                  $mail_subject = "Suggest a Purchase Form";
                  $mail_body =
                          "From: " . $email .
                          "\n\nEmail: " . $email .
                          "\n\nName : " . $user .
                          "\n\nAffiliation: " . $status .
                          "\n\nPhone: " . $phone .
                          "\n\nAuthor: " . $author .
                          "\n\nTitle: " . $title .
                          "\n\nPublication Info: " . $publication .
                          "\n\nWhere Seen: " . $where_seen .
						  "\n\nFormat: " . $format .
                          "\n\nComment: " . $comment;
                  //additional headers
                  if (mail($mail_to, $mail_subject, $mail_body, "From: $email")) {
                    echo "<p><strong>Thank you for your suggestion.</strong><br><br>This is a confirmation that your request";
                    echo " was submitted on <b>$now</b>.</p>";
                    echo "<p><b>Author</b>: $author<br>";
                    echo "<b>Title</b>: $title<br>";
                    echo "<b>Publication Information</b>: $publication<br>";
                    echo "<b>Where Seen</b>: $where_seen<br>";
					echo "<b>Format</b>: $format<br>";
                    echo "<b>Comment</b>: $comment</p>";
                  } else {
                    echo "Failed to send the e-mail.  To report the failure contact the Library Webmaster";
                    echo "at <a href=\"mailto:Webmaster.lib@miami.edu\">Webmaster.lib@miami.edu</a>. ";
                  }
                }else
                {
		          	echo web_mail_form($lobjElements,"/suggest-a-purchase/", "post", $lobjErrors);
                }
              }
          } #closes else
          ?>

        </div><!-- #content -->
      </div><!-- #primary -->

    </div>
  </div>

  <div class="grid_4" <?php uml_setSidebarBgImg(); ?>>
    <?php print uml_getTips();
    print uml_showStaff(get_field("contact")); ?>
  </div>
</div><!-- .container_12 -->


<?php get_footer(); ?>
