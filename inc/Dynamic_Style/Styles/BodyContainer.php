<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\BodyContainer class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class BodyContainer extends Component
{

	public function __construct()
	{
		if (class_exists('ReduxFramework')) {
			add_action('wp_enqueue_scripts', array($this, 'streamit_container_width'), 21);
		}
	}

	public function streamit_container_width()
	{
		$streamit_options = get_option('streamit_options');

		if (isset($streamit_options['opt-slider-label']) && !empty($streamit_options['opt-slider-label'])) {
			$container_width = $streamit_options['opt-slider-label'];
			$box_container_width = "body.iq-container-width .container,
        							body.iq-container-width .elementor-section.elementor-section-boxed>
        							.elementor-container { max-width: " . $container_width . "px; } ";
			wp_add_inline_style('streamit-style', $box_container_width);
		}
	}
}
