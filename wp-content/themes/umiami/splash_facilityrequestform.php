<?php
/**
 * Template Name: Splash_FacilityRequestForm
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

//ini_set('error_reporting', E_ALL);
//error_reporting(E_ALL);

?>

<?php
get_header();
//where to send emails off = Off-campus facility and brk = Brockway Facility
//$mail_to_off = "d.gonzalez26@umiami.edu";
$mail_to_off = "ocsf@miami.edu";
//$mail_to_brk = "d.gonzalez26@umiami.edu";
$mail_to_brk = "richter.circulation@miami.edu";

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
		"value" => "Storage Facility"
	),
	array(
		"type" => "start_table"
	),
	array(
		"type" => "radio_list",
		"label" => "",
		"name" => "facility",
		"list" => array(
			"<strong>Brockway Storage Facility</strong>" => "brockway",
			"<strong>Off-Campus Shelving Facility (Off-Campus Storage)</strong>" => "offcampus"
		),
		"notes" => array(
			"<strong>Brockway Storage Facility</strong>" => "Brockway Storage Facility requests are processed daily.",
			"<strong>Off-Campus Shelving Facility (Off-Campus Storage)</strong>" => "Off-Campus Shelving Facility requests are processed and delivered within 48 hours, Monday through Friday."
		)
	),
	array(
		"type" => "end_table"
	),
	array(
		"type" => "title",
		"value" => "Requester Information"
	),
	array(
		"type" => "start_table"
	),
	array(
		"type" => "input",
		"label" => "Name (Required):",
		"name" => "user"
	),
	array(
		"type" => "input",
		"label" => "Phone:",
		"name" => "phone"
	),
	array(
		"type" => "input",
		"label" => "Email (Required):",
		"name" => "email"
	),
	array(
		"type" => "end_table"
	),
	array(
		"type" => "title",
		"value" => "Book Information"
	),
	array(
		"type" => "start_table"
	),
	array(
		"type" => "input",
		"label" => "Call  Number (Required)",
		"name" => "bcall"
	),
	array(
		"type" => "input",
		"label" => "Book Title (Required)",
		"name" => "btitle"
	),
	array(
		"type" => "input",
		"label" => "Volume",
		"name" => "bvolume"
	),
	array(
		"type" => "end_table"
	),
	array(
		"type" => "title",
		"value" => "Journal Information"
	),
	array(
		"type" => "start_table"
	),
	array(
		"type" => "input",
		"label" => "Call  Number (Required)",
		"name" => "jcall"
	),
	array(
		"type" => "input",
		"label" => "Journal Title (Required)",
		"name" => "jtitle"
	),
	array(
		"type" => "input",
		"label" => "Volume (Required)",
		"name" => "jvolume"
	),
	array(
		"type" => "input",
		"label" => "Date of Journal (Required)",
		"name" => "jdate"
	),
	array(
		"type" => "input",
		"label" => "Date of Journal (Required)",
		"name" => "jdate"
	),
	array(
		"type" => "input",
		"label" => "Article Title",
		"name" => "jarticle"
	),
	array(
		"type" => "input",
		"label" => "Pages Needed",
		"name" => "jpages"
	),
	array(
		"type" => "textarea",
		"label" => "Comments",
		"name" => "comments",
		"rows" => "4",
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

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
	?>
	<div>
		This form is intended for people not affiliated with the University of Miami. People affiliated to the
      	University must request materials using the "Request" function in the <a href="http://catalog.library.miami.edu/">
      	Libraries' catalog</a>, or <a href="http://triton.library.miami.edu/">ILLiad</a> for article requests.
	</div>
	<br />
	<div>
		Please select the storage facility containing the items you need. If you need additional information, please
      	contact the Circulation Department, Richter Library, at 305-284-3233, or email us at
      	<a href="mailto:richter.circulation@miami.edu">richter.circulation@miami.edu</a>
	</div>
	<?php

	echo web_mail_form( $lobjElements, "/storage-facility-request-form/", "post" );
}
else
{
	$facility 	= $_POST['facility'];
	$name 		= $_POST['user'];
	$email 		= $_POST['email'];
	$phone 		= $_POST['phone'];
	$comments 	= $_POST['comments'];
	$jtitle 	= $_POST['jtitle'];
	$btitle 	= $_POST['btitle'];
	$bcall 		= $_POST['bcall'];
	$bvolume 	= $_POST['bvolume'];

	$jcall 		= $_POST['jcall'];
	$jarticle	= $_POST['jarticle'];
	$jvolume 	= $_POST['jvolume'];
	$jdate 		= $_POST['jdate'];
	$jpages 	= $_POST['jpages'];
	$now 		= date("D dS M h:m:s");
	$submit 	= $_POST['submit'];

	$lobjErrors = array();

	if($submit != null)
	{
		if (empty($email))
		{
			$lobjErrors[] = 'You forgot to enter your email address';
		}

		if (empty($name))
		{
			$lobjErrors[] = 'You forgot to enter a name';
		}

		if (empty($facility))
		{
			$lobjErrors[] = 'You forgot to select a facility';
		}

		if ((!empty($email)) && (!empty($name)) && (!empty($facility)) && ($facility == 'offcampus'))
		{
			$mail_subject = 'Off-Campus Shelving Facility Request Form';

			$mail_body =
			'Facility: '						. $facility . "\r\n" .
			'From: '  						. $name  	. "\r\n" .
			'Email: ' 							. $email 	. "\r\n" .
			'Phone: ' 						. $phone 	. "\r\n" .
			'Book Title: '  					. $btitle 	. "\r\n" .
			'Book Call Number: '			. $bcall 	. "\r\n" .
			'Book Volume No: ' 			. $bvolume 	. "\r\n" .
			'Journal Title: '	 			. $jtitle 	. "\r\n" .
			'Journal Call Number: '		. $jcall 	. "\r\n" .
			'Journal Volume No: '		. $jvolume	. "\r\n" .
			'Journal Article Title: '		. $jarticle	. "\r\n" .
			'Journal Article Date: '		. $jdate	. "\r\n" .
			'Journal Article Pages: '	. $jpages	. "\r\n" .
			'Comments: '					. $comments;

			if (mail($mail_to_off, $mail_subject, $mail_body, "From: $email"))
			{
				echo "<p><b>Thank you</b>.<br/><br/>This is a confirmation that your request<br/><br/>";
				echo "<b>Name</b>: $user<br/>";
				echo "<b>Email</b>: $email<br/>";
				echo "<b>Phone</b>: $phone<br/>";
				//echo "<b>Affiliation</b>: $status<br/>";
				echo "<b>Book title</b>: $btitle<br/>";
				echo "<b>Book call number</b>: $bcall<br/>";
				echo "<b>Book volume no.</b>: $bvolume<br/>";
				echo "<b>Journal title</b>: $jtitle<br/>";
				echo "<b>Journal call number</b>: $jcall<br/>";
				echo "<b>Journal volume No</b>: $jvolume<br/>";
				echo "<b>Journal date</b>: $jdate<br/>";
				echo "<b>Journal article</b>: $jarticle<br/>";
				echo "<b>Journal article pages</b>: $jpages<br/>";
				echo "<b>Comments</b>: $comments<br/><br/>";
				echo " from the <b>Off-Campus Shelving Facility</b> has been submitted on <b>$now.</b></p>";
				echo " <p>You will be contacted as soon as it arrives at the Otto G. Richter circulation desk for pick-up.</p>";
			}
		}elseif ((!empty($email)) && (!empty($name)) && (!empty($facility)) && ($facility == 'brockway'))
		{
			$mail_subject = 'Brockway Shelving Facility Request Form';

			$mail_body =
			'Facility: '				    	. $facility . "\r\n" .
			'From: '  						. $name  	. "\r\n" .
			'Email: ' 					    	. $email 	. "\r\n" .
			'Phone: ' 						. $phone 	. "\r\n" .
			'Book Title: '  			    	. $btitle 	. "\r\n" .
			'Book Call Number: '			. $bcall 	. "\r\n" .
			'Book Volume No: ' 			. $bvolume 	. "\r\n" .
			'Journal Title: '	 			. $jtitle 	. "\r\n" .
			'Journal Call Number: '		. $jcall 	. "\r\n" .
			'Journal Volume No: '		. $jvolume	. "\r\n" .
			'Journal Article Title: '		. $jarticle	. "\r\n" .
			'Journal Article Date: '		. $jdate	. "\r\n" .
			'Journal Article Pages: '	. $jpages	. "\r\n" .
			'Comments: '					. $comments;

			if (mail($mail_to_brk, $mail_subject, $mail_body, "From: $email"))
			{
				echo "<p><b>Thank you</b>.<br/><br/>This is a confirmation that your request<br/><br/>";
				echo "<b>Name</b>: $name<br/>";
				echo "<b>Email</b>: $email<br/>";
				echo "<b>Phone</b>: $phone<br/>";
				//echo "<b>Affiliation</b>: $status<br/>";
				echo "<b>Book title</b>: $btitle<br/>";
				echo "<b>Book call number</b>: $bcall<br/>";
				echo "<b>Book volume no.</b>: $bvolume<br/>";
				echo "<b>Journal title</b>: $jtitle<br/>";
				echo "<b>Journal call number</b>: $jcall<br/>";
				echo "<b>Journal volume No</b>: $jvolume<br/>";
				echo "<b>Journal date</b>: $jdate<br/>";
				echo "<b>Journal article</b>: $jarticle<br/>";
				echo "<b>Journal article pages</b>: $jpages<br/>";
				echo "<b>Comments</b>: $comments<br/><br/>";
				echo " from the <b>Brockway Storage Facility</b> has been submitted on <b>$now.</b></p>";
				echo " <p>You will be contacted as soon as it arrives at the Otto G. Richter circulation desk for pick-up.</p>";
			}
			else
			{
				echo "Failed to sent the e-mail. To report the failure call the Richter Library 1st floor Circulation Desk at (305) 284-3233.";
			}
		}else
		{
			?>
				<div>
					This form is intended for people not affiliated with the University of Miami. People affiliated to the
			      	University must request materials using the "Request" function in the <a href="http://catalog.library.miami.edu/">
			      	Libraries' catalog</a>, or <a href="http://triton.library.miami.edu/">ILLiad</a> for article requests.
				</div>
				<br />
				<div>
					Please select the storage facility containing the items you need. If you need additional information, please
			      	contact the Circulation Department, Richter Library, at 305-284-3233, or email us at
			      	<a href="mailto:richter.circulation@miami.edu">richter.circulation@miami.edu</a>
				</div>
			<?php

			echo web_mail_form( $lobjElements, "/storage-facility-request-form/", "post", $lobjErrors );
		}
	}
}
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