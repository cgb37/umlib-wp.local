<?php
/*
   Plugin Name: Custom Slideshow
   Description: This plugin helps create and manage a custom slideshow
   Version: 1.2
   Author: David Gonzalez
   License: GPL2
   Copyright: David Gonzalez, U of Miami Libraries
*/

define('CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH', get_theme_root() . '/' . strtolower(str_replace(' ', '', wp_get_theme())) . '/images/CSbackground/');
define('CUSTOM_SLIDESHOW_MAX_IMAGES', 5);

register_activation_hook(__FILE__, 'cus_slideshow_install');
register_uninstall_hook(__FILE__, 'cus_slideshow_uninstall');
add_action( 'admin_menu' , 'cus_slideshow_admin_menu' );
add_shortcode('custom_slideshow', 'custom_slideshow_display');
add_action( 'wp_ajax_cus_slideshow_ajax', 'cus_slideshow_ajax_update' );

function cus_slideshow_install()
{
	global $wpdb;

	if(!is_dir(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH))
	{
		$lboolSuccess = mkdir(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH);

		if(!$lboolSuccess)
		{
			trigger_error(__('Error! Cannot automatically create upload folder. Please add it manually and try again. Path: ' . CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH ), E_USER_ERROR);
		}
	}

	$lstrTableName = $wpdb->prefix . "cus_slideshow";

	if( $wpdb->get_var("SHOW TABLES LIKE '$lstrTableName'") != $lstrTableName)
	{
		$lstrQuery = "CREATE TABLE $lstrTableName (
		imageID INT NOT NULL AUTO_INCREMENT,
		imageTitle VARCHAR(500) NOT NULL,
		imageLinkTitle VARCHAR(500) NOT NULL DEFAULT '',
		imageLink VARCHAR(500) NOT NULL DEFAULT '',
		imageContent VARCHAR(500) NOT NULL DEFAULT '',
		imageName VARCHAR(500) NOT NULL,
		imageCategory VARCHAR(100) NOT NULL DEFAULT '',
		imageSort INT NOT NULL DEFAULT 0,
		PRIMARY KEY  (imageID),
		UNIQUE KEY imageName_Unique (imageName)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		dbDelta($lstrQuery);
	}

	add_option('cus_slideshow_categories', array());
}

function cus_slideshow_uninstall()
{
	$lstrTableName = $wpdb->prefix . "cus_slideshow";

	if( $wpdb->get_var("SHOW TABLES LIKE '$lstrTableName'") == $lstrTableName)
	{
		$lstrQuery = "DROP TABLE $lstrTableName;";

		dbDelta($lstrQuery);
	}

	delete_option('cus_slideshow_categories');
}

function cus_slideshow_admin_menu()
{
	//add_theme_page('Custom Slideshow Settings Page', 'Custom Slideshow Settings', 'administrator',__FILE__, 'cus_slideshow_settings_main' );
	//changed to let editors use this plugin as well
	add_menu_page('Custom Slideshow', 'Custom Slideshow', 'edit_pages', __FILE__ , 'cus_slideshow_settings_main');

	add_submenu_page(__FILE__, 'Manage Slideshows', 'Manage Slideshows', 'edit_pages', __FILE__ . '_slideshows', 'cus_slideshow_settings_slideshow');
	add_submenu_page(__FILE__, 'Manage Categories', 'Manage Categories', 'edit_pages', __FILE__ . '_categories', 'cus_slideshow_settings_category');
}

function cus_slideshow_setup_scripts()
{
	wp_enqueue_script( 'cus_slideshow_colorbox', plugins_url( '/js/jquery.colorbox.js', __FILE__ ), array("jquery") );
	wp_enqueue_script( 'cus_slideshow_js_admin', plugins_url( '/js/cus_slideshow_admin.js', __FILE__ ), array("jquery", "cus_slideshow_colorbox") );
	wp_enqueue_style( 'cus_slideshow_colorbox_css', plugins_url( '/css/colorbox.css', __FILE__ ) );

	$objParams = array( "admin_url" => admin_url() . 'admin-ajax.php', "plugin_url" => plugin_dir_url(__FILE__) );
	wp_localize_script( 'cus_slideshow_js_admin', 'objParams', $objParams );
}

function cus_slideshow_settings_main()
{
	?>
	<div class="wrap">
		<h2>Custom Slideshow Settings</h2>

		<p>Please choose from one of the following: </p>
		<br />
		<a href="admin.php?page=customslideshow/customslideshow.php_slideshows">Manage Slideshows</a>
		<br /><br />
		<a href="admin.php?page=customslideshow/customslideshow.php_categories">Manage Categories</a>
	</div>
	<?php
}

function cus_slideshow_settings_slideshow()
{
	//setup necessary scripts
	cus_slideshow_setup_scripts();

	$lstrImageTitle = '';
	$lstrImageLinkTitle = '';
	$lstrImageLink = '';
	$lstrImageContent = '';
	$lstrSelected = '';

	if(isset($_POST['imageTitle']))
	{
		$lstrImageTitle = $_POST['imageTitle'];
		$lstrImageLinkTitle = $_POST['imageLinkTitle'];
		$lstrImageLink = $_POST['imageLink'];
		$lstrImageContent = $_POST['imageContent'];
		$lstrImageCategory = $_POST['imageCategory'];
	}

	if(isset($_POST['cus_slideshow_submit']))
	{
		if(cus_slideshow_validate_inputs($lstrImageCategory))
		{
			$lstrImageName = cus_slideshow_file_upload();

			if($lstrImageName != '')
			{
				$lboolSuccess = cus_slideshow_update_table($lstrImageTitle, $lstrImageLinkTitle, $lstrImageLink, $lstrImageContent, $lstrImageName, $lstrImageCategory);

				if($lboolSuccess)
				{
					$lstrImageTitle = '';
					$lstrImageLinkTitle = '';
					$lstrImageLink = '';
					$lstrImageContent = '';
				}
			}
		}
	}

	if(isset($_POST['cus_slideshow_update']))
	{
		$lintId = isset( $_POST['id'] ) ? intval($_POST['id']) : '';
		$lintSort = isset( $_POST['imageSort'] ) ? intval($_POST['imageSort']) : '';

		cus_slideshow_update_image( $lintId, $lstrImageTitle, $lstrImageLinkTitle, $lstrImageLink, $lstrImageContent, $lintSort );

		$lstrImageTitle = '';
		$lstrImageLinkTitle = '';
		$lstrImageLink = '';
		$lstrImageContent = '';
	}

	if(isset($_POST['cus_slideshow_delete']))
	{
		if($_POST['delete_id'])
		{
			$lintId = $_POST['delete_id'];

			$lboolExecuted = cus_slideshow_deleteRecord($lintId);
		}


	}

	if(isset($_POST['cus_slideshow_load']))
	{
		$lstrSelected = $_POST['imageCategoryLoad'];
	}

	?>
<div class="wrap">
	<h2>Custom Slideshow Settings</h2>

	<form id="cus_slideshow_form" method="post" action="#" enctype="multipart/form-data">

	<table class="form-table">
		<tr valign="top">
			<td style="padding-bottom:20px;"><a href="admin.php?page=customslideshow/customslideshow.php_categories">Go to Manage Categories</a></td>
		</tr>

		<tr valign="top">
		<th scope="row">Title</th>
		<td><input id="imageTitle" type="text" size="100" maxlength="500" name="imageTitle" value="<?php echo $lstrImageTitle; ?>"/></td>
		</tr>

		<tr valign="top">
		<th scope="row">Link Title</th>
		<td><input id="imageLinkTitle" type="text" size="100" maxlength="500" name="imageLinkTitle" value="<?php echo $lstrImageLinkTitle; ?>"/></td>
		</tr>

		<tr valign="top">
		<th scope="row">Link</th>
		<td><input id="imageLink" type="text" size="100" maxlength="500" name="imageLink" value="<?php echo $lstrImageLink; ?>"/></td>
		</tr>

		<tr valign="top">
		<th scope="row">Content</th>
		<td><input id="imageContent" type="text" size="100" maxlength="500" name="imageContent" value="<?php echo $lstrImageContent; ?>"/></td>
		</tr>

		<tr valign="top">
		<th scope="row">Image</th>
		<td><input id="imageUpload" type="file" name="imageUpload"/></td>
		</tr>

		<tr valign="top">
		<th scope="row">Category</th>
		<td><?php cus_slideshow_display_select_categories('imageCategory'); ?></td>
		</tr>

		<tr valign="top">
			<td>
				<p class="submit">
				<input type="submit" name="cus_slideshow_submit" class="button-primary"
				value="Add Image"/>
				</p>
			</td>
		</tr>

		<tr>
		<th>Existing Images</th>
			<td width="350px">
				<div align="center" style="overflow: auto; width: 300px; height: 300px; border: 1px dotted black;">
				<?php
					cus_slideshow_display_existing($lstrSelected);
				?>
				</div>
			</td>

			<td width="200px">
				<?php cus_slideshow_display_select_categories('imageCategoryLoad', $lstrSelected); ?>
				<p class="submit">
				<input type="submit" name="cus_slideshow_load" class="secondary-primary"
				value="Load Category"/>
				</p>
			</td>
		</tr>

	</table>
</form>
</div>
<?php
}

function cus_slideshow_settings_category()
{
	//enqueue ace editor
	wp_enqueue_script('cus_slideshow_slides_ace', plugins_url('ace/ace.js',__FILE__), array('jquery'));

	$lstrSlideshowCatName = '';
	$lstrCSS = cus_slideshow_load_css();
	$lstrSelected = '';

	if(isset($_POST['imageCatName']))
	{
		$lstrSlideshowCatName = strtolower($_POST['imageCatName']);
	}

	if(isset($_POST['cus_slideshow_delete']))
	{
		if(isset($_POST['delete_cat_names']))
		{
			$lobjNames = $_POST['delete_cat_names'];

			$lboolSuccess = cus_slideshow_cat_deleteRecord($lobjNames);
		}

	}

	if(isset($_POST['cus_slideshow_submit']))
	{
		if(cus_slideshow_cat_validate_inputs($lstrSlideshowCatName))
		{
			$lobjCategory = get_option('cus_slideshow_categories');

			array_push($lobjCategory, $lstrSlideshowCatName);

			$lobjCategory = array_unique($lobjCategory, SORT_STRING);

			$lboolSuccess = update_option('cus_slideshow_categories', $lobjCategory);

			if(!file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow_' . $lstrSlideshowCatName . '.css'))
			{
				$lboolCopy = copy(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow.css',
				dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow_' . $lstrSlideshowCatName . '.css');

				if(!$lboolCopy)
				{
					?>
					<div class="updated settings-error" id="setting-error-settings_updated">
					<p><strong>Error! Did not create css file for category!</strong></p>
					</div>
					<?php
				}
			}

			if($lboolSuccess)
			{
				$lstrSlideshowCatName = '';
				?>
				<div class="updated settings-error" id="setting-error-settings_updated">
				<p><strong>Added Successfully.</strong></p>
				</div>
				<?php
			}else
			{
				?>
				<div class="updated settings-error" id="setting-error-settings_updated">
				<p><strong>Error! Did not add!</strong></p>
				</div>
				<?php
			}
		}
	}

	if(isset($_POST['cus_slideshow_css']))
	{
		$lstrSelected = $_POST['categoryCSSSave'];
		$lboolSuccess = cus_slideshow_save_css($_POST['categoryCSSSave'], $_POST['categoryCSS']);

		if($lboolSuccess)
		{
			$lstrCSS = $_POST['categoryCSS'];
			?>
			<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>CSS Updated Successfully.</strong></p>
			</div>
			<?php
		}else{
			?>
			<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>Error: CSS wasn't updated. Try again.</strong></p>
			</div>
			<?php
		}
	}

	if(isset($_POST['cus_slideshow_load']))
	{
		$lstrSelected = $_POST['categoryLoad'];

		$lstrCSS = cus_slideshow_load_css($lstrSelected);
	}
	?>
	<div class="wrap">
		<h2>Custom Slideshow Category Settings</h2>

		<form method="post" action="#" enctype="multipart/form-data">

			<table class="form-table">

				<tr valign="top">
				<td style="padding-bottom:20px;"><a href="admin.php?page=customslideshow/customslideshow.php_slideshows">Go to Manage Slideshows</a></td>
				</tr>

				<tr valign="top">
				<th scope="row">Name</th>
				<td><input id="imageCatName" type="text" size="50" maxlength="50" name="imageCatName" value="<?php echo $lstrSlideshowCatName; ?>"/></td>
				</tr>

				<tr valign="top">
					<td>
						<p class="submit">
						<input type="submit" name="cus_slideshow_submit" class="button-primary"
						value="Add Category"/>
						</p>
					</td>
				</tr>

				<tr valign="top">
				<th scope="row">Existing Categories</th>
					<td>
						<div align="center" style="overflow: auto; width: 300px; height: 300px; border: 1px dotted black;">
						<?php
						cus_slideshow_display_cat_existing();
						?>
						</div>
					</td>
				</tr>

				<tr valign="top">
					<td>
						<p class="submit">
						<input type="submit" name="cus_slideshow_delete" class="button-primary"
						value="Delete Category"/>
						</p>
					</td>
				</tr>
			</table>
		</form>

		<form id="cssForm" method="post" action="#" enctype="text/css">

			<table class="form-table">
				<tr valign="top">
					<th scope="row">CSS (Styling)</th>

					<td width="200px">
					<div id="categoryCSS" name="categoryCSS" style="height: 500px; width: 500px;"></div>
					<input type="hidden" name="categoryCSS" value=""/>
					</td>

					<td>
					<?php cus_slideshow_display_select_categories('categoryLoad', $lstrSelected); ?>
					<p class="submit">
					<input type="submit" name="cus_slideshow_load" class="secondary-primary"
					value="Load Category"/>
					</p>
					</td>

				</tr>

				<tr>

				<td>
				<span class="submit">
					<input type="submit" name="cus_slideshow_css" class="button-primary"
					value="Save CSS"/>
				</span>
				<span>&nbsp;&nbsp; to <?php cus_slideshow_display_select_categories('categoryCSSSave', $lstrSelected); ?></span>
				</td>

				</tr>

				<tr>
				<th>&nbsp;</th>

				</tr>
			</table>
		</form>
	</div>
	<script>
	jQuery(document).ready(function($)
	{
		var editor = ace.edit("categoryCSS");
		editor.getSession().setMode("ace/mode/css");
		editor.getSession().setValue("<?php echo htmlentities( preg_replace( '/(!newline!)+/s', "\\n", preg_replace( '/(\\n|\\r)+/s', "!newline!", $lstrCSS)), ENT_QUOTES); ?>");
		editor.resize();
		editor.focus();

		$('#cssForm').submit(function()
		{
			$('input[name="categoryCSS"]').val(editor.getSession().getValue());
			return true;
		});
	});
	</script>
	<?php
}

function cus_slideshow_file_upload()
{
	if(isset($_FILES['imageUpload']) && $_FILES['imageUpload']['name'] != '')
	{
		//replace non UTF-8 with '_'
		$_FILES['imageUpload']['name'] = preg_replace('/[^a-zA-Z0-9\\/:\*\?"<>\|\.]/',
			'_', $_FILES['imageUpload']['name'] );

		$lobjAllowableExtensions = array('jpeg', 'jpg', 'gif', 'png');

		$lstrExtension = end(explode('.', $_FILES['imageUpload']['name']));

		if(in_array($lstrExtension, $lobjAllowableExtensions))
		{
			if($_FILES['imageUpload']['error'] > 0)
			{
			?>
			<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>File did not upload due to error.</strong></p>
			</div>
			<?php
			}else{
				if(file_exists(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $_FILES['imageUpload']['name']))
				{
				?>
				<div class="updated settings-error" id="setting-error-settings_updated">
				<p><strong>File already exists.</strong></p>
				</div>
				<?php
				}else{
					if(@move_uploaded_file($_FILES['imageUpload']['tmp_name'], CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $_FILES['imageUpload']['name']))
					{
						$lobjImageInfo = getimagesize(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $_FILES['imageUpload']['name']);

						$lstrSize = $lobjImageInfo[3];

						$lboolGoodSize = cus_slideshow_isCorrectImageSize($lstrSize);

						if($lboolGoodSize)
						{
							return $_FILES['imageUpload']['name'];
						}else{
							unlink(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $_FILES['imageUpload']['name']);
						?>
						<div class="updated settings-error" id="setting-error-settings_updated">
						<p><strong>Image size must be 950 x 260.</strong></p>
						</div>
						<?php
						}
					}else{
					?>
					<div class="updated settings-error" id="setting-error-settings_updated">
					<p><strong>Upload Unsuccessful</strong></p>
					</div>
					<?php
					}
				}
			}
		}else{
			?>
			<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>Extension not supported</strong></p>
			</div>
			<?php
		}
	}else{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Please choose a file.</strong></p>
		</div>
		<?php
	}
}

function cus_slideshow_validate_inputs($lstrCategory, $lstrInput2 = 'placeholder', $lstrInput3 = 'placeholder', $lstrInput4 = 'placeholder')
{
	if( $lstrCategory == '' || $lstrInput2 == '' || $lstrInput3 == '' || $lstrInput4 == '')
	{
	?>
	<div class="updated settings-error" id="setting-error-settings_updated">
	<p><strong>Image not uploaded.</strong></p>
	<p>Category is required (might need to add one).</p>
	</div>
	<?php
		return false;
	}

	if(cus_slideshow_atMax($lstrCategory))
	{
	?>
	<div class="updated settings-error" id="setting-error-settings_updated">
	<p><strong>Maximum reached. Only 5 images allowed.</strong></p>
	</div>
	<?php
		return false;
	}

	return true;
}

function cus_slideshow_cat_validate_inputs($lstrInput1, $lstrInput2 = ' ', $lstrInput3 = ' ')
{
	if( $lstrInput1 == '' || $lstrInput2 == '' || $lstrInput3 == '')
	{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Name must be filled! Category not inserted.</strong></p>
		</div>
		<?php
		return false;
	}

	return true;
}

function cus_slideshow_update_table($lstrImageTitle, $lstrImageLinkTitle, $lstrImageLink, $lstrImageContent, $lstrImageName, $lstrImageCategory)
{
	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";
	$lstrImageTheme = wp_get_theme();

	$lstrQuery = "INSERT IGNORE INTO $lstrTableName
				  ( imageTitle, imageLinkTitle, imageLink, imageName, imageContent, imageCategory )
				  VALUES ( %s, %s, %s, %s, %s, %s )";

	$lboolExecuted = $wpdb->query($wpdb->prepare($lstrQuery,$lstrImageTitle, $lstrImageLinkTitle,
						$lstrImageLink, $lstrImageName, $lstrImageContent, $lstrImageCategory));

	if(!$lboolExecuted)
	{
		unlink(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $lstrImageName);
	?>
	<div class="updated settings-error" id="setting-error-settings_updated">
	<p><strong>Error: Record was not inserted. Please try again.</strong></p>
	</div>
	<?php
		return false;
	}else{
	?>
	<div class="updated settings-error" id="setting-error-settings_updated">
	<p><strong>Updated Successfully.</strong></p>
	</div>
	<?php
		return true;
	}
}

function cus_slideshow_isCorrectImageSize($lstrSize)
{
	//added by dgonzalez because they want to add different sizes. Will edit later inorder
	//to use catergory for size and determine css on that
	return true;

	if($lstrSize == 'width="950" height="260"')
	{
		return true;
	}

	return false;
}

function cus_slideshow_display_existing($lstrCategory = '')
{
	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";
	$lstrImageTheme = wp_get_theme();

	if($lstrCategory == '')
	{
		$lobjCategory = get_option('cus_slideshow_categories');

		$lstrCategory = array_shift($lobjCategory);
	}

	$lstrQuery = "SELECT *
				  FROM {$lstrTableName}
				  WHERE imageCategory = '%s'
				  ORDER BY imageSort DESC, imageID ASC";

	$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lstrCategory), ARRAY_A);

	foreach($lobjResults as $lobjRow)
	{
		?>
		<div class="cus_slideshow_top_container" style="width: 238px;">
			<div class="cus_slideshow-buttons-container" style="float: left;">
				<a class="edit_colorbox" href="#" cus-slideshow-data="<?php echo $lstrCategory; ?>_<?php echo $lobjRow['imageID'] ?>"><img title="Edit" src="<?php echo plugin_dir_url( __FILE__ ); ?>css/images/pencil.png" width="14" height="16" /></a>
				&nbsp;
				<a class="delete_image" href="#" cus-slideshow-data="<?php echo $lstrCategory; ?>_<?php echo $lobjRow['imageID'] ?>"><img title="Delete" src="<?php echo plugin_dir_url( __FILE__ ); ?>css/images/trash.png" width="13" height="16" /></a>
			</div>
			<div class="cus-slideshow-name-container" style="float: right;">
				<span style="white-space: nowrap; font-size: 13px;"><strong><?php echo $lobjRow['imageName']; ?></strong></span>
			</div>
		</div>
		<img title="Sort Priority: <?php echo $lobjRow['imageSort']; ?>" src="<?php echo get_bloginfo("stylesheet_directory"); ?>/images/CSbackground/<?php echo $lobjRow['imageName'] ?>" style="width: 238px; height: 65px; padding-bottom: 10px;"/>
		<br />
		<?php
	}
}

function cus_slideshow_display_cat_existing()
{
	$lobjCategories = get_option('cus_slideshow_categories');

	foreach($lobjCategories as $lstrCategory)
	{
		?>
		<div style="padding-bottom:10px;">
			<label><?php echo $lstrCategory?></label>
			<input type="checkbox" name="delete_cat_names[]" value="<?php echo $lstrCategory; ?>"/>
		</div>
		<?php
	}
}

function cus_slideshow_display_select_categories($lstrName, $lstrSelected = '')
{
	?>
	<select id="<?php echo $lstrName ?>" name="<?php echo $lstrName ?>">
	<?php
	$lobjCategories = get_option('cus_slideshow_categories');

	if(count($lobjCategories) < 1)
	{
		?>
		<option value="">No Category</option>
	<?php
	}else{
		foreach($lobjCategories as $lstrCategory)
		{
			if($lstrCategory == $lstrSelected)
			{
				?>
				<option value="<?php echo $lstrCategory ?>" selected><?php echo $lstrCategory ?></option>
				<?php
			}else{
				?>
				<option value="<?php echo $lstrCategory ?>"><?php echo $lstrCategory ?></option>
				<?php
			}
		}
	}
	?>
	</select>
	<?php
}

function cus_slideshow_atMax($lstrCategory)
{
	if($lstrCategory == '')
	{
		return false;
	}

	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";
	$lstrImageTheme = wp_get_theme();

	$lstrQuery = "SELECT *
				  FROM {$lstrTableName}
				  WHERE imageCategory = '%s'";

	$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lstrCategory), ARRAY_A);

	if(count($lobjResults) >= CUSTOM_SLIDESHOW_MAX_IMAGES)
	{
		return true;
	}

	return false;
}

function cus_slideshow_update_image($lintId, $lstrImageTitle, $lstrImageLinkTitle, $lstrImageLink, $lstrImageContent, $lintSort)
{
	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";

	$lstrQuery = "UPDATE $lstrTableName
				  SET imageTitle = %s, imageLinkTitle = %s, imageLink = %s, imageContent = %s, imageSort = %s
				  WHERE imageID = %s";

	$lboolExecuted = $wpdb->query($wpdb->prepare($lstrQuery,$lstrImageTitle, $lstrImageLinkTitle,
						$lstrImageLink, $lstrImageContent, $lintSort, $lintId));

	if(!$lboolExecuted)
	{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error: Record was not updated. Please try again.</strong></p>
		</div>
		<?php
		return false;
	}else{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Updated Successfully.</strong></p>
		</div>
		<?php
		return true;
	}
}

function cus_slideshow_deleteRecord($lintID)
{
	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";
	$lstrImageTheme = wp_get_theme();

	$lstrQuery = "SELECT *
				  FROM {$lstrTableName}
				  WHERE imageID = %d";

	$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lintID), ARRAY_A);

	if(count($lobjResults) == 1)
	{
		if(!unlink(CUSTOM_SLIDESHOW_UPLOAD_DIRECTORY_PATH . $lobjResults[0]['imageName']))
		{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error: Record was not deleted. Please try again.</strong></p>
		</div>
		<?php
			return false;
		}
	}

	$lstrQuery = "DELETE FROM $lstrTableName WHERE imageID = %s";

	$lboolExecuted = $wpdb->query($wpdb->prepare($lstrQuery,$lintID));

	if(!$lboolExecuted)
	{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error: Record was not deleted. Please try again.</strong></p>
		</div>
		<?php
		return false;
	}

	?>
	<div class="updated settings-error" id="setting-error-settings_updated">
	<p><strong>Record Deleted.</strong></p>
	</div>
	<?php
	return true;
}

function cus_slideshow_cat_deleteRecord($lobjNames)
{
	$lobjOriginalNames = get_option('cus_slideshow_categories');

	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";

	foreach($lobjNames as $lstrCategoryName)
	{
		$lstrQuery = "SELECT *
					  FROM {$lstrTableName}
					  WHERE imageCategory = '%s'";

		$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lstrCategoryName), ARRAY_A);

		if(count($lobjResults) > 0)
		{
			?>
			<div class="updated settings-error" id="setting-error-settings_updated">
			<p><strong>Error: Category was not deleted. Must delete all images in category before deleting category.</strong></p>
			</div>
			<?php
			return false;
		}

		if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow_' . $lstrCategoryName . '.css'))
		{
			$lboolDelete = unlink(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow_' . $lstrCategoryName . '.css');

			if(!$lboolDelete)
			{
				?>
					<div class="updated settings-error" id="setting-error-settings_updated">
					<p><strong>Error! Could not delete css file for category!</strong></p>
					</div>
					<?php
			}
		}
	}

	$lobjDiff = array_diff($lobjOriginalNames, $lobjNames);

	$lboolExecuted = update_option('cus_slideshow_categories', $lobjDiff);

	if(!$lboolExecuted)
	{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Error: Category was not deleted. Please try again.</strong></p>
		</div>
		<?php
		return false;
	}else{
		?>
		<div class="updated settings-error" id="setting-error-settings_updated">
		<p><strong>Categories Deleted.</strong></p>
		</div>
		<?php
		return true;
	}
}

function cus_slideshow_load_css($lstrCategory = '')
{
	if($lstrCategory == '')
	{
		$lobjCategories = get_option('cus_slideshow_categories');

		if(empty($lobjCategories))
		{
			return '';
		}

		$lstrCategory = array_shift(array_values($lobjCategories));
	}

	$lstrPath = dirname(__FILE__) . '/css/' . 'cus_slideshow_' . $lstrCategory . '.css';

	$lobjFile = fopen($lstrPath, "r");

	$lstrCSS = fread($lobjFile, filesize($lstrPath));

	fclose($lobjFile);

	return $lstrCSS;

}

function cus_slideshow_save_css($lstrCategory, $lstrCSS)
{
	$lstrPath = dirname(__FILE__) . '/css/' . 'cus_slideshow_' . $lstrCategory . '.css';

	$lobjFile = fopen($lstrPath, "w");

	$lboolSuccess = fwrite($lobjFile, $lstrCSS);

	if(!$lboolSuccess) return false;

	fclose($lobjFile);

	return true;
}

function custom_slideshow_display($lobjAttributes)
{
	wp_enqueue_script('cus_slideshow_slides', plugins_url('js/slides.min.jquery.js',__FILE__), array('jquery'));
	wp_enqueue_script('cus_slideshow_script', plugins_url('js/cus_slideshow.js',__FILE__), array('jquery','cus_slideshow_slides'));

	return cus_slideshow_getSildeshowDiv($lobjAttributes);
}

function cus_slideshow_getSildeshowDiv($lobjAttributes)
{
	$lobjAttributes = shortcode_atts( array('category' => ''), $lobjAttributes );

	$lstrCategory = $lobjAttributes['category']	;

	if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'cus_slideshow_' . $lstrCategory . '.css'))
	{
		wp_enqueue_style('cus_slideshow_' . $lstrCategory . '.css', plugins_url('css/' . 'cus_slideshow_' . rawurlencode($lstrCategory) . '.css', __FILE__));
	}

	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";
	$lstrImageTheme = wp_get_theme();

	if($lstrCategory == '')
	{
		return '';
	}else{
		$lstrQuery = "SELECT *
				  FROM {$lstrTableName}
				  WHERE imageCategory = '%s'
				  ORDER BY imageSort DESC, imageID ASC";
	}

	$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lstrCategory));

	if(count($lobjResults) < 2)
	{
		return '';
	}

	$lstrDivHTML = "<div id=\"slides\" class=\"slides\">\n<div class=\"slides_container\">\n";

	$lstrPaginationHTML = "<ul class=\"pagination\">\n";

	foreach($lobjResults as $lobjImage)
	{
		$lstrImageDirectory = get_bloginfo("stylesheet_directory") . "/images/CSbackground/" . $lobjImage->imageName;

		$lstrDivHTML .= "<div class=\"slide\">\n";
		$lstrDivHTML .= "<div class=\"cus_slideshow_image\" >\n<img src=\"$lstrImageDirectory\" />\n</div>";
		$lstrDivHTML .= cus_slideshow_getInfoDiv($lobjImage);
		$lstrDivHTML .= "</div>\n";

		$lstrPaginationHTML .= "<li><a href=\"#\"></a></li>\n";
	}

	$lstrPaginationHTML .= "</ul>\n";

	$lstrDivHTML .= "</div>\n" . $lstrPaginationHTML . "</div>\n";

	return $lstrDivHTML;
}

function cus_slideshow_getInfoDiv($lobjImage)
{
	$lstrInfoDiv = "<div class=\"cus_slideshow_overlay\">\n";
	$lstrInfoDiv .= "<div class=\"cus_slideshow_title\">\n". stripslashes($lobjImage->imageTitle) . "\n</div>\n";

	if($lobjImage->imageContent != '')
	{
		$lobjImage->imageContent = stripslashes($lobjImage->imageContent);

		$lstrInfoDiv .= "<div class=\"cus_slideshow_content\">\n{$lobjImage->imageContent}\n</div>\n";
	}

	$lstrInfoDiv .= "<div class=\"cus_slideshow_link_title\">\n<a href=\"{$lobjImage->imageLink}\">{$lobjImage->imageLinkTitle}</a>\n</div>\n";
	$lstrInfoDiv .= "</div>\n";

	return $lstrInfoDiv;
}

function cus_slideshow_ajax_update()
{
	$lintId = isset( $_POST['id'] ) ? intval($_POST['id']) : '';

	global $wpdb;

	$lstrTableName = $wpdb->prefix . "cus_slideshow";

	$lstrQuery = "SELECT *
					  FROM {$lstrTableName}
					  WHERE imageID = %d";

	$lobjResults = $wpdb->get_results($wpdb->prepare($lstrQuery, $lintId), ARRAY_A);

	if(count($lobjResults) == 1)
	{
		echo "<input type=\"hidden\" name=\"category\" value=\"$lstrCat\"/>\n";

		?>
		<div id="edit_image_<?php echo $lintId; ?>">
			<form action="<?php admin_url() . 'admin.php?page=customslideshow/customslideshow.php_slideshows' ?>" method="post">
				<input type="hidden" name="id" value="<?php echo $lintId; ?>"/>
				<table class="form-table">
					<tr valign="top">
					<th scope="row">Title</th>
					<td><input id="imageTitle" type="text" size="100" name="imageTitle" value="<?php echo stripslashes($lobjResults[0]['imageTitle']); ?>"/></td>
					</tr>

					<tr valign="top">
					<th scope="row">Link Title</th>
					<td><input id="imageLinkTitle" type="text" size="100" name="imageLinkTitle" value="<?php echo stripslashes($lobjResults[0]['imageLinkTitle']); ?>"/></td>
					</tr>

					<tr valign="top">
					<th scope="row">Link</th>
					<td><input id="imageLink" type="text" size="100" name="imageLink" value="<?php echo $lobjResults[0]['imageLink']; ?>"/></td>
					</tr>

					<tr valign="top">
					<th scope="row">Content</th>
					<td><input id="imageContent" type="text" size="100" name="imageContent" value="<?php echo stripslashes($lobjResults[0]['imageContent']); ?>"/></td>
					</tr>

					<tr valign="top">
					<th scope="row">Sorting Priority</th>
					<td><input id="imageSort" type="text" size="2" name="imageSort" value="<?php echo $lobjResults[0]['imageSort']; ?>"/></td>
					</tr>

					<tr valign="top">
					<td>
						<p class="submit">
							<input type="submit" class="cus_slideshow_update" name="cus_slideshow_update" class="button-primary"
														value="Update"/>
							</p>
					</td>
					</tr>
				</table>
			</form>
		</div>
		<?php
	}else
	{
		echo "Image ID does not exist.";
	}
	die();
}
?>