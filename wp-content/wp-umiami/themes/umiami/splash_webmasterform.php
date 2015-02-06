<?php
/**
 * Template Name: Splash_WebmasterForm
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
//where does the email go to
$mail_to = "webmaster.lib@miami.edu";
//$mail_to = "d.gonzalez26@umiami.edu";
?>
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
		"type" => "hidden_input",
		"name" => "refer",
		"value" => $_SERVER["HTTP_REFERER"]
		),
	array(
		"type" => "start_table"
		),
	array(
		"type" => "input",
		"label" => "Name",
		"name" => "user"
	),
	array(
		"type" => "input",
		"label" => "E-mail",
		"name" => "email"
	),
	array(
		"type" => "radio_list",
		"label" => "Affiliation",
		"name" => "status",
		"list" => array(
						"UM Undergraduate" => "Undergraduate",
						"UM Graduate Student" => "Graduate",
						"UM Faculty" => "Faculty",
						"UM Staff" => "Staff",
						"UM Alumni" => "Alumni",
						"Other" => "Other"
		)
	),
	array(
		"type" => "textarea",
		"label" => "Please enter your comments:",
		"name" => "comments",
		"rows" => "8",
		"cols" => "55"
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
		"value" => "Submit"
	)
);

if( $_SERVER['REQUEST_METHOD'] != "POST" )
{
	?>
		<p>We welcome all your comments, suggestions, corrections, and compliments about the University of Miami Libraries web site, and pages found at http://www.library.miami.edu.</p>
	<?php
	echo web_mail_form( $lobjElements, "/report-website-issue/", "post" );
}
else
{
	$user = $_POST['user'];
	$email = $_POST['email'];
	$status = $_POST['status'];
	$refer = $_POST['refer'];

	$comments = $_POST['comments'];

	$now = date("D dS M h:m:s");
	#$query = wordwrap($query, 70);
	$submit = $_POST['submit'];

	$lobjErrors = array();

	if (isset($submit)) {

		if (empty($comments))
		{ $lobjErrors[] = "You forgot to enter a comment";}

		$lboolIsHuman = web_mail_form_is_human();

		if(!$lboolIsHuman)
		{
			$lobjErrors[] = "You did not pass the skill testing question.";
		}

		if (!empty($comments) && $lboolIsHuman){

		$mail_subject = "Webmaster Comment Form";
		$mail_body =
		"From: ". $email .
		"\n\nURL: ". $refer .
		"\n\nEmail: ". $email .
		"\n\nName : ". $user .
		"\n\nAffiliation: ". $status .
		"\n\nComments: " .$comments;
		//additional headers
		if(mail ($mail_to, $mail_subject, $mail_body, "From: $email"))
	  	{
			echo "<h2>Email Sent Confirmation</h2><br/>";
			echo "<p><b>Thank you</b> for visiting the University of Miami Libraries website.<br><br>This is a confirmation that your comment";
			echo " was submitted on <b>$now</b>.</p>";
			echo "<p><b>Name</b>: $user<br>";
			echo "<b>Email</b>: $email<br>";
			echo "<b>Affiliation</b>: $status<br>";
			echo "<b>Comments</b>: $comments<br></p>";
	   }
	   else
	   {
	   		echo "Failed to sent the e-mail.  To report the failure call the Richter Library 1st floor Information";
		  	echo "& Reference Desk at (305) 284-4722. ";}
	   }else
	   {
		   	?>
			<p>We welcome all your comments, suggestions, corrections, and compliments about the University of Miami Libraries web site, and pages found at http://www.library.miami.edu.</p>
			<?php

	   		echo web_mail_form( $lobjElements, "/report-website-issue/", "post", $lobjErrors );
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
print uml_showStaff(get_field("contact"));  ?>
  </div>
</div><!-- .container_12 -->


<?php get_footer(); ?>

