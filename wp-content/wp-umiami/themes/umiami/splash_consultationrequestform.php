<?php
/**
 * Template Name: Splash_ConsultationRequestForm
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
$mail_to = "richterreference@miami.edu";
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
		"type" => "title",
		"value" => "Contact Information"
		),
	array(
		"type" => "start_table"
		),
	array(
		"type" => "input",
		"label" => "Name:",
		"name" => "user"
	),
	array(
		"type" => "input",
		"label" => "E-mail address:",
		"name" => "email"
	),
	array(
		"type" => "input",
		"label" => "Phone number & area code:",
		"name" => "phone"
	),
	array(
		"type" => "radio_list",
		"label" => "Choose affiliation:",
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
		"label" => "<strong>Consultation request</strong>:",
		"name" => "query",
		"rows" => "5",
		"cols" => "55"
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
	echo web_mail_form( $lobjElements, "/consultation-request-form/", "post" );
}
else
{
	?>
	<?php
	$user = $_POST['user'];
	$email = trim($_POST['email']);
	$status = $_POST['status'];
	$phone = $_POST['phone'];
	$query = trim($_POST['query']);
	$now = date("D dS M h:m:s");
	$submit = $_POST['submit'];

	$lobjErrors = array();

	if (isset($submit))
	{
		if (empty($query))
		{ $lobjErrors[] = "You forgot to enter a query"; }
		if (empty($email))
		{ $lobjErrors[] = "You forgot to enter your email address"; }
		if (empty($status))
		{ $lobjErrors[] = "You forgot to enter your affiliation"; }

		if ((!empty($email)) && (!empty($status)) && (!empty($query)))
		{
			$mail_subject = "Consultation Request Form";
			$mail_body =
			"From: ". $email .
			"\n\nEmail: ". $email .
			"\n\nName : ". $user .
			"\n\nAffiliation: ". $status .
			"\n\nPhone: ".$phone .
			"\n\nRequest: " .$query;
			//additional headers
			if(mail ($mail_to, $mail_subject, $mail_body, "From: $email"))
			  {
				echo "<h2>Email Sent Confirmation</h2>
					<br/>
					<p><b>Thank you</b> for using the University of Miami Libraries Consultation Service.<br><br>This is a confirmation that your request";
				echo " was submitted on <b>$now</b>.</p>";
				echo "<p><b>Name</b>: $user<br>";
				echo "<b>Email</b>: $email<br>";
				echo "<b>Phone</b>: $phone<br>";
				echo "<b>Affiliation</b>: $status<br>";
				echo "<b>Request</b>: $query</p>";
				echo "<p>Responses are sent within 24 hours, unless your question is";
				echo " submitted on a holiday.</p>";
			   }
			else
			  {
				echo "Failed to sent the e-mail.  To report the failure call the Richter Library 1st floor Information";
			  	echo "& Reference Desk at (305) 284-4722. ";
			  }
		}else
		{
			echo web_mail_form( $lobjElements, "/consultation-request-form/", "post", $lobjErrors );
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
