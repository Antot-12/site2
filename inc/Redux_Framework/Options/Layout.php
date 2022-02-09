<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Layout class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Layout extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Layout', 'streamit'),
			'id' => 'editer-page',
			'icon' => 'el-icon-align-justify',
			'fields' => array(

				array(
					'id'        => 'streamit_layout_mode_options',
					'type'      => 'select',
					'title'     => __('Select Layout Mode', 'streamit'),
					'subtitle'      => __('Select a Mode to quickly apply pre-defined', 'streamit'),
					'customizer_only'   => false,
					'options'   => array(
						'1' => esc_html__('LTR', 'streamit'),
						'2' => esc_html__('RTL', 'streamit')
					),
					'default'   => '1'
				),
				array(
					'id'        => 'streamit_enable_sswitcher',
					'type'      => 'switch',
					'title'     => __('Show Style Switcher', 'streamit'),
					'subtitle'     => __('The style switcher is only for preview on front-end', 'streamit'),
					'default'   => false,
				),
			)
		));
	}
}
