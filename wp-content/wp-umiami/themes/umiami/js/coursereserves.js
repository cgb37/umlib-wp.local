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
	'                    <td class="top">Author:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_author_' + itemCount + '" id="reserve_author_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="pubdate_row_' + itemCount + '">' +
	'                    <td class="top">Publication Date:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_pubdate_' + itemCount + '" id="reserve_pubdate_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="call_row_' + itemCount + '">' +
	'                    <td class="top">Call Number:<sup>*</sup></td>' +
	'                    <td><input type="text" name="reserve_call_' + itemCount + '" id="reserve_call_' + itemCount + '" size="25" /></td>' +
	'                </tr>' +
	'                <tr id="file_row_' + itemCount + '" style="display:none;">' +
	'                    <td class="top">Add File:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="file" name="reserve_file_' + itemCount + '" id="reserve_file_' + itemCount + '" /></td>' +
	'                </tr>' +
	'                <tr id="deliver_row_' + itemCount + '" style="display:none;">' +
	'                	<td class="top">Will you deliver the item?<sup style="display:none;">*</sup></td>' +
	'                    <td>' +
	'                    	<input type="radio" name="reserve_deliver_' + itemCount + '" id="reserve_deliver_' + itemCount +
	'" value="Yes" checked="checked"/>&nbsp;Yes&nbsp;&nbsp;&nbsp;' +
	'                        <input type="radio" name="reserve_deliver_' + itemCount + '" id="reserve_deliver_' + itemCount + '" value="No" />No</td>' +
	'                </tr>' +
	'                <tr id="isbn_row_' + itemCount + '" style="display:none;">' +
	'                	<td class="top">ISBN:<sup style="display:none;">*</sup></td>' +
	'                    <td><input type="text" name="reserve_isbn_' + itemCount + '" id="reserve_isbn_' + itemCount + '" value="" /></td>' +
	'                </tr>' +
	'                <tr>' +
	'                    <td class="top">Notes:<sup style="display:none;">*</sup></td>' +
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
		$('#removeButton').removeAttr("disabled");
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
	$('a#checklist').css('color','#21759B');

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

	//make sure that at least one checkbox has been checked in every section
	if(!check_section_checklist('pou')){
		$('a#checklist').css('color','red');
		errorsDetected = true;
	}else if(!check_section_checklist('nocm')){
		$('a#checklist').css('color','red');
		errorsDetected = true;
	}else if(!check_section_checklist('ac')){
		$('a#checklist').css('color','red');
		errorsDetected = true;
	}else if(!check_section_checklist('eom')){
		$('a#checklist').css('color','red');
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
		window.scrollTo(0, 0);
		return false;
	}

	$('#reserveItems').val(itemCount);

	return true;

}//end function

function check_section_checklist(name)
{
	var isValid = false;
	var element = 'input[name="reserve_' + name + '_checklist[]"]';
		$(element).each(function(){
			if($(this).is(':checked'))
			{
				isValid = true;
				return;
			}
		});
		return isValid;
}

jQuery(document).ready(function($)
{
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

	//added by dgonzalez to add the Checklist for Fair Use Analysis
	$("#checklist").click(function(e)
	{
		e.preventDefault();

		$("#checklist_form").css('display', 'block');
	});

	$("#checklist_OK").click(function(e)
	{
		$("#checklist_form div.first").css('display', 'none');
		$("#checklist_form div.second").css('display', 'block');
	});

	$("#checklist_exit").click(function()
	{
		$("#checklist_form").css('display', 'none');
		$("#checklist_form div.first").css('display', 'block');
		$("#checklist_form div.second").css('display', 'none');
	});

	$("#checklist_form").click(function(e)
	{
		if($("#checklist_form").has(e.target).length === 0)
		{
			$("#checklist_form").css('display', 'none');
			$("#checklist_form div.first").css('display', 'block');
			$("#checklist_form div.second").css('display', 'none');
		}

	});
});