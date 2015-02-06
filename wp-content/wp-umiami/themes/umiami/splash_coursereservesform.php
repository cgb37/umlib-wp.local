<?php
/**
 * Template Name: Splash_CourseReservesForm
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
wp_enqueue_script('coursereserve-js', get_theme_root_uri() . "/umiami/js/coursereserves.js", array('jquery'));
?>
<!--<script language="javascript" src="http://library.miami.edu/mailbox/jquery.js"></script>-->
<!--<script language="javascript" src="<?php echo get_theme_root_uri(); ?>/umiami/js/coursereserves.js"></script>-->

<style>
table {border: none;}
table td.top {vertical-align: top;}
table td.bottom {vertical-align: bottom;}
#checklist_form
{
	display: none;
	position: fixed;
	background: url("<?php echo get_theme_root_uri(); ?>/umiami/images/background.png") repeat scroll center top transparent;
	height: 100%;
	width: 100%;
	z-index: 300;
	top: 0;
	left: 0;
}
#checklist_form div.first, #checklist_form div.second
{
	position: relative;
	background: white;
	height: 550px;
	width: 700px;
	top: 10%;
	margin-left: auto;
	margin-right: auto;
	padding: 10px;
	overflow: auto;
	z-index: 500;
}
#checklist_form div.first { display: block; }
#checklist_form div.second { display: none; }
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
require("inc/phpmailer/class.phpmailer.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$itemCount = $_POST['reserveItems'];

	$from = '';


	//Set up email properties
	$mail = new PHPMailer();
	$mail->From = "richter.reserves@miami.edu";
	$mail->FromName = "Faculty Reserves Request Form";
	$mail->Subject = "Faculty Reserves Request Form Submission";
	$mail->AddAddress('richter.reserves@miami.edu','Course Reserves');
	//$mail->AddAddress('shannonmoreno@miami.edu','Course Reserves');
	//$mail->AddAddress('s.roberts2@miami.edu','Course Reserves');

	$msg = "Course: ".$_POST['reserve_course']."\n";
	$msg .= "Instructor: ".$_POST['reserve_instructor_first'].' '.$_POST['reserve_instructor_last']."\n";
	$msg .= "Department: ".$_POST['reserve_department']."\n";
	$msg .= "Email: ".$_POST['reserve_email']."\n";
	$msg .= "Phone: ".$_POST['reserve_phone']."\n";
	$msg .= "Semester: ".$_POST['reserve_semester']."\n\n\n";

	//display everything checked
	$msg .= "Checklist for Fair Use Analysis\n\n";
	$msg .= "Checked from PURPOSE OF THE USE section:\n";
	foreach($_POST['reserve_pou_checklist'] as $lstrChecked)
	{
		$msg .= "     $lstrChecked\n";
	}

	$msg .= "\nChecked from NATURE OF THE COPYRIGHTED MATERIAL section:\n";
	foreach($_POST['reserve_nocm_checklist'] as $lstrChecked)
	{
		$msg .= "     $lstrChecked\n";
	}

	$msg .= "\nChecked from AMOUNT COPIED section:\n";
	foreach($_POST['reserve_ac_checklist'] as $lstrChecked)
	{
		$msg .= "     $lstrChecked\n";
	}

	$msg .= "\nChecked from EFFECT ON THE MARKET FOR THE ORIGINAL section:\n";
	foreach($_POST['reserve_eom_checklist'] as $lstrChecked)
	{
		$msg .= "     $lstrChecked\n";
	}

	$msg .= "\n\n\n";

	for($i = 1; $i <= $itemCount;$i++){
		$title = 'reserve_title_'.$i;
		$author = 'reserve_author_'.$i;
		$pubdate = 'reserve_pubdate_'.$i;
		$period = 'reserve_period_'.$i;
		$type = 'reserve_material_'.$i;
		$notes = 'reserve_notes_'.$i;

		$msg .= "Item #".$i."\n";
		if(!empty($_POST[$title])){$msg .= "Title:     ".$_POST[$title]."\n";}
		if(!empty($_POST[$author])){$msg .= "Author:     ".$_POST[$author]."\n";}
		if(!empty($_POST[$pubdate])){$msg .= "Publication Date:     ".$_POST[$pubdate]."\n";}
		$msg .= "Loan Period:     ".$_POST[$period]."\n";
		$msg .= "Material Type:     ".$_POST[$type]."\n";

		if($_POST[$type] == 'Electronic Reserves'){
			$msg .= "Delivering item to library? ".$_POST['reserve_deliver_'.$i]."\n";

			$tempFileName = trim($_FILES['reserve_file_'.$i]['name']);
			if(!empty($tempFileName)){
				$msg .= "Files attached?     Yes\n";
			}//end if
		}//end if
		else if($_POST[$type] == 'Personal Copy'){
			//$msg .= "Delivering item to library? ".$_POST['reserve_deliver_'.$i]."\n";
		}
		else if($_POST[$type] == 'Purchase Request'){
			if(!empty($_POST['reserve_isbn_'.$i])){$msg .= "ISBN: ".$_POST['reserve_isbn_'.$i]."\n";}
		}
		else if($_POST[$type] == 'Library Owned Item'){
			$msg .= "Call number:     ".$_POST['reserve_call_'.$i]."\n";
		}//end else
		else if($_POST[$type] == 'Other'){
			$msg .= "Delivering item to library? ".$_POST['reserve_deliver_'.$i]."\n";

			$tempFileName = trim($_FILES['reserve_file_'.$i]['name']);
			if(!empty($tempFileName)){
				$msg .= "Files attached?     Yes\n";
			}//end if
		}

		$msg .= "Notes:     ".$_POST[$notes]."\n";
		$msg .= "\n\n";
	}//end for

	//Attach any submitted files
	if(sizeof($_FILES) > 0){
		$msg .= "[FILES ATTACHED]\n\n";

		foreach($_FILES as $tempFile){
			if(!empty($tempFile['name'])){
				if(!$mail->AddAttachment(
					$tempFile['tmp_name'],
					$tempFile['name'],
					"base64",
					$tempFile['type']
				)){
					echo 'Could not attach files: '.$tempFile['name'].'<br />';
				};
			}
		}//end foreach
	}//end attach files

	//Forward request(s) to Course Reserves department
	$mail->Body = $msg;
	if(!$mail->Send()){
		echo 'There was an error submitting your reservation. Please contact Course Reserves at 305-284-3234 or by <a href="mailto:richter.reserves@miami.edu">Email</a>.';
	}//end if
	else{
		//Send confirmation email to instructor
		$confMsg = "Dear UM Faculty:\n\n";
		$confMsg .= "This e-mail is to confirm that we have received your online course reserves request. \n\n";
		$confMsg .= "We understand the importance and urgency of your request. Reserves are processed in the order they are received. Due to the large volume of requests at the beginning of the semester, please allow up to 10 days for the material to be made available. \n\n";
		$confMsg .= "After your reserves are completed, you will receive a confirmation e-mail with the information necessary to view the status of the materials and to access e-reserves.\n\n";
		$confMsg .= "We look forward to working with you for another successful semester.  Please contact us with any questions, comments, or suggestions.\n\n";
		$confMsg .= "Thank you,\n\n";
		$confMsg .= "Shannon Moreno\n";
		$confMsg .= "Reserves Supervisor\n";
		$confMsg .= "University of Miami Libraries\n";
		$confMsg .= "Otto G. Richter Library\n";
		$confMsg .= "1300 Memorial Dr\n";
		$confMsg .= "Coral Gables, Florida 33124\n\n";
		$confMsg .= "Email: shannonmoreno@miami.edu\n";
		$confMsg .= "Phone: 305-284-3234\n";
		$confMsg .= "Fax: 305-284-4027\n\n";
		$confMsg .= "http://www.library.miami.edu/services/reserves";

		$confMail = new PHPMailer();
		$confMail->From = "richter.reserves@miami.edu";
		$confMail->FromName = "Course Reserves";
		$confMail->Subject = "Course Reserves Confirmation";
		$confMail->AddAddress($_POST['reserve_email'], $_POST['reserve_instructor']);
		$confMail->Body = $confMsg;
		$confMail->Send();

		//Print confirmation message
		echo "<p>Professor <b>$_POST[reserve_instructor_first] $_POST[reserve_instructor_last]</b>,</p>";
		echo "<p>Thank you for your submission. A confirmation e-mail has been sent to your email address: $_POST[reserve_email]. ";
		echo "We will now process your reserves as soon as possible.</p>";

		echo "<p>Regards,</p>";

		echo "<p>";
		echo "Shannon Moreno<br />";
		echo "Reserves Supervisor<br />";
		echo "University of Miami Libraries<br />";
		echo "Otto G. Richter Library<br />";
		echo "1300 Memorial Dr<br />";
		echo "Coral Gables, Florida 33124<br /><br />";
		echo "Email: shannonmoreno@miami.edu<br />";
		echo "Phone: 305-284-3234<br />";
		echo "Fax: 305-284-4027<br /><br />";
		echo "</p>";


	}
}
else{
?>
<form action="<?php $PHP_SELF?>" method="post" enctype="multipart/form-data" onsubmit="return checkForm();">
<input type="hidden" name="reserveItems" id="reserveItems" value="" />
<table width="569" cellpadding="3">
    <tr id="errorRow" style="display: none;">
    	<td colspan="3">
        Please enter the highlighted fields and/or complete the &#34;Checklist for Fair Use Analysis&#34;.        </td>
    </tr>
	<tr>
	  <td colspan="2" valign="top"><sup>*</sup> - Denotes required field.</td>
	  <td width="50%" rowspan="8" valign="top">
	    <center>
	      <p><b>WARNING CONCERNING<br />
	        COPYRIGHT RESTRICTIONS</b>	          </p>
            </center>
       	      <p>
       	        The copyright law of the United States (Title 17, United States Code) governs the making of photocopies or other reproductions of copyrighted materials.<br />
       	        <br />
       	        Under certain conditions specified in the law, libraries and archives
        	      are authorized to furnish a reproduction. One of these specified
        	      conditions is that the reproduction is not to be "used for any
        	      purpose other than private study, scholarship, or research". If a
        	      person later uses a reproduction for purposes in excess of "fair
   	        use", that person may be liable for copyright infringement. </p></td>
	  </tr>
	<tr>
    	<td width="20%" class="top">Instructor<br />
    	  First Name:<sup>*</sup></td>
        <td width="30%" class="bottom"><input type="text" name="reserve_instructor_first" id="reserve_instructor_first" value="" /></td>
        </tr>

    <tr>
    	<td class="top">Instructor<br />
    	  Last Name:<sup>*</sup></td>
        <td class="bottom"><input type="text" name="reserve_instructor_last" id="reserve_instructor_last" value="" /></td>
    </tr>

    <tr>
    	<td class="top">Department:<sup>*</sup></td>
        <td class="bottom"><input type="text" name="reserve_department" id="reserve_department" value="" /></td>
    </tr>

    <tr>
    	<td class="top">Email:<sup>*</sup></td>
        <td class="bottom"><input type="text" name="reserve_email" id="reserve_email" value="" /></td>
    </tr>

	<tr>
    	<td class="top">Telephone:<sup>*</sup></td>
        <td class="bottom"><input type="text" name="reserve_phone" id="reserve_phone" value="" /></td>
    </tr>

    <tr>
    	<td class="top">Course ID:<sup>*</sup></td>
        <td class="bottom"><input type="text" name="reserve_course" id="reserve_course" value="" /></td>
    </tr>

    <tr>
    	<td class="top">Semester:<sup>*</sup></td>
        <td class="top">
        	<input type="radio" name="reserve_semester" id="reserve_semester" value="Spring" checked="checked" />&nbsp;Spring<br />
        	<input type="radio" name="reserve_semester" id="reserve_semester" value="Summer" />&nbsp;Summer<br />
            <input type="radio" name="reserve_semester" id="reserve_semester" value="Fall" />&nbsp;Fall<br />
            <input type="radio" name="reserve_semester" id="reserve_semester" value="Permanent" />&nbsp;Permanent        </td>
        </tr>
    <tr>
    	<td colspan="3" align="center">Complete <a id="checklist" href="#">Checklist for Fair Use Analysis</a><sup>*</sup></td>
	</tr>
</table>
<div id="checklist_form">
	<div align="center" class="first">
		<p>
		This checklist is a tool to assist you as you apply the fair use balancing test to specific situations in which you want to use copyrighted materials.
		If a particular use is fair use, it may proceed without authorization from the copyright owner; if the use does not fall within fair use, permission is necessary.
		</p>
		<p>
		The fair use analysis is always circumstantial and never entirely certain. For each of the four fair use factors below, determine whether each listed
		circumstance favors or disfavors fair use based on the specific material in question and the use desired. Licensed products and materials
		are governed by contracts that may limit or exclude provisions of Fair Use.
		</p>
		<input type="button" id="checklist_OK" value="OK"/>
	</div>
	<div align="center" class="second">
		<strong>PURPOSE OF THE USE</strong>
		<div style="padding-bottom: 15px;">
        	<div align="left" style="float: left; width: 50%;">
                <p>
                    <u>Favoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_pou_checklist[]" type="checkbox" value="Educational">  Educational
                    <ul>
                        <li>
                            Teaching (including multiple copies for classroom use)
                        </li>
                        <li>
                            Research
                        </li>
                        <li>
                            Scholarship
                        </li>
                        <li>
                            Criticism
                        </li>
                        <li>
                            Comment
                        </li>
                    </ul>
                </p>
                <p>
                    <input name="reserve_pou_checklist[]" type="checkbox" value="Transformative or Productive use"> Transformative or Productive use (Changes the work to serve a new purpose)
                </p>
                <p>
                    <input name="reserve_pou_checklist[]" type="checkbox" value="Nonprofit use">  Nonprofit use
                </p>
       		</div>
        	<div align="left" style="float: left; clear: right; width: 45%; padding-left: 5%;">
                <p>
                    <u>Disfavoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_pou_checklist[]" type="checkbox" value="Commercial, entertainment or other use"> Commercial, entertainment or other use.
          		</p>
                <p>
                  <input name="reserve_pou_checklist[]" type="checkbox" value="Verbatim or exact copy, not transformative"> Verbatim or exact copy, not transformative.
                </p>
                <p>
                    <input name="reserve_pou_checklist[]" type="checkbox" value="Profit generatinf use"> Profit generating use.
                </p>
        	</div>
			<div style="display: block; clear: both;"></div>
    	</div>
    	<strong>NATURE OF THE COPYRIGHTED MATERIAL</strong>
		<div style="padding-bottom: 15px;">
        	<div align="left" style="float: left; width: 50%;">
                <p>
                    <u>Favoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_nocm_checklist[]" type="checkbox" value="Factual, nonfiction, news">  Factual, nonfiction, news
    			</p>
                <p>
                    <input name="reserve_nocm_checklist[]" type="checkbox" value="Published work"> Published work
          		</p>
        </div>
        <div align="left" style="float: left; clear: right; width: 45%; padding-left: 5%;">
                <p>
                    <u>Disfavoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_nocm_checklist[]" type="checkbox" value="Creative or consumable work"> Creative or consumable work. (art, music, feature film, fiction; workbook, case study or test)
          		</p>
                <p>
                  <input name="reserve_nocm_checklist[]" type="checkbox" value="Unpublished work"> Unpublished work
                </p>
        </div>
		<div style="display: block; clear: both;"></div>
	    </div>
	    <strong>AMOUNT COPIED</strong>
	  	<div style="padding-bottom: 15px;">
	        <div align="left" style="float: left; width: 50%;">
                <p>
                    <u>Favoring Fair Use</u>
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value="Small quantity used"> Small quantity used (e.g. single chapter or journal article, other short excerpt (less than 10-15% of the whole work).
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value="Portion used is not central to work as a whole"> Portion used is not central to work as a whole
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value="Amount is appropriate to the educational purpose"> Amount is appropriate to the educational purpose
                </p>
	        </div>
	        <div align="left" style="float: left; clear: right; width: 45%; padding-left: 5%;">
                <p>
                    <u>Disfavoring Fair Use</u>
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value="Large portion or entire work"> Large portion or entire work.
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value='Portion used is central or the "heart" of the work'> Portion used is central or the "heart" of the work
                </p>
                <p>
                  <input name="reserve_ac_checklist[]" type="checkbox" value='Includes more than necessary for educational purpose'> Includes more than necessary for educational purpose
                </p>
        	</div>
			<div style="display: block; clear: both;"></div>
	    </div>
	    <strong>EFFECT ON THE MARKET FOR THE ORIGINAL</strong>
	    <div style="padding-bottom: 15px;">
	        <div align="left" style="float: left; width: 50%;">
                <p>
                    <u>Favoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="No significant effect on the market or potential market for the copyrighted work"> No significant effect on the market or potential market for the copyrighted work.
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="One or few copies made and/or distributed"> One or few copies made and/or distributed
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="No longer in print; absence of licensing mechanism"> No longer in print; absence of licensing mechanism.
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Restricted access (limited to students in a class or other appropriate group)"> Restricted access (limited to students in a class or other appropriate group).
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="One-time, spontaneous use (no time to obtain permission)"> One-time, spontaneous use (no time to obtain permission).
                </p>
	        </div>
	        <div align="left" style="float: left; clear: right; width: 45%; padding-left: 5%;">
                <p>
                    <u>Disfavoring Fair Use</u>
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Cumulative effect of copying would be to substitute for purchase of work"> Cumulative effect of copying would be to substitute for purchase of work.
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Numerous copies are made and/or distributed"> Numerous copies are made and/or distributed.
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Reasonably available licensing mechanism for obtaining permission exists (CCC license or off-prints for sale)"> Reasonably available licensing mechanism for obtaining permission exists (CCC license or off-prints for sale)
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Copy will be available on the Web or otherwise broadly distributed"> Copy will be available on the Web or otherwise broadly distributed.
                </p>
                <p>
                    <input name="reserve_eom_checklist[]" type="checkbox" value="Repeated or long-term use"> Repeated or long-term use.
                </p>
	        </div>
			<div style="display: block; clear: both;"></div>
    	</div>
    	<input id="checklist_exit" name="checklist_done" type="button" value="Done" />
    	<br /><br />
	</div>
</div>
<br /><br />
<sup>*</sup> - Denotes required field.<br /><br />
<div id="itemTable">
	<table border="0" cellspacing="0" width="569" id="table1">
    <tr align="center" bgcolor="#FFFFCC">
        <th width="2%" height="23">1</th>
        <th width="57%">Item Information</th>
        <th colspan="2" valign="top">Loan Period<sup>*</sup></th>
        <th colspan="2" valign="top">Material Type<sup>*</sup></th>
    </tr>
    <tr valign="top">
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">
            <table>
                <tr id="title_row_1">
                    <td width="123" valign="top">Title:<sup>*</sup></td>
                    <td width="187"><textarea name="reserve_title_1" id="reserve_title_1" rows="2" ></textarea></td>
                </tr>
                <tr id="author_row_1">
                    <td class="top">Author:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_author_1" id="reserve_author_1" size="25" /></td>
                </tr>
                <tr id="pubdate_row_1">
                    <td class="top">Publication Date:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_pubdate_1" id="reserve_pubdate_1" size="25" /></td>
                </tr>
                <tr id="call_row_1">
                    <td class="top">Call Number:<sup>*</sup></td>
                    <td><input type="text" name="reserve_call_1" id="reserve_call_1" size="25" /></td>
                </tr>
                <tr id="file_row_1" style="display:none;">
                    <td class="top">Add File:<sup style="display:none;">*</sup></td>
                    <td><input type="file" name="reserve_file_1" id="reserve_file_1" /></td>
                </tr>
                <tr id="deliver_row_1" style="display:none;">
                	<td class="top">Will you deliver the item?<sup style="display:none;">*</sup></td>
                    <td>
                    	<input type="radio" name="reserve_deliver_1" id="reserve_deliver_1" value="Yes" checked="checked"/>&nbsp;Yes&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="reserve_deliver_1" id="reserve_deliver_1" value="No" />No                    </td>
                </tr>
                <tr id="isbn_row_1" style="display:none;">
                	<td class="top">ISBN:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_isbn_1" id="reserve_isbn_1" value="" /></td>
                </tr>
                <tr>
                    <td class="top">Notes:<sup style="display:none;">*</sup></td>
                    <td><textarea name="reserve_notes_1" id="reserve_notes_1" rows="2" ></textarea></td>
                </tr>
            </table>        </td>
        <td width="5%">

              <div align="center">
                <input type="radio" name="reserve_period_1" id="reserve_period_1" value="3 hours" checked="checked" />
                <br />
              </div></td>
        <td width="12%">
          <p>3 hours          </p></td>
        <td width="6%">
            <div align="center">
              <input type="radio" name="reserve_material_1" id="reserve_material_1" value="Library Owned Item" checked="checked" />
            </div></td>
        <td width="18%">Library Owned Item</td>
    </tr>
    <tr valign="top">
      <td width="5%"><div align="center">
        <input type="radio" name="reserve_period_1" id="reserve_period_1" value="3 hours overnight" onclick="" />
      </div></td>
      <td>3 hours overnight</td>
      <td><div align="center">
        <input type="radio" name="reserve_material_1" id="reserve_material_1" value="Personal Copy" />
      </div></td>
      <td>Personal Copy</td>
    </tr>
    <tr valign="top">
      <td width="5%"><div align="center">
        <input type="radio" name="reserve_period_1" id="reserve_period_1" value="3 days" />
      </div></td>
      <td>3 days</td>
      <td><div align="center">
        <input type="radio" name="reserve_material_1" id="reserve_material_1" value="Electronic Reserves" />
      </div></td>
      <td>Electronic Reserves</td>
    </tr>
    <tr valign="top">
      <td width="5%" rowspan="2"><div align="center">
        <input type="radio" name="reserve_period_1" id="reserve_period_1" value="7 days" />
      </div></td>
      <td rowspan="2">7 days </td>
      <td><div align="center">
        <input type="radio" name="reserve_material_1" id="reserve_material_1" value="Purchase Request" />
      </div></td>
      <td>Purchase Request</td>
    </tr>
    <tr valign="top">
      <td><div align="center">
        <input type="radio" name="reserve_material_1" id="reserve_material_1" value="Other" />
      </div></td>
      <td>Other<br /><br /></td>
    </tr>
</table>
</div>
<input type="button" name="add" value="Add Item" onclick="addItem();" />
<input type="button" name="removeButton" id="removeButton" value="Remove Last Item" onclick="removeItem();" disabled="disabled" />
<br /><br />

<input type="submit" name="submit" value="Submit" />
</form>
<?php
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