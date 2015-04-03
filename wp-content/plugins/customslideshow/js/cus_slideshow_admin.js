jQuery(document).ready(function($)
{
	function imageButtonsSetup()
	{
		$(".edit_colorbox").colorbox({
			ajax: true,
			href: objParams.admin_url,
			width: "50%",
			//before opening colorbox for editing, send data specific the image you are editing
			onOpen: function()
			{
				var lstrData = $(this).attr('cus-slideshow-data');
				var objData = lstrData.split('_');

				objParams.cat = objData[0];
				objParams.id = objData[1];
				objParams.action = 'cus_slideshow_ajax';
			},
			data: objParams
		});

		$(".delete_image").on("click", function()
		{
			var lboolConfirm = confirm("Are you sure you want to delete this image?");

			if( lboolConfirm )
			{
				var lstrData = $(this).attr('cus-slideshow-data');
				var objData = lstrData.split('_');

				$(this).after('<input type="hidden" name="cus_slideshow_delete" value="Delete" />');
				$(this).after('<input type="hidden" name="category" value="' + objData[0] + '" />');
				$(this).after('<input type="hidden" name="delete_id" value="' + objData[1] + '" />');

				$("#cus_slideshow_form").submit();
			}
		});
	}

	//colorbox configuration and trash on click event for image buttons
	imageButtonsSetup();

});