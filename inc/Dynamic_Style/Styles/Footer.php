<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Footer class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Footer extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'streamit_footer_dynamic_style'), 20);
	}

	public function streamit_footer_dynamic_style()
	{

		$page_id = get_queried_object_id();
		$streamit_options = get_option('streamit_options');
		$footer_css = '';

		if (function_exists('get_field') && get_field('name_footer_display', $page_id) == 'no') {
			$footer_css = 'footer { 
				display : none !important;
			}';
		} else if (function_exists('get_field') && get_field('name_footer_display', $page_id) == 'yes') {
			$footer_css = '.iq-register { 
				position : relative !important;
			}';
	
		} else if (isset($streamit_options['streamit_footer_top'])) {
			if ($streamit_options['streamit_footer_top'] == 'no') {
				$footer_css = '.footer-top { 
					display : none !important;
				}';
			}
		}

		if (function_exists('get_field') && get_field('field_footer_bg_color') && !empty(get_field('field_footer_bg_color'))) {
			$footer_bg_color = get_field('field_footer_bg_color');
			$footer_css .= ".footer {
						background-color: $footer_bg_color !important;
					}";
		} else {
			if (class_exists('ReduxFramework') && isset($streamit_options['change_footer_background'])) {
				if (!empty($streamit_options['footer_color']) && $streamit_options['change_footer_background'] == 'color') {
					$footer_bg_color = $streamit_options['footer_color'];
					$footer_css .= ".footer {
							background-color: $footer_bg_color !important;
						}";
				}
				if (!empty($streamit_options['footer_image']['url']) && $streamit_options['change_footer_background'] == 'image') {
					$footer_bg_image = $streamit_options['footer_image'];
					$footer_css .= ".footer {
							background: url(" . $footer_bg_image['url'] . ") no-repeat !important;
							backgrouns-size: cover !important ;
						}";
				}
			}
		}

		if (!empty($footer_css)) {
			wp_add_inline_style('streamit-style', $footer_css);
		}
	}
}
