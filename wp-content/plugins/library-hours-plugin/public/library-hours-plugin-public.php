<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Library_Hours_Plugin
 * @subpackage Library_Hours_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Library_Hours_Plugin
 * @subpackage Library_Hours_Plugin/public
 * @author     Charles Brown-Roberts <charlesbrownroberts@miami.edu>
 */
class Library_Hours_Plugin_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;


	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/library-hours-plugin-public.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'fullcalendar', plugin_dir_url( __FILE__ ) . 'assets/bower_components/fullcalendar/dist/fullcalendar.css', array(), $this->version, 'all' );
        wp_enqueue_style( 'jquery-ui-lightness', plugin_dir_url( __FILE__ ) . 'assets/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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


        wp_enqueue_script( 'moment', plugin_dir_url( __FILE__ ) . 'assets/bower_components/moment/moment.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'fullcalendar', plugin_dir_url( __FILE__ ) . 'assets/bower_components/fullcalendar/dist/fullcalendar.min.js' , array( 'jquery' ), $this->version, false );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/library-hours-plugin-public.js', array( 'jquery' ), $this->version, false );


        // - set path to json feed -
        $jsonevents = plugin_dir_url( __FILE__ ) . 'includes/calendarfeed.php';


        // - tell JS to use this variable instead of a static value -
        wp_localize_script( 'fullcalendar', 'umiami', array(
            'events' => $jsonevents,
        ));


	}

	public function load_custom_post_type_template($template) {
		global $post;

		if ( $post->post_type == 'libhours_post_type'  ) {

			$new_template = dirname(__FILE__). '/partials/library-hours-plugin-public-display.php';

			if(file_exists($new_template)) {
				locate_template($new_template, true);
				return  $new_template ;
			}

			return $template;
		}

	}


}
