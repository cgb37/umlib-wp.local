<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Library_Hours_Plugin
 * @subpackage Library_Hours_Plugin/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Library_Hours_Plugin
 * @subpackage Library_Hours_Plugin/admin
 * @author     Charles Brown-Roberts <charlesbrownroberts@miami.edu>
 */
class Library_Hours_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->create_custom_library_hours_post_type();
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Library_Hours_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Library_Hours_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/library-hours-plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Library_Hours_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Library_Hours_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/library-hours-plugin-admin.js', array( 'jquery' ), $this->version, false );

	}


	public function create_custom_library_hours_post_type() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-library-hours-post-type.php';
		$Library_Hours_Post_Type = new Library_Hours_Post_Type();

	}


	// register Foo_Widget widget
	function register_library_hours_plugin_holidays_widget() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/widgets/class-holidays.widget.php';

		register_widget( 'Library_Hours_Plugin_Holidays_Widget' );
	}
}
