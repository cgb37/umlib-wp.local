<?php
/**
 * Template Name: Splash_LibraryClearanceForm
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
$mail_to = "richter.circulation@miami.edu";
//$mail_to = "d.gonzalez26@umiami.edu";
?>
<style type="text/css">
table.item_listing td
{
	padding-right: 10px;
}
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
		"value" => "All Information is Required"
		),
	array(
		"type" => "start_table"
		),
	array(
		"type" => "input",
		"label" => "Name of Departing Employee:",
		"name" => "emp_name"
	),
	array(
		"type" => "input",
		"label" => "Departing Employee's Cane ID (C Number):",
		"name" => "emp_cnum"
	),
	array(
		"type" => "input",
		"label" => "Department:",
		"name" => "dept"
	),
	array(
		"type" => "date",
		"label" => "Date of Separation:",
		"name" => "sep_date",
		"size" => "12"
	),
	array(
		"type" => "input",
		"label" => "Name of Employee Initiating Clearance Process:",
		"name" => "request_emp_name"
	),
	array(
		"type" => "input",
		"label" => "Cane ID of Employee Initiating Clearance Process (C Number):",
		"name" => "request_emp_cnum"
	),
	array(
		"type" => "input",
		"label" => "E-mail of Employee Initiating Clearance Process:",
		"name" => "request_emp_email"
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
	<p>Clearances are processed during regular business hours.
Please allow 48 hours for the process to be completed.
Once the employee has been cleared, you will receive a confirmation email.</p>
	<?php
	$_POST['sep_date'] = date('m-d-Y');
	echo web_mail_form( $lobjElements, "/library-clearance-form/", "post" );
}
else
{

	// Variable declarations, assigning the values from the form
	$emp_name = $_POST['emp_name'];
	$emp_cnum = $_POST['emp_cnum'];
	$department = $_POST['dept'];
	// $separation_date = $_POST['sep_date'];
	$request_emp_name = $_POST['request_emp_name'];
	$request_emp_cnum = $_POST['request_emp_cnum'];
	$request_emp_email = $_POST['request_emp_email'];
	$submit = $_POST['submit'];

	$start_date = trim($_POST['sep_date']);

	$lobjErrors = array();

   // checking if required fields are empty
   if (isset($submit)) {

		 if (empty($emp_name))
		 { $lobjErrors[] =  "Please enter the name of the departing employee."; }
		 if (empty($emp_cnum))
		 { $lobjErrors[] =  "Please enter the departing employee's Cane ID (C Number)."; }
		 if (empty($department))
		 { $lobjErrors[] =  "Please enter the department name."; }
		 // else if (empty($separation_date))
		 // {echo "<p>Please enter the separation date of the departing employee. </p>";}
		 if (empty($request_emp_name))
		 { $lobjErrors[] =  "Please enter the name of the employee initiating the clearance process."; }
		 if (empty($request_emp_cnum))
		 { $lobjErrors[] =  "Please enter the Cane ID (C Number) of the employee initiating the clearance process."; }
		 if (empty($request_emp_email))
		 { $lobjErrors[] =  "Please enter the e-mail of the employee initiating the clearance process."; }

		// Creates an email and a confirmation web page once the form has been submitted.
		if ((!empty($emp_name)) && (!empty($emp_cnum)) && (!empty($department)) && (!empty($request_emp_name))&& (!empty($request_emp_cnum))&& (!empty($request_emp_email)))
		{
		   $mail_subject = "Library Clearance Form";
		   $mail_body =
			"From: ". $request_emp_name .
			"\n\nEmail: ". $request_emp_email .
			"\n\nName of Departing Employee : ". $emp_name .
			"\n\nDeparting Employee's Cane ID : ". $emp_cnum .
			"\n\nDepartment : ". $department .
			"\n\nSeparation Date: ". $start_date .
			"\n\nName of Employee Initiating Clearance Process : ". $request_emp_name .
			"\n\nCane ID of Employee Initiating Clearance Process : ". $request_emp_cnum .
			"\n\nEmail of Employee Initiating Clearance Process : ". $request_emp_email;

		//additional headers
		if(mail ($mail_to, $mail_subject, $mail_body, "From: $request_emp_name"))
		  {
			echo "<p><b>Thank you</b> for using the University of Miami Libraries - Library Clearance Form.<br><br>This is a confirmation that your request";
			echo " was submitted on <b>" . date("m-d-Y") . "</b></p>";
			echo "<p><b>Name of Departing Employee</b>: $emp_name<br />";
			echo "<b>Departing Employee's Cane ID</b>: $emp_cnum<br />";
			echo "<b>Department</b>: $department<br />";
			echo "<b>Date of Separation</b>: $start_date<br />";
			echo "<b>Name of Employee Initiating Clearance Process</b>: $request_emp_name<br />";
			echo "<b>Cane ID of Employee Initiating Clearance Process</b>: $request_emp_cnum<br />";
			echo "<b>Email of Employee Initiating Clearance Process</b>: $request_emp_email</p><br />";
			echo "<p>Clearances are processed during regular business hours. Please allow 48 hours for the process to be completed.";
			echo "  Once the employee has been cleared, you will receive a confirmation email.</p>";
		   }
		else
		  {
			echo "Failed to sent the e-mail.  To report the failure call the Richter Library 1st floor ";
		  	echo "Circulation Desk at (305) 284-3233. ";}
		}else
		{
			?>
			<p>Clearances are processed during regular business hours.
		Please allow 48 hours for the process to be completed.
		Once the employee has been cleared, you will receive a confirmation email.</p>
			<?php
			echo web_mail_form( $lobjElements, "/library-clearance-form/", "post", $lobjErrors );
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
