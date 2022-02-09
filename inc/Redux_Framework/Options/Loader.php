<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Loader class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Loader extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Loader', 'streamit'),
			'id' => 'header-loader',
			'icon' => 'el el-refresh',
			'fields' => array(

				array(
					'id' => 'streamit_display_loader',
					'type' => 'button_set',
					'title' => esc_html__('streamit Loader', 'streamit'),
					'subtitle' => wp_kses('Turn on to show the icon/images loading animation while your site loads', 'streamit'),
					'options' => array(
						'yes' => esc_html__('Yes', 'streamit'),
						'no' => esc_html__('No', 'streamit')
					),
					'default' => esc_html__('yes', 'streamit')
				),

				array(
					'id' => 'loader_color',
					'type' => 'color',
					'title' => esc_html__('Loader Background Color', 'streamit'),
					'required' => array('streamit_display_loader', '=', 'yes'),
					'subtitle' => esc_html__('Choose Loader Background Color', 'streamit'),
					'transparent' => false,
					'default' => '#141414'
				),

				array(
					'id' => 'streamit_loader_gif',
					'type' => 'media',
					'url' => true,
					'title' => esc_html__('Add GIF image for loader', 'streamit'),
					'read-only' => false,
					'required' => array('streamit_display_loader', '=', 'yes'),
					'default' => array('url' => get_template_directory_uri() . '/assets/images/redux/loader.gif'),
					'subtitle' => esc_html__('Upload Loader GIF image for your Website.', 'streamit'),
				),

				array(
					'id' => 'loader-dimensions',
					'type' => 'dimensions',
					'units' => array('em', 'px', '%'),
					'units_extended' => 'true',
					'required' => array('streamit_display_loader', '=', 'yes'),
					'title' => esc_html__('Loader (Width/Height) Option', 'streamit'),
					'subtitle' => esc_html__('Allows you to choose width, height, and/or unit.', 'streamit'),
					'desc' => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'streamit'),
				),
			)
		));
	}
}
