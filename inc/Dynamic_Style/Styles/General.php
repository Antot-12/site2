<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\General class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class General extends Component
{
	public function __construct()
	{

		add_action('wp_enqueue_scripts', array($this, 'streamit_create_general_style'), 20);
	}

	public function streamit_create_general_style()
	{

		$streamit_options = get_option('streamit_options');
		$general_var = '';

		if (isset($streamit_options['opt-container-width']) && !empty($streamit_options['opt-container-width'])) {
			$general = $streamit_options['opt-container-width'] . 'px';
			$general_var .= ':root {  --content-width: ' . $general . ' !important; }';
		}
		if (isset($streamit_options['layout_set']) && $streamit_options['layout_set'] == 1) {
			if (isset($streamit_options['streamit_layout_color'])  && !empty($streamit_options['streamit_layout_color'])) {
				$general = $streamit_options['streamit_layout_color'];
				$general_var .= 'body { background : ' . $general . ' !important; }';
			}
		}
		if (isset($streamit_options['layout_set']) && $streamit_options['layout_set'] == 3) {
			if (isset($streamit_options['streamit_layout_image']['url']) && !empty($streamit_options['streamit_layout_image']['url'])) {
				$general = $streamit_options['streamit_layout_image']['url'];
				$general_var .= 'body { background-image: url(' . $general . ') !important; }';
			}
		}

		if (isset($streamit_options['streamit_back_to_top']) && !empty($streamit_options['streamit_back_to_top']) && $streamit_options['streamit_back_to_top'] == 'no') {
				$general_var .= '#back-to-top { display: none !important; }';
		}

		if (!empty($general_var)) {
			wp_add_inline_style('streamit-style', $general_var);
		}
	}
}
