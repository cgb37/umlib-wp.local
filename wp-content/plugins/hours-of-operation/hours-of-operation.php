<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/4/15
 * Time: 1:11 PM
 */

/*
Plugin Name: Hours of Operation Plugin
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: cbrownroberts
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/


if(!class_exists('Hours_of_Operation_Plugin')){
	class Hours_of_Operation_Plugin {
		/**
		 * Construct the plugin object
		 */
		public function __construct() {
			// register actions
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			add_action( 'admin_menu', array( &$this, 'add_menu' ) );
			add_filter( 'single_template', array($this, 'get_custom_post_type_template') );


			require_once(sprintf("%s/post-types/hours-post-type.php", dirname(__FILE__)));
			$Hours_Post_Type = new Hours_Post_Type();

		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate() {
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate() {
			// Do nothing
		} // END public static function deactivate


		public function get_custom_post_type_template($single_template) {
			global $post;

			if ($post->post_type == 'hours_post_type') {

				$single_template = dirname( __FILE__ ) . '/templates/single.php';

			}
			return $single_template;
		}







	} // END class WP_Plugin_Template

}



if(class_exists('Hours_of_Operation_Plugin')) {
	// Installation and uninstallation hooks
	register_activation_hook( __FILE__, array( 'Hours_of_Operation_Plugin', 'activate' ) );
	register_deactivation_hook( __FILE__, array( 'Hours_of_Operation_Plugin', 'deactivate' ) );

	// instantiate the plugin class
	$hours_of_operation_plugin = new Hours_of_Operation_Plugin();


}