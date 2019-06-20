<?php

	namespace CranleighSchool\CranleighFAQs;

	use WP_Query;

	/**
	 * Class Shortcode
	 *
	 * @package CranleighSchool\CranleighFAQs
	 */
	class Shortcode
	{
		/**
		 * @var string
		 */
		public $tag = 'cranleigh_faqs';

		/**
		 * @var string
		 */
		public $collapsibles = "collapsibles";

		/**
		 * @var string
		 */
		public $collapse = "collapse";

		/**
		 * Shortcode constructor.
		 *
		 * @param array|NULL $config
		 */
		public function __construct(array $config = NULL)
		{
			add_shortcode($this->tag, array($this, 'render'));

		}

		/**
		 * @param      $atts
		 * @param null $content
		 *
		 * Here's the output we're hoping for...
		 *
		 * [accordions autoclose="true" openfirst="false" openall="true"]
		 * [accordion title="Charges" autoclose="true" openfirst="false" openall="false"]
		 *   Answer Text Paragraph
		 * [/accordion]
		 *
		 * @return string
		 */
		public function render($atts, $content = NULL)
		{
			var_dump($this->tag);
			$a = shortcode_atts([
				'group' => NULL,
			], $atts, 'cranleigh_faqs');

			$args = [
				"posts_per_page" => -1,
				"post_type"      => "faqs",
				'orderby'        => 'menu_order title',
				'order'          => 'ASC',
			];
			if ($a['group'] !== NULL) {
				$args["tax_query"] = [[
					"taxonomy" => "faq_groups",
					"field"    => "slug",
					"terms"    => $a['group']
				]];
			}

			$query = new WP_Query($args);
			$questions = '';
			while ($query->have_posts()): $query->the_post();
				$questions .= '[' . $this->collapse . ' active="0" openfirst="false" type="cranleigh" title="' . get_the_title() . '"]' . wpautop(get_the_content()) . '[/' . $this->collapse . ']';
			endwhile;
			wp_reset_postdata();

			$start = '[' . $this->collapsibles . ' active="999" collapsible="true"]';
			$finish = '[/' . $this->collapsibles . ']';

			return do_shortcode($start . $questions . $finish);
		}
	}
