<?php
/**
 * Created by PhpStorm.
 * User: cbrownroberts
 * Date: 2/6/15
 * Time: 2:56 PM
 */

class Library_Hours_Post_Type
{

	const POST_TYPE = "library_hours_post_type";


	public function __construct() {

		//register actions
		add_action('init', array(&$this, 'init'));

	}


	public function init() {

		//Initialize Custom Post Type
		$this->create_post_type();

	}




	// Register Custom Post Type
	public function create_post_type() {

		$labels = array(
			'name'                => _x( 'Library Schedules', 'Post Type General Name', 'text_domain' ),
			'singular_name'       => _x( 'Library Schedule', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'           => __( 'Library Hours', 'text_domain' ),
			'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
			'all_items'           => __( 'All Schedules', 'text_domain' ),
			'view_item'           => __( 'View Item', 'text_domain' ),
			'add_new_item'        => __( 'Add New Branch Schedule', 'text_domain' ),
			'add_new'             => __( 'Add New', 'text_domain' ),
			'edit_item'           => __( 'Edit Item', 'text_domain' ),
			'update_item'         => __( 'Update Item', 'text_domain' ),
			'search_items'        => __( 'Search Item', 'text_domain' ),
			'not_found'           => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'               => __( 'libhours_post_type', 'text_domain' ),
			'description'         => __( 'Library Hours for Multiple Branches', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'custom-fields', ),
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
		register_post_type( 'libhours_post_type', $args );

	}


}