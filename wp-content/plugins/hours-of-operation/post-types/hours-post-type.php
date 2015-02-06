<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/4/15
 * Time: 1:13 PM
 */



if(!class_exists('Hours_Post_Type'))
{
	/**
	 * A PostTypeTemplate class that provides 3 additional meta fields
	 */
	class Hours_Post_Type
	{
		const POST_TYPE	= "hours_post_type";


		/**
		 * The Constructor
		 */
		public function __construct()
		{
			// register actions
			add_action('init', array(&$this, 'init'));
			add_action('admin_init', array(&$this, 'admin_init'));
		} // END public function __construct()
		/**
		 * hook into WP's init action hook
		 */
		public function init()
		{
			// Initialize Post Type
			$this->create_post_type();
			add_action('save_post', array(&$this, 'save_post'));


		} // END public function init()
		/**
		 * Create the post type
		 */
		public function create_post_type()
		{
			$labels = array(
				'name'                => _x( 'Hours', 'Post Type General Name', 'text_domain' ),
				'singular_name'       => _x( 'Hour', 'Post Type Singular Name', 'text_domain' ),
				'menu_name'           => __( 'Library Hours', 'text_domain' ),
				'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
				'all_items'           => __( 'All Items', 'text_domain' ),
				'view_item'           => __( 'View Item', 'text_domain' ),
				'add_new_item'        => __( 'Add New Item', 'text_domain' ),
				'add_new'             => __( 'Add New', 'text_domain' ),
				'edit_item'           => __( 'Edit Item', 'text_domain' ),
				'update_item'         => __( 'Update Item', 'text_domain' ),
				'search_items'        => __( 'Search Item', 'text_domain' ),
				'not_found'           => __( 'Not found', 'text_domain' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
			);
			$args = array(
				'label'               => __( 'hours_post_type', 'text_domain' ),
				'description'         => __( 'Hours of Operation', 'text_domain' ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'custom-fields', ),
				'taxonomies'          => array(),
				'hierarchical'        => true,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 20,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);
			register_post_type( 'hours_post_type', $args );
		}



		/**
		 * Save the metaboxes for this custom post type
		 */
		public function save_post($post_id)
		{
			// verify if this is an auto save routine.
			// If it is our form has not been submitted, so we dont want to do anything
			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			{
				return;
			}

			if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
			{
				foreach($this->_meta as $field_name)
				{
					// Update the post's meta field
					update_post_meta($post_id, $field_name, $_POST[$field_name]);
				}
			}
			else
			{
				return;
			} // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
		} // END public function save_post($post_id)
		/**
		 * hook into WP's admin_init action hook
		 */
		public function admin_init()
		{
			// Add metaboxes
			add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
			add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style' );

		} // END public function admin_init()


		public function load_custom_wp_admin_style() {
			wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/js/bower_components/jquery-timepicker-jt/jquery.timepicker.css' );
			wp_enqueue_style( 'custom_wp_admin_css' );
		}

		/**
		 * hook into WP's add_meta_boxes action hook
		 */
		public function add_meta_boxes()
		{
			// Add this metabox to every selected post
			add_meta_box(
				sprintf('hours_of_operation_plugin_%s_section', self::POST_TYPE),
				sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
				array(&$this, 'add_inner_meta_boxes'),
				self::POST_TYPE
			);
		} // END public function add_meta_boxes()
		/**
		 * called off of the add meta box
		 */
		public function add_inner_meta_boxes($post)
		{
			// Render the job order metabox
			include(sprintf("%s/../templates/%s_metabox.php", dirname(__FILE__), self::POST_TYPE));
		} // END public function add_inner_meta_boxes($post)
	} // END class Post_Type_Template
} // END if(!class_exists('Post_Type_Template'))