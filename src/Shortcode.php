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

		private $panel_style = 'panel-cranleigh';


		/**
		 * Shortcode constructor.
		 *
		 * @param array|NULL $config
		 */
		public function __construct(array $config = NULL)
		{
			$this->getPanelStyle();
			add_shortcode($this->tag, array($this, 'render'));

		}

		private function getPanelStyle()
		{
			if (strpos($_SERVER['HTTP_HOST'], "cranprep.org")) {
				$this->panel_style = 'panel-cranprep';
			}
		}

		/**
		 * @param      $atts
		 * @param null $content
		 *
		 * @return string
		 */
		public function render($atts, $content = NULL): string
		{
			$a = shortcode_atts(
				[
					'group' => NULL,
				],
				$atts,
				'cranleigh_faqs'
			);

			$args = [
				'posts_per_page' => -1,
				'post_type'      => 'faqs',
				'orderby'        => 'menu_order title',
				'order'          => 'ASC',
			];
			if ($a['group'] !== NULL) {
				$args['tax_query'] = [
					[
						'taxonomy' => 'faq_groups',
						'field'    => 'slug',
						'terms'    => $a['group'],
					],
				];
			}
			$collapse_parent_name = 'collapse-faq-' . $a['group'];
			$query = new WP_Query($args);
			$questions = '';
			while ($query->have_posts()) :
				$query->the_post();
				$questions .= $this->getPanel(get_the_title(), wpautop(get_the_content()), $collapse_parent_name, get_the_ID());
			endwhile;
			wp_reset_postdata();

			return sprintf('<div class="panel-group" id="%s">%s</div>', $collapse_parent_name, $questions);

		}

		private function getPanel(string $title, string $content, string $parent_id, int $x): string
		{
			$answer_id = $parent_id . '-' . $x;

			ob_start(); ?>
			<div class="panel <?php echo $this->panel_style; ?>">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#<?php echo $parent_id; ?>"
						   href="#<?php echo $answer_id; ?>" style="user-select: none;"><?php echo $title; ?></a>
					</h4>
				</div>
				<div id="<?php echo $answer_id; ?>" class="panel-collapse collapse">
					<div class="panel-body"><?php echo $content; ?></div>
				</div>
			</div>
			<?php $contents = ob_get_contents();
			ob_end_clean();

			return $contents;
		}
	}
