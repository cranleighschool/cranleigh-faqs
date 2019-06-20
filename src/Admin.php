<?php


	namespace CranleighSchool\CranleighFAQs;


	class Admin
	{
		public function __construct()
		{
			add_action("admin_head", array($this, 'custom_icon'));
			add_action('admin_enqueue_scripts', array($this, 'admin_style'));
		}

		public function admin_style()
		{
			wp_enqueue_style('cranfont', '//cdn.cranleigh.org/cranfont/style.css');
		}

		public function custom_icon()
		{
			echo '<style type="text/css" media="screen">
				#adminmenu .menu-icon-faqs div.wp-menu-image:before {
					font-family: cranfont !important;
					content: "\e91b" !important;
				}
				</style>';
		}
	}
