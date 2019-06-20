<?php


	namespace CranleighSchool\CranleighFAQs;


	/**
	 * Class CustomTaxonomy
	 *
	 * @package CranleighSchool\CranleighFAQs
	 */
	class CustomTaxonomy
	{
		/**
		 * @var string
		 */
		public $post_type_key;
		/**
		 * @var string
		 */
		public $taxonomy_key;

		/**
		 * CustomTaxonomy constructor.
		 *
		 * @param string $post_type_key
		 * @param string $taxonomy_key
		 */
		public function __construct(string $post_type_key, string $taxonomy_key)
		{
			$this->post_type_key = $post_type_key;
			$this->taxonomy_key = $taxonomy_key;

			add_action('init', array($this, 'faq_group_taxonomy'), 0);
		}

		// Register Custom Taxonomy

		/**
		 *
		 */
		function faq_group_taxonomy()
		{

			$labels = array(
				'name'                       => _x('FAQ Groups', 'Taxonomy General Name', 'cranleigh-2016'),
				'singular_name'              => _x('FAQ Group', 'Taxonomy Singular Name', 'cranleigh-2016'),
				'menu_name'                  => __('FAQ Groups', 'cranleigh-2016'),
				'all_items'                  => __('All Groups', 'cranleigh-2016'),
				'parent_item'                => __('Parent Group', 'cranleigh-2016'),
				'parent_item_colon'          => __('Parent Group:', 'cranleigh-2016'),
				'new_item_name'              => __('New Group Name', 'cranleigh-2016'),
				'add_new_item'               => __('Add New Group', 'cranleigh-2016'),
				'edit_item'                  => __('Edit Group', 'cranleigh-2016'),
				'update_item'                => __('Update Group', 'cranleigh-2016'),
				'view_item'                  => __('View Group', 'cranleigh-2016'),
				'separate_items_with_commas' => __('Separate groups with commas', 'cranleigh-2016'),
				'add_or_remove_items'        => __('Add or remove groups', 'cranleigh-2016'),
				'choose_from_most_used'      => __('Choose from the most used', 'cranleigh-2016'),
				'popular_items'              => __('Popular Groups', 'cranleigh-2016'),
				'search_items'               => __('Search Items', 'cranleigh-2016'),
				'not_found'                  => __('Not Found', 'cranleigh-2016'),
				'no_terms'                   => __('No items', 'cranleigh-2016'),
				'items_list'                 => __('Items list', 'cranleigh-2016'),
				'items_list_navigation'      => __('Items list navigation', 'cranleigh-2016'),
			);
			$args = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => false,
				'show_tagcloud'     => false,
			);
			register_taxonomy($this->taxonomy_key, array($this->post_type_key), $args);

		}
	}
