<?php

/**
 * Streamit\Utility\Jetpack\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class AdditionalCode extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => __('Additional Code', 'streamit'),
			'id'    => 'additional-Code',
			'icon'  => 'el el-css',
			'desc'  => esc_html__('This section contains options for header.', 'streamit'),
			'fields' => array(

				array(
					'id'       => 'streamit_css_code',
					'type'     => 'ace_editor',
					'title'    => esc_html__('CSS Code', 'streamit'),
					'subtitle' => esc_html__('Paste your css code here.', 'streamit'),
					'mode'     => 'css',
					'desc'     => esc_html__('Paste your custom CSS code here.', 'streamit'),
				),

				array(
					'id'       => 'streamit_js_code',
					'type'     => 'ace_editor',
					'title'    => esc_html__('JS Code', 'streamit'),
					'subtitle' => esc_html__('Paste your js code in footer.', 'streamit'),
					'mode'     => 'javascript',
					'theme'   => 'chrome',
					'desc'     => esc_html__('Paste your custom JS code here.', 'streamit'),
					'default' => "jQuery(document).ready(function($){\n\n});"
				),
			)
		));
	}
}
