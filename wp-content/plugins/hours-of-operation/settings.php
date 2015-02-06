<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/4/15
 * Time: 1:44 PM
 */

if(!class_exists('Hours_of_Operation_Plugin_Settings'))
{
	class Hours_of_Operation_Plugin_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));


		} // END public function __construct



		/**
		 * hook into WP's admin_init action hook
		 */
		public function admin_init()
		{
			//  admin_init tasks

		}




		public function settings_section_hours_of_operation_plugin()
		{
			// Think of this as help text for the section.
			echo 'These settings do things for the WP Plugin Template.';
		}

		/**
		 * This function provides text inputs for settings fields
		 */
		public function settings_field_input_text($args)
		{
			// Get the field name from the $args array
			$field = $args['field'];
			// Get the value of this setting
			$value = get_option($field);
			// echo a proper input type="text"
			echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
		} // END public function settings_field_input_text($args)

		/**
		 * add a menu
		 */
		public function add_menu()
		{
			// Add a page to manage this plugin's settings
			add_options_page(
				'Hours of Operation Settings',
				'Hours of Operation',
				'manage_options',
				'hours_of_operation_plugin',
				array(&$this, 'plugin_settings_page')
			);
		} // END public function add_menu()

		/**
		 * Menu Callback
		 */
		public function plugin_settings_page()
		{
			if(!current_user_can('manage_options'))
			{
				wp_die(__('You do not have sufficient permissions to access this page.'));
			}

			// Render the settings template
			include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
		} // END public function plugin_settings_page()
	} // END class hours_of_operation_plugin_Settings
} // END if(!class_exists('hours_of_operation_plugin_Settings'))