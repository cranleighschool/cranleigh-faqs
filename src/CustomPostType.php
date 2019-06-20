<?php


	namespace CranleighSchool\CranleighFAQs;

	/**
	 * Class CustomPostType
	 *
	 * @package CranleighSchool\CranleighFAQs
	 */
class CustomPostType {

	/**
	 * @var
	 */
	public $post_type_key;

	/**
	 * CustomPostType constructor.
	 *
	 * @param $post_type_key
	 */
	public function __construct( $post_type_key ) {
		 $this->post_type_key = $post_type_key;
		add_action( 'init', array( $this, 'custom_post_type' ), 0 );
	}

	// Register Custom Post Type

	/**
	 *
	 */
	public function custom_post_type() {
		$labels = array(
			'name'                  => _x( 'FAQs', 'Post Type General Name', 'cranleigh-2016' ),
			'singular_name'         => _x( 'FAQ', 'Post Type Singular Name', 'cranleigh-2016' ),
			'menu_name'             => __( 'FAQs', 'cranleigh-2016' ),
			'name_admin_bar'        => __( 'FAQs', 'cranleigh-2016' ),
			'archives'              => __( 'FAQ Archives', 'cranleigh-2016' ),
			'parent_item_colon'     => __( 'Parent Item:', 'cranleigh-2016' ),
			'all_items'             => __( 'All FAQs', 'cranleigh-2016' ),
			'add_new_item'          => __( 'Add New FAQ', 'cranleigh-2016' ),
			'add_new'               => __( 'Add New', 'cranleigh-2016' ),
			'new_item'              => __( 'New FAQ', 'cranleigh-2016' ),
			'edit_item'             => __( 'Edit FAQ', 'cranleigh-2016' ),
			'update_item'           => __( 'Update FAQ', 'cranleigh-2016' ),
			'view_item'             => __( 'View FAQ', 'cranleigh-2016' ),
			'search_items'          => __( 'Search FAQ', 'cranleigh-2016' ),
			'not_found'             => __( 'Not found', 'cranleigh-2016' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'cranleigh-2016' ),
			'featured_image'        => __( 'Featured Image', 'cranleigh-2016' ),
			'set_featured_image'    => __( 'Set featured image', 'cranleigh-2016' ),
			'remove_featured_image' => __( 'Remove featured image', 'cranleigh-2016' ),
			'use_featured_image'    => __( 'Use as featured image', 'cranleigh-2016' ),
			'insert_into_item'      => __( 'Insert into item', 'cranleigh-2016' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'cranleigh-2016' ),
			'items_list'            => __( 'Items list', 'cranleigh-2016' ),
			'items_list_navigation' => __( 'Items list navigation', 'cranleigh-2016' ),
			'filter_items_list'     => __( 'Filter items list', 'cranleigh-2016' ),
		);
		$args   = array(
			'label'               => __( 'FAQ', 'cranleigh-2016' ),
			'description'         => __( 'Cranleigh FAQs', 'cranleigh-2016' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'page-attributes' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 27,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'menu_icon'           => 'dashicons-smiley',
			'capability_type'     => 'manage_options',
		);
		register_post_type( $this->post_type_key, $args );

	}
}
