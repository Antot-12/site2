<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Styles class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Typography extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Typography', 'streamit'),
			'id' => 'default-style-section',
			'icon' => 'el el-text-width',
			'desc' => esc_html__('This section contains typography related options.', 'streamit'),
			'fields' => array(

				array(
					'id' => 'streamit_change_font',
					'type' => 'switch',
					'title' => esc_html__('Do you want to change fonts?', 'streamit'),
					'default' => 'on',
					'on' => esc_html__('Yes', 'streamit'),
					'off' => esc_html__('No', 'streamit')
				),

				array(
					'id'        => 'body_font',
					'type'      => 'typography',
					'title'     => esc_html__('Body Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-backup'   => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('Poppins', 'streamit'),
						'google'      => true
					)
				),

				array(
					'id'        => 'h1_font',
					'type'      => 'typography',
					'title'     => esc_html__('H1 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),

				array(
					'id'        => 'h2_font',
					'type'      => 'typography',
					'title'     => esc_html__('H2 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),

				array(
					'id'        => 'h3_font',
					'type'      => 'typography',
					'title'     => esc_html__('H3 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),
				array(
					'id'        => 'h4_font',
					'type'      => 'typography',
					'title'     => esc_html__('H4 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),
				array(
					'id'        => 'h5_font',
					'type'      => 'typography',
					'title'     => esc_html__('H5 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),
				array(
					'id'        => 'h6_font',
					'type'      => 'typography',
					'title'     => esc_html__('H6 Font', 'streamit'),
					'subtitle'  => esc_html__('Select the font.', 'streamit'),
					'required'  => array('streamit_change_font', '=', '1'),
					'google'    => true,
					'font-style'    => true,
					'font-weight'   => true,
					'font-size'     => true,
					'line-height'   => false,
					'color'         => false,
					'text-align'    => false,
					'default'       => array(
						'font-family' => esc_html__('PT+Sans', 'streamit'),
						'google'      => true
					)
				),
			)
		));
	}
}
