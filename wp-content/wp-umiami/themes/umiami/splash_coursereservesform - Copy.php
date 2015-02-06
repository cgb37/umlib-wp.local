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

get_header(); ?>
<!--<script language="javascript" src="http://library.miami.edu/mailbox/jquery.js"></script>-->
<script language="javascript">
var itemCount = 1;
var dynamicFields = ['reserve_title'];

function addItem(){
	itemCount++;

	/*
	var tableString =
	'<table border="0" cellspacing="0" width="569" id="table' + itemCount + '">' +
    '<tr align="center">' +
        '<th width="2%">' + itemCount + '</th>' +
        '<th width="57%">Item Information</th>' +
        '<th colspan="2">Loan Period<sup>*</sup></th>' +
        '<th colspan="2">Material Type<sup>*</sup></th>' +
    '</tr>' +

    '<tr valign="top">' +
        '<td>&nbsp;</td>' +
        '<td>' +
            '<table>' +
                '<tr id="title_row_'+ itemCount +'">' +
                    '<td width="150">Title:<sup>*</sup></td>' +
                    '<td><textarea name="reserve_title_'+ itemCount +'" id="reserve_title_'+ itemCount +'" rows="2" ></textarea></td>' +
                '</tr>' +
                '<tr id="author_row_'+ itemCount +'">' +
                    '<td>Author:<sup style="display:none;">*</sup></td>' +
                    '<td><input type="text" name="reserve_author_'+ itemCount +'" id="reserve_author_'+ itemCount +'" size="25" /></td>' +
                '</tr>' +
                '<tr id="pubdate_row_'+ itemCount +'">' +
                    '<td>Publication Date:<sup style="display:none;">*</sup></td>' +
                    '<td><input type="text" name="reserve_pubdate_'+ itemCount +'" id="reserve_pubdate_'+ itemCount +'" size="25" /></td>' +
                '</tr>' +
                '<tr id="call_row_'+ itemCount +'">' +
                    '<td>Call Number:<sup>*</sup></td>' +
                    '<td><input type="text" name="reserve_call_'+ itemCount +'" id="reserve_call_'+ itemCount +'" size="25" /></td>' +
                '</tr>' +
                '<tr id="file_row_'+ itemCount +'" style="display:none;">' +
                    '<td>Add File:<sup style="display:none;">*</sup></td>' +
                    '<td><input type="file" name="reserve_file_'+ itemCount +'" id="reserve_file_'+ itemCount +'" /></td>' +
                '</tr>' +
                '<tr id="deliver_row_'+ itemCount +'" style="display:none;">' +
                	'<td>Will you deliver the item?<sup style="display:none;">*</sup></td>' +
                    '<td>' +
                    	'<input type="radio" name="reserve_deliver_'+ itemCount +'" id="reserve_deliver_1" value="Yes" checked="checked" />&nbsp;Yes&nbsp;&nbsp;&nbsp;' +
                        '<input type="radio" name="reserve_deliver_'+ itemCount +'" id="reserve_deliver_1" value="No" />No' +
					'</td>' +
                '</tr>' +
                '<tr id="isbn_row_'+ itemCount +'" style="display:none;">' +
                	'<td>ISBN:<sup style="display:none;">*</sup></td>' +
                    '<td><input type="text" name="reserve_isbn_1" id="reserve_isbn_1" value="" /></td>' +
                '</tr>' +
                '<tr>' +
                    '<td>Notes:</td>' +
                    '<td><textarea name="reserve_notes_'+ itemCount +'" id="reserve_notes_'+ itemCount +'" rows="2" ></textarea></td>' +
                '</tr>' +
            '</table>' +
        '</td>' +
        '<td>' +
            '<input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 hours" checked="checked" />&nbsp;3 hours<br /><br />' +
            '<input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 hours overnight" />&nbsp;3 hours overnight<br /><br />' +
            '<input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 days" />&nbsp;3 days<br /><br />' +
            '<input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="7 days" />&nbsp;7 days<br /><br />' +
        '</td>' +
        '<td>' +
            '<input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Library Owned Item" checked="checked" />&nbsp;Library Owned Item<br /><br />' +
            '<input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Personal Copy" />&nbsp;Personal Copy<br /><br />' +
            '<input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Electronic Reserves" />&nbsp;Electronic Reserves<br /><br />' +
            '<input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Purchase Request" />&nbsp;Purchase Request<br /><br />' +
            '<input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Other" />&nbsp;Other<br /><br />' +
        '</td>' +
    '</tr>' +
'</table>';
*/

	var tableString =
	'	<table border="0" cellspacing="0" width="569" id="table' + itemCount + '">' +
	'    <tr align="center" bgcolor="#FFFFCC" height="23">' +
	'        <th width="2%">' + itemCount + '</th>' +
	'        <th width="57%">Item Information</th>' +
	'        <th colspan="2" valign="top">Loan Period<sup>*</sup></th>' +
	'        <th colspan="2" valign="top">Material Type<sup>*</sup></th>' +
	'    </tr>' +
	'    <tr valign="top">' +
	'        <td rowspan="5">&nbsp;</td>' +
	'        <td rowspan="5">' +
	'            <table>' +
	'                <tr id="title_row_' + itemCount + '">' +
	'                    <td width="123" valign="top">Title:<sup>*</sup></td>' +
	'                    <td width="187"><textarea name="reserve_title_' + itemCount + '" id="reserve_title_' + itemCount + '" rows="2" ></textarea></td>' +
	'                </tr>' +
	'                <tr id="author_row_' + itemCount + '">' +
	'                    <td valign="top">Author:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_author_' + itemCount + '" id="reserve_author_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="pubdate_row_' + itemCount + '">' +
	'                    <td valign="top">Publication Date:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_pubdate_' + itemCount + '" id="reserve_pubdate_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="call_row_' + itemCount + '">' +
	'                    <td valign="top">Call Number:<sup>*</sup></td>' +
	'                    <td><input type="text" name="reserve_call_' + itemCount + '" id="reserve_call_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="file_row_' + itemCount + '" style="display:none;">' +
	'                    <td valign="top">Add File:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="file" name="reserve_file_' + itemCount + '" id="reserve_file_' + itemCount + '" /></td>' +
	'                </tr>' +
	'                <tr id="deliver_row_' + itemCount + '" style="display:none;">' +
	'                	<td valign="top">Will you deliver the item?<sup style="display:none;">*</sup></td>' +
	'                    <td>' +
	'                    	<input type="radio" name="reserve_deliver_' + itemCount + '" id="reserve_deliver_' + itemCount +
	'" value="Yes" checked="checked"/>&nbsp;Yes&nbsp;&nbsp;&nbsp;' +
	'                        <input type="radio" name="reserve_deliver_' + itemCount + '" id="reserve_deliver_' + itemCount + '" value="No" />No</td>' +
	'                </tr>' +
	'                <tr id="isbn_row_' + itemCount + '" style="display:none;">' +
	'                	<td valign="top">ISBN:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_isbn_' + itemCount + '" id="reserve_isbn_' + itemCount + '" value="" /></td>' +
	'                </tr>' +
	'                <tr>' +
	'                    <td valign="top">Notes:<sup style="display:none;">*</sup></td>' +
	'                    <td><textarea name="reserve_notes_' + itemCount + '" id="reserve_notes_' + itemCount + '" rows="2" ></textarea></td>' +
	'                </tr>                             ' +
	'            </table>        </td>' +
	'        <td width="5%">' +

	'              <div align="center">' +
	'                <input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 hours" checked="checked" />' +
	'                <br />' +
	'              </div></td>' +
	'        <td width="12%">' +
	'          <p>3 hours          </p></td>' +
	'        <td width="6%">' +
	'            <div align="center">' +
	'              <input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Library Owned Item" checked="checked" />' +
	'            </div></td>' +
	'        <td width="18%">Library Owned Item</td>' +
	'    </tr>' +
	'    <tr valign="top">' +
	'      <td width="5%"><div align="center">' +
	'        <input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 hours overnight" onclick="" />' +
	'      </div></td>' +
	'      <td>3 hours overnight</td>' +
	'      <td><div align="center">' +
	'        <input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Personal Copy" />' +
	'      </div></td>' +
	'      <td>Personal Copy</td>' +
	'    </tr>' +
	'    <tr valign="top">' +
	'      <td width="5%"><div align="center">' +
	'        <input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="3 days" />' +
	'      </div></td>' +
	'      <td>3 days</td>' +
	'      <td><div align="center">' +
	'        <input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Electronic Reserves" />' +
	'      </div></td>' +
	'      <td>Electronic Reserves</td>' +
	'    </tr>' +
	'    <tr valign="top">' +
	'      <td width="5%" rowspan="2"><div align="center">' +
	'        <input type="radio" name="reserve_period_' + itemCount + '" id="reserve_period_' + itemCount + '" value="7 days" />' +
	'      </div></td>' +
	'      <td rowspan="2">7 days </td>' +
	'      <td><div align="center">' +
	'        <input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Purchase Request" />' +
	'      </div></td>' +
	'      <td>Purchase Request</td>' +
	'    </tr>' +
	'    <tr valign="top">' +
	'      <td><div align="center">' +
	'        <input type="radio" name="reserve_material_' + itemCount + '" id="reserve_material_' + itemCount + '" value="Other" />' +
	'     </div></td>' +
	'      <td>Other<br /><br /></td>' +
	'    </tr>' +
	'</table>';

	$('#itemTable').append(tableString);
	window.scrollTo(0,window.outerHeight);

	$("input[name='reserve_material_" + itemCount + "']").click(
		function(){

			if ($("input[name='reserve_material_" + itemCount + "']:checked").val() == 'Library Owned Item'){
				$('#call_row_' + itemCount).show();
				$('#deliver_row_' + itemCount).hide();
				$('#file_row_' + itemCount).hide();
				$('#isbn_row_' + itemCount).hide();

				//Highlight required fields
				$('#title_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#pubdate_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#call_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#deliver_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#author_row_'+ itemCount + ' td:first sup').css('display','none');
			}
			else if($("input[name='reserve_material_" + itemCount + "']:checked").val() == 'Electronic Reserves'){
				$('#call_row_' + itemCount).hide();
				$('#deliver_row_' + itemCount).show();
				$('#file_row_' + itemCount).show();
				$('#isbn_row_' + itemCount).hide();

				//Highlight required fields
				$('#title_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#pubdate_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#call_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#deliver_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#author_row_'+ itemCount + ' td:first sup').css('display','inline');
			}
			else if($("input[name='reserve_material_" + itemCount + "']:checked").val() == 'Other'){
				$('#call_row_' + itemCount).hide();
				$('#deliver_row_' + itemCount).show();
				$('#file_row_' + itemCount).show();
				$('#isbn_row_' + itemCount).hide();

				//Highlight required fields
				$('#title_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#pubdate_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#call_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#deliver_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#author_row_'+ itemCount + ' td:first sup').css('display','inline');
			}
			else if($("input[name='reserve_material_" + itemCount + "']:checked").val() == 'Purchase Request'){
				$('#call_row_' + itemCount).hide();
				$('#deliver_row_' + itemCount).hide();
				$('#file_row_' + itemCount).hide();
				$('#isbn_row_' + itemCount).show();

				//Highlight required fields
				$('#title_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#pubdate_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#call_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#deliver_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#author_row_'+ itemCount + ' td:first sup').css('display','inline');
			}
			else if($("input[name='reserve_material_" + itemCount + "']:checked").val() == 'Personal Copy'){
				$('#call_row_' + itemCount).hide();
				$('#deliver_row_' + itemCount).hide();
				$('#file_row_' + itemCount).hide();
				$('#isbn_row_' + itemCount).hide();

				//Highlight required fields
				$('#title_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#pubdate_row_'+ itemCount + ' td:first sup').css('display','inline');
				$('#call_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#deliver_row_'+ itemCount + ' td:first sup').css('display','none');
				$('#author_row_'+ itemCount + ' td:first sup').css('display','inline');
			}
		}
	);

	if(itemCount > 1){
		$('#removeButton').attr('disabled','');
	}
}//end function

function removeItem(){
	if(itemCount > 1){
		var tableString = '#table' + itemCount;
		$(tableString).remove();

		itemCount--;
		if(itemCount == 1){
			$('#removeButton').attr('disabled','disabled');
		}
	}
}//end function

function checkForm(){
	var errorsDetected = false;

	//Hide previous error messages
	$('#errorRow').hide();
	$('input[type="text"]').css('background-color','#FFFFFF');
	$('textarea').css('background-color','#FFFFFF');

	if($.trim($('#reserve_instructor_first').val()) == ''){
		$('#reserve_instructor_first').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	if($.trim($('#reserve_instructor_last').val()) == ''){
		$('#reserve_instructor_last').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	if($.trim($('#reserve_department').val()) == ''){
		$('#reserve_department').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	if($.trim($('#reserve_email').val()) == ''){
		$('#reserve_email').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	if($.trim($('#reserve_phone').val()) == ''){
		$('#reserve_phone').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	if($.trim($('#reserve_course').val()) == ''){
		$('#reserve_course').css('background-color','#FFCCCC');
		errorsDetected = true;
	}

	//Temp variables
	var fieldname = '';
	var mattype = '';
	var callnum = '';

	//Field variables
	var titleField = '';
	var callField = '';
	var authorField = '';
	var pubdateField = '';

	for(var i = 1;i <= itemCount;i++){
		mattype = $("input[name='reserve_material_" + i + "']:checked").val();

		//Field names for current item
		titleField = '#reserve_title_' + i;
		callField = '#reserve_call_' + i;
		authorField = '#reserve_author_' + i;
		pubdateField = '#reserve_pubdate_' + i;

		//Check for call number on library owned items
		if(mattype == 'Library Owned Item'){
			callnum = $.trim($('#reserve_call_' + i).val());
			if(callnum == ''){
				$('#reserve_call_' + i).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(titleField).val()) == ''){
				$(titleField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}
		}
		else if(mattype == 'Personal Copy'){
			if($.trim($(titleField).val()) == ''){
				$(titleField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(authorField).val()) == ''){
				$(authorField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(pubdateField).val()) == ''){
				$(pubdateField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}
		}
		else if(mattype == 'Electronic Reserves'){
			if($.trim($(titleField).val()) == ''){
				$(titleField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(pubdateField).val()) == ''){
				$(pubdateField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(authorField).val()) == ''){
				$(authorField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}
		}
		else if(mattype == 'Purchase Request'){
			if($.trim($(titleField).val()) == ''){
				$(titleField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(pubdateField).val()) == ''){
				$(pubdateField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(authorField).val()) == ''){
				$(authorField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}
		}
		else if(mattype == 'Other'){
			if($.trim($(titleField).val()) == ''){
				$(titleField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(authorField).val()) == ''){
				$(authorField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}

			if($.trim($(pubdateField).val()) == ''){
				$(pubdateField).css('background-color','#FFCCCC');
				errorsDetected = true;
			}
		}
	}//end for

	if(errorsDetected){
		$('#errorRow').css('background-color','#FFCCCC');
		$('#errorRow').css('color','#FF0000');
		$('#errorRow').css('font-weight','bold');
		$('#errorRow').show();
		return false;
	}

	$('#reserveItems').val(itemCount);

	return true;

}//end function
</script>

<style>
table {border: none;}
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
	//$mail->AddAddress('e.savage1@umiami.edu','Course Reserves');

	$msg = "Course: ".$_POST['reserve_course']."\n";
	$msg .= "Instructor: ".$_POST['reserve_instructor_first'].' '.$_POST['reserve_instructor_last']."\n";
	$msg .= "Department: ".$_POST['reserve_department']."\n";
	$msg .= "Email: ".$_POST['reserve_email']."\n";
	$msg .= "Phone: ".$_POST['reserve_phone']."\n";
	$msg .= "Semester: ".$_POST['reserve_semester']."\n\n\n";

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
        Please enter the highlighted fields.        </td>
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
    	<td width="20%" valign="top">Instructor<br />
    	  First Name:<sup>*</sup></td>
        <td width="30%" valign="bottom"><input type="text" name="reserve_instructor_first" id="reserve_instructor_first" value="" /></td>
        </tr>

    <tr>
    	<td valign="top">Instructor<br />
    	  Last Name:<sup>*</sup></td>
        <td valign="bottom"><input type="text" name="reserve_instructor_last" id="reserve_instructor_last" value="" /></td>
    </tr>

    <tr>
    	<td valign="top">Department:<sup>*</sup></td>
        <td valign="bottom"><input type="text" name="reserve_department" id="reserve_department" value="" /></td>
    </tr>

    <tr>
    	<td valign="top">Email:<sup>*</sup></td>
        <td valign="bottom"><input type="text" name="reserve_email" id="reserve_email" value="" /></td>
    </tr>

	<tr>
    	<td valign="top">Telephone:<sup>*</sup></td>
        <td valign="bottom"><input type="text" name="reserve_phone" id="reserve_phone" value="" /></td>
    </tr>

    <tr>
    	<td valign="top">Course ID:<sup>*</sup></td>
        <td valign="bottom"><input type="text" name="reserve_course" id="reserve_course" value="" /></td>
    </tr>

    <tr>
    	<td valign="top">Semester:<sup>*</sup></td>
        <td valign="top">
        	<input type="radio" name="reserve_semester" id="reserve_semester" value="Spring" checked="checked" />&nbsp;Spring<br />
        	<input type="radio" name="reserve_semester" id="reserve_semester" value="Summer" />&nbsp;Summer<br />
            <input type="radio" name="reserve_semester" id="reserve_semester" value="Fall" />&nbsp;Fall<br />
            <input type="radio" name="reserve_semester" id="reserve_semester" value="Permanent" />&nbsp;Permanent        </td>
        </tr>
</table>
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
                    <td valign="top">Author:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_author_1" id="reserve_author_1" size="25" /></td>
                </tr>
                <tr id="pubdate_row_1">
                    <td valign="top">Publication Date:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_pubdate_1" id="reserve_pubdate_1" size="25" /></td>
                </tr>
                <tr id="call_row_1">
                    <td valign="top">Call Number:<sup>*</sup></td>
                    <td><input type="text" name="reserve_call_1" id="reserve_call_1" size="25" /></td>
                </tr>
                <tr id="file_row_1" style="display:none;">
                    <td valign="top">Add File:<sup style="display:none;">*</sup></td>
                    <td><input type="file" name="reserve_file_1" id="reserve_file_1" /></td>
                </tr>
                <tr id="deliver_row_1" style="display:none;">
                	<td valign="top">Will you deliver the item?<sup style="display:none;">*</sup></td>
                    <td>
                    	<input type="radio" name="reserve_deliver_1" id="reserve_deliver_1" value="Yes" checked="checked"/>&nbsp;Yes&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="reserve_deliver_1" id="reserve_deliver_1" value="No" />No                    </td>
                </tr>
                <tr id="isbn_row_1" style="display:none;">
                	<td valign="top">ISBN:<sup style="display:none;">*</sup></td>
                    <td><input type="text" name="reserve_isbn_1" id="reserve_isbn_1" value="" /></td>
                </tr>
                <tr>
                    <td valign="top">Notes:<sup style="display:none;">*</sup></td>
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
<script language="javascript">
$("input[name='reserve_material_1']").click(
	function(){

		if ($("input[name='reserve_material_1']:checked").val() == 'Library Owned Item'){
			//Hide/show fields
			$('#call_row_1').show();
			$('#deliver_row_1').hide();
			$('#file_row_1').hide();
			$('#isbn_row_1').hide();

			//Highlight required fields
			$('#title_row_1 td:first sup').css('display','inline');
			$('#pubdate_row_1 td:first sup').css('display','none');
			$('#call_row_1 td:first sup').css('display','inline');
			$('#deliver_row_1 td:first sup').css('display','none');
			$('#author_row_1 td:first sup').css('display','none');
		}
		else if($("input[name='reserve_material_1']:checked").val() == 'Electronic Reserves'){
			//Hide/show fields
			$('#call_row_1').hide();
			$('#deliver_row_1').show();
			$('#file_row_1').show();
			$('#isbn_row_1').hide();

			//Highlight required fields
			$('#title_row_1 td:first sup').css('display','inline');
			$('#pubdate_row_1 td:first sup').css('display','inline');
			$('#call_row_1 td:first sup').css('display','none');
			$('#deliver_row_1 td:first sup').css('display','inline');
			$('#author_row_1 td:first sup').css('display','inline');
		}
		else if($("input[name='reserve_material_1']:checked").val() == 'Other'){
			//Hide/show fields
			$('#call_row_1').hide();
			$('#deliver_row_1').show();
			$('#file_row_1').show();
			$('#isbn_row_1').hide();

			//Highlight required fields
			$('#title_row_1 td:first sup').css('display','inline');
			$('#pubdate_row_1 td:first sup').css('display','inline');
			$('#call_row_1 td:first sup').css('display','none');
			$('#deliver_row_1 td:first sup').css('display','inline');
			$('#author_row_1 td:first sup').css('display','inline');
		}
		else if($("input[name='reserve_material_1']:checked").val() == 'Purchase Request'){
			//Hide/show fields
			$('#call_row_1').hide();
			$('#deliver_row_1').hide();
			$('#file_row_1').hide();
			$('#isbn_row_1').show();

			//Highlight required fields
			$('#title_row_1 td:first sup').css('display','inline');
			$('#pubdate_row_1 td:first sup').css('display','inline');
			$('#call_row_1 td:first sup').css('display','none');
			$('#deliver_row_1 td:first sup').css('display','none');
			$('#author_row_1 td:first sup').css('display','inline');
		}
		else if($("input[name='reserve_material_1']:checked").val() == 'Personal Copy'){
			//Hide/show fields
			$('#call_row_1').hide();
			$('#deliver_row_1').hide();
			$('#file_row_1').hide();
			$('#isbn_row_1').hide();

			//Highlight required fields
			$('#title_row_1 td:first sup').css('display','inline');
			$('#pubdate_row_1 td:first sup').css('display','inline');
			$('#call_row_1 td:first sup').css('display','none');
			$('#deliver_row_1 td:first sup').css('display','none');
			$('#author_row_1 td:first sup').css('display','inline');
		}
	}
);
</script>
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
