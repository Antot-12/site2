<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Banner class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Color extends Component
{

	public function __construct()
	{
		add_action('wp_enqueue_scripts', array($this, 'streamit_color_options'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_banner_title_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_layout_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_loader_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_bg_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_opacity_color'), 20);
		add_action('wp_enqueue_scripts', array($this, 'streamit_header_radio'), 20);
	}

	public function streamit_color_options()
	{

		$streamit_options = get_option('streamit_options');
		$color_var = "";
		if (class_exists('ReduxFramework')) {
			
			if (isset($streamit_options['primary_color']) && !empty($streamit_options['primary_color'])) {
				$color = $streamit_options['primary_color'];
				$color_var .= '--color-theme-primary: ' . $color . ' !important;';
			}

			if (isset($streamit_options['secondary_color']) && !empty($streamit_options['secondary_color'])) {
				$color = $streamit_options['secondary_color'];
				$color_var .= '--color-theme-secondary: ' . $color . ' !important;';
			}


			if (isset($streamit_options['text_color']) && !empty($streamit_options['text_color'])) {
				$color = $streamit_options['text_color'];
				$color_var .= '--global-font-color: ' . $color . ' !important;';
			}


			if (isset($streamit_options['title_color']) && !empty($streamit_options['title_color'])) {
				$color = $streamit_options['title_color'];
				$color_var .= ' --global-font-title: ' . $color . ' !important;';
			}
			if (!empty($color_var)) {
				$color_attrs = ':root { ' . $color_var . '}';
				wp_add_inline_style('streamit-style', $color_attrs);
			}
		}
	}

	public function streamit_banner_title_color()
	{
		//Set Body Color
		$streamit_options = get_option('streamit_options');
		$bn_title_color = "";


		if (!empty($streamit_options['bg_title_color'])) {
			$bn_title_color = $streamit_options['bg_title_color'];
		}

		if (!empty($bn_title_color)) {
			$title_color = "
					.streamit-breadcrumb-one .title{
						color: $bn_title_color !important;
					}";
			wp_add_inline_style('streamit-style', $title_color);
		}
	}

	public function streamit_layout_color()
	{
		//Set Body Color
		$streamit_options = get_option('streamit_options');
		$body_accent_color = "";

		if (!empty($streamit_options['streamit_layout_color'])) {
			$streamit_layout_color = $streamit_options['streamit_layout_color'];
		}

		if (function_exists('get_field')) {
			$page_id_body_col = get_queried_object_id();
			$key_body_bg_col = get_field('key_body', $page_id_body_col);
			if (isset($key_body_bg_col['body_variation']) && $key_body_bg_col['body_variation'] == 'has_body_color') {
				if (isset($key_body_bg_col['acf_body_color']) && !empty($key_body_bg_col['acf_body_color'])) {
					$body_back_color = $key_body_bg_col['acf_body_color'];
				}
			}
		}

		if (isset($body_back_color) && !empty($body_back_color)) {
			$body_accent_color .= "body {
									background-color: $body_back_color !important;
								}";
		} else if (!empty($streamit_options['layout_set']) && $streamit_options['layout_set'] == "1" && $key_body_bg_col['body_variation'] != 'default') {
			if (!empty($streamit_layout_color) && $streamit_layout_color != '#ffffff') {
				$body_accent_color .= "
            body {
                background-color: $streamit_layout_color !important;
            }";
			}
		} else {
			$body_accent_color = "";
		}
		if (!empty($body_accent_color)) {
			wp_add_inline_style('streamit-style', $body_accent_color);
		}
	}

	public function streamit_loader_color()
	{
		//Set Loader Background Color
		$streamit_options = get_option('streamit_options');

		if (!empty($streamit_options['loader_color'])) {
			$loader_color = $streamit_options['loader_color'];
		}

		if (!empty($loader_color) && $loader_color != '#ffffff') {
			$ld_color = "#loading {
							background : $loader_color !important;
						}";
			wp_add_inline_style('streamit-style', $ld_color);
		}
	}

	public function streamit_bg_color()
	{
		//Set Background Color
		$streamit_options = get_option('streamit_options');

		if (!empty($streamit_options['bg_color'])) {
			$bg_color = $streamit_options['bg_color'];
		}

		if (!empty($streamit_options['bg_type']) && $streamit_options['bg_type'] == "1") {
			if (!empty($bg_color)) {
				$background_color = "
					.streamit-bg-over {
						background : $bg_color !important;
					}";
				wp_add_inline_style('streamit-style', $background_color);
			}
		}
	}

	public function streamit_opacity_color()
	{
		//Set Background Opacity Color
		$streamit_options = get_option('streamit_options');

		if (!empty($streamit_options['bg_opacity']) && $streamit_options['bg_opacity'] == "3") {
			$bg_opacity = $streamit_options['opacity_color']['rgba'];
		}

		if (!empty($streamit_options['bg_opacity']) && $streamit_options['bg_opacity'] == "3") {
			if (!empty($bg_opacity) && $bg_opacity != '#ffffff') {
				$op_color = "
				.breadcrumb-video::before,.breadcrumb-bg::before, .breadcrumb-ui::before {
					background : $bg_opacity !important;
				}";
				wp_add_inline_style('streamit-style', $op_color);
			}
		}
	}

	public function streamit_header_radio()
	{
		//Set Text Logo Color
		$streamit_options = get_option('streamit_options');

		if (!empty($streamit_options['header_color'])) {
			$logo = $streamit_options['header_color'];
		}

		if (!empty($streamit_options['header_radio']) && $streamit_options['header_radio'] == "1") {
			if (!empty($logo) && $logo != '#ffffff') {
				$logo_color = "
					.logo-text {
						color : $logo !important;
					}";
				wp_add_inline_style('streamit-style', $logo_color);
			}
		}
	}
}
