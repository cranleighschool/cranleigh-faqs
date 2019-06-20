<?php

	namespace CranleighSchool\CranleighFAQs;

	/**
	 * Class Setup
	 *
	 * @package CranleighSchool\CranleighFAQs
	 */
class Setup {

	/**
	 * @var string
	 */
	private $post_type_key = 'faqs';
	/**
	 * @var string
	 */
	private $taxonomy_key = 'faq_groups';

	/**
	 * Setup constructor.
	 */
	function __construct() {
		new CustomPostType( $this->post_type_key );
		new CustomTaxonomy( $this->post_type_key, $this->taxonomy_key );

		new Shortcode();

		if ( is_admin() ) {
			new Admin();
		}
	}


}
