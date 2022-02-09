<?php

/**
 * Streamit\Utility\Redux_Framework\Options\General class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class General extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('General', 'streamit'),
			'id' => 'editer-general',
			'icon' => 'el el-dashboard',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Body Layout', 'streamit'),
			'id' => 'layout-section',
			'icon' => 'el el-website',
			'subsection' => true,
			'fields' => array(

				array(
					'id' => 'opt-container-width',
					'type' => 'slider',
					'title' => esc_html__('Grid Container Width', 'streamit'),
					'desc' => esc_html__('Adjust Your Site Container Width Wtih Help Of Above Opiton.', 'streamit'),
					'min' => 960,
					'step' => 1,
					'max' => 1920,
					'display_value' => 'select',
					'default' => 1100
				),

				array(
					'id' => 'layout_set',
					'type' => 'button_set',
					'title' => esc_html__('Body Background', 'streamit'),
					'desc' => esc_html__('Select this option for body background.', 'streamit'),
					'options' => array(
						'1' => 'Color',
						'2' => 'Default',
						'3' => 'Image'
					),
					'default' => '2'
				),

				array(
					'id' => 'streamit_layout_color',
					'type' => 'color',
					'desc' => esc_html__('Choose body background color', 'streamit'),
					'required' => array('layout_set', '=', '1'),
					'default'       => '#ffffff',
					'mode' => 'background',
					'transparent' => false
				),

				array(
					'id' => 'streamit_layout_image',
					'type' => 'media',
					'url' => false,
					'read-only' => false,
					'required' => array('layout_set', '=', '3'),
					'desc' => esc_html__('Choose body background image.', 'streamit'),
				),
			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Back to Top', 'streamit'),
			'id' => 'header-general',
			'icon' => 'el el-circle-arrow-up',
			'subsection' => true,
			'fields' => array(
				array(
					'id' => 'streamit_back_to_top',
					'type' => 'button_set',
					'title' => esc_html__('Display back to top button', 'streamit'),
					'options' => array(
						'yes' => esc_html__('Yes', 'streamit'),
						'no' => esc_html__('No', 'streamit')
					),
					'default' => esc_html__('yes', 'streamit')
				),
			)
		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Favicon', 'streamit'),
			'id'    => 'header-fevicon',
			'icon'  => 'el el-ok',
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'streamit_fevicon',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Favicon', 'streamit'),
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/favicon.ico'),
					'subtitle' => esc_html__('Upload logo image for your Website. Otherwise site title will be displayed in place of logo.', 'streamit'),
				),
			)
		));
	}
}
