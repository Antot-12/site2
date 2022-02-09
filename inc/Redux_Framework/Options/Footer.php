<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Footer class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Footer extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer', 'streamit'),
			'id' => 'footer-editor',
			'icon' => 'el el-arrow-down',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Layout', 'streamit'),
			'id' => 'footer-logo',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for footer.', 'streamit'),
			'fields' => array(
				array(
					'id'        => 'display_footer',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Footer Background Image', 'streamit'),
					'subtitle' => esc_html__('Display Footer Background Image On All page', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('Yes', 'streamit'),
						'no' => esc_html__('No', 'streamit')
					),
					'default'   => 'no'
				),

				array(
					'id' => 'footer_image',
					'type' => 'media',
					'url' => false,
					'desc' => esc_html__('Choose background image', 'streamit'),
					'required' => array('display_footer', '=', 'yes'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload Footer image for your Website.', 'streamit'),
					'default' => array('url' => get_template_directory_uri() . '/assets/images/redux/footer-img.jpg'),
				),
				array(
					'id'        => 'change_footer_color',
					'type'      => 'button_set',
					'title'     => esc_html__('Change Footer Color', 'streamit'),
					'subtitle' => esc_html__('Turn on to Change Footer Background Color', 'streamit'),
					'options'   => array(
						'0' => esc_html__('Yes', 'streamit'),
						'1' => esc_html__('No', 'streamit')
					),
					'default'   => '1'
				),
				array(
					'id'            => 'footer_color',
					'type'          => 'color',
					'title'         => esc_html__('Footer Color', 'streamit'),
					'subtitle'      => esc_html__('Choose Footer Background Color', 'streamit'),
					'required'  => array('change_footer_color', '=', '0'),
					'mode'          => 'background',
					'transparent'   => false
				),


			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Option', 'streamit'),
			'id' => 'footer-section',
			'subsection' => true,
			'desc' => esc_html__('This section contains options for footer.', 'streamit'),
			'fields' => array(

				array(
					'id' => 'streamit_footer_top',
					'type' => 'button_set',
					'title' => esc_html__('Display footer Top', 'streamit'),
					'subtitle' => esc_html__('Display Footer Top On All page', 'streamit'),
					'options' => array(
						'yes' => esc_html__('Yes', 'streamit'),
						'no' => esc_html__('No', 'streamit')
					),
					'default' => esc_html__('yes', 'streamit')
				),

				array(
					'id' => 'streamit_footer_width',
					'type' => 'image_select',
					'title' => esc_html__('Footer Layout Type', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'subtitle' => wp_kses(__('<br />Choose among these structures (1-column, 2-column, 3-column and 4-column) for your footer section.<br />To fill these column sections you should go to appearance > widget.<br />And add widgets as per your needs.', 'streamit'), array('br' => array())),
					'options' => array(
						'1' => array('title' => esc_html__('Footer Layout 1', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_first.png'),
						'2' => array('title' => esc_html__('Footer Layout 2', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_second.png'),
						'3' => array('title' => esc_html__('Footer Layout 3', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_third.png'),
						'4' => array('title' => esc_html__('Footer Layout 4', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_four.png'),
						'5' => array('title' => esc_html__('Footer Layout 5', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_five.png'),
						'6' => array('title' => esc_html__('Footer Layout 6', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/footer_six.png'),
					),
					'default' => '6',
				),

				array(
					'id' => 'footer_one',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 1', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_two',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 2', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center'
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_three',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 3', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),

				array(
					'id' => 'footer_four',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 4', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),
				array(
					'id' => 'footer_five',
					'type' => 'select',
					'desc' => esc_html__('Select alignment for footer 5', 'streamit'),
					'required' => array('streamit_footer_top', '=', 'yes'),
					'options' => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default' => '1',
				),
			)
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Footer Copyright', 'streamit'),
			'id' => 'footer-copyright',
			'subsection' => true,
			'fields' => array(

				array(
					'id' => 'display_copyright',
					'type' => 'button_set',
					'title' => esc_html__('Display Copyrights', 'streamit'),
					'options' => array(
						'yes' => esc_html__('Yes', 'streamit'),
						'no' => esc_html__('No', 'streamit')
					),
					'default' => esc_html__('no', 'streamit')
				),
				array(
					'id' => 'footer_copyright_align',
					'type' => 'select',
					'title' => esc_html__('Copyrights Alignment', 'streamit'),
					'required' => array('display_copyright', '=', 'yes'),
					'options'  => array(
						'1' => 'Left',
						'2' => 'Right',
						'3' => 'Center',
					),
					'default'  => '3',
				),

				array(
					'id' => 'footer_copyright',
					'type' => 'editor',
					'required' => array('display_copyright', '=', 'yes'),
					'title' => esc_html__('Copyrights Text', 'streamit'),
					'default' => esc_html__('© 2022 Streamit. All Rights Reserved.', 'streamit'),
				),
			)
		));
	}
}
