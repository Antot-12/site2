<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Header class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;


class Header extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'streamit_header_dynamic_style'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_header_background_style'), 20);
	}

	public function streamit_header_dynamic_style()
	{
		$page_id = get_queried_object_id();
		$header_css = '';
		if (function_exists('get_field') && get_field('name_header_display', $page_id) == 'no') {
			$header_css = 'header { 
					display : none !important;
				}';
		} else if (function_exists('get_field') && get_field('name_header_display', $page_id) == 'yes') {
			$header_css = '.iq-register .elementor-shortcode { 
					padding-top : 75px !important;
				}';
		}
		if (!empty($header_css)) {
			wp_add_inline_style('streamit-style', $header_css);
		}
	}

	public function streamit_header_background_style()
	{
		$streamit_options = get_option('streamit_options');
		$dynamic_css = '';

		if (isset($streamit_options['streamit_header_background_type']) && $streamit_options['streamit_header_background_type'] != 'default') {
			$type = $streamit_options['streamit_header_background_type'];
			if ($type == 'color') {
				if (!empty($streamit_options['streamit_header_background_color'])) {
					$dynamic_css = 'header#default-header{
							background : ' . $streamit_options['streamit_header_background_color'] . '!important;
						}';
				}
			}
			if ($type == 'image') {
				if (!empty($streamit_options['streamit_header_background_image']['url'])) {
					$dynamic_css = 'header#default-header{
							background : url(' . $streamit_options['streamit_header_background_image']['url'] . ') !important;
						}';
				}
			}
			if ($type == 'transparent') {
				$dynamic_css = 'header#default-header{
						background : transparent !important;
					}';
			}
		}
		if (!empty($dynamic_css)) {
			wp_add_inline_style('streamit-style', $dynamic_css);
		}
	}
}
