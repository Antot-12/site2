<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Color class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Color extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Color Attribute', 'streamit'),
			'id'    => 'color-section',
			'icon'  => 'el el-brush',
			'desc'  => esc_html__('Change the default colors of your site.', 'streamit'),
			'fields' => array(

				array(
					'id'            => 'primary_color',
					'type'          => 'color',
					'title'         => esc_html__('Set Primary Color', 'streamit'),
					'subtitle'      => esc_html__('Select primary accent color.', 'streamit'),
					'mode'          => 'background',
					'transparent'   => false,
				),

				array(
					'id'            => 'primary_color_hover',
					'type'          => 'color',
					'title'         => esc_html__('Set Primary Hover Color', 'streamit'),
					'subtitle'      => esc_html__('Select default Primary Hover color', 'streamit'),
					'mode'          => 'background',
					'transparent'   => false
				),

				array(
					'id'            => 'secondary_color',
					'type'          => 'color',
					'title'         => esc_html__('Set Secondary Color', 'streamit'),
					'subtitle'      => esc_html__('Select secondary complementing color.', 'streamit'),
					'mode'          => 'background',
					'transparent'   => false,
				),

				array(
					'id'            => 'title_color',
					'type'          => 'color',
					'title'         => esc_html__('Title Color', 'streamit'),
					'subtitle'      => esc_html__('Select default Title(Headings) color', 'streamit'),
					'mode'          => 'background',
					'transparent'   => false,
				),


				array(
					'id'            => 'text_color',
					'type'          => 'color',
					'title'         => esc_html__('Body Text Color', 'streamit'),
					'subtitle'      => esc_html__('Select default body text color', 'streamit'),
					'mode'          => 'background',
					'transparent'   => false,
				),
				array(
					'id'       => 'opt_color_gradient',
					'type'     => 'color_gradient',
					'title'    => __('Body Gradient Color Option', 'streamit'),
					'subtitle' => __('Select default body Gradient color', 'streamit'),
					'validate' => 'color_rgba',
					'default'  => array(
						'from' => '#0B0102',
						'to'   => '#FF3741',
					),
				),
			)
		));
	}
}
