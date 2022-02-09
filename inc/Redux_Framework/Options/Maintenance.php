<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Maintenance class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Maintenance extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Maintenance', 'streamit'),
			'id'    => 'Maintenance',
			'icon'  => 'el el-off',
			'desc'  => esc_html__('', 'streamit'),
			'fields'           => array(

				array(
					'id'        => 'mainte_mode',
					'type'      => 'button_set',
					'title'     => esc_html__('On/Off Maintenance or Coming Soon mode', 'streamit'),
					'subtitle' => esc_html__('Turn on to active Maintenance or Coming Soon mode.', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('no', 'streamit')
				),

				array(
					'id'       => 'maintenance_radio',
					'type'     => 'radio',
					'title'    => esc_html__('Maintenance Mode', 'streamit'),
					'required'  => array('mainte_mode', '=', 'yes'),
					'options'  => array(
						'1' => 'Maintenance',
						'2' => 'Coming Soon',
					),
					'default'  => '1'
				),

				array(
					'id'       => 'maintenance_bg_image',
					'type'     => 'media',
					'url'      => true,
					'title'    => esc_html__('Maintenance Default Background Image', 'streamit'),
					'required'  => array('maintenance_radio', '=', '1'),
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/maintenance.jpg'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload background image for your Website. Otherwise blank field will be displayed in place of this section.', 'streamit'),
				),

				array(
					'id'       => 'maintenance_title',
					'type'     => 'text',
					'title'    => esc_html__('Maintenance Title', 'streamit'),
					'required'  => array('maintenance_radio', '=', '1'),
					'default'  => esc_html__('Sorry,we are down for maintenance', 'streamit'),
				),

				array(
					'id'       => 'mainten_desc',
					'type'     => 'text',
					'title'    => esc_html__('Maintenance Description', 'streamit'),
					'required'  => array('maintenance_radio', '=', '1'),
					'default'  => esc_html__('We will be back shortly', 'streamit'),
				),

				array(
					'id'       => 'coming_soon_bg_image',
					'type'     => 'media',
					'url'      => true,
					'title'    => esc_html__('Coming Soon Default Background Image', 'streamit'),
					'required'  => array('maintenance_radio', '=', '2'),
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/maintenance.jpg'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload background image for your Website. Otherwise blank field will be displayed in place of this section.', 'streamit'),
				),

				array(
					'id'       => 'coming_title',
					'type'     => 'text',
					'title'    => esc_html__('Coming Soon Title', 'streamit'),
					'required'  => array('maintenance_radio', '=', '2'),
					'default'  => esc_html__('Coming Soon', 'streamit'),
				),

				array(
					'id'       => 'coming_desc',
					'type'     => 'text',
					'title'    => esc_html__('Coming Soon Description', 'streamit'),
					'required'  => array('maintenance_radio', '=', '2'),
					'default'  => esc_html__('We will be back with new and professional Ideas', 'streamit'),
				),

				array(
					'id'          => 'opt_date',
					'type'        => 'date',
					'title'       => esc_html__('Coming Soon Date', 'streamit'),
					'required'  => array('maintenance_radio', '=', '2'),
					'desc'        => esc_html__('This is the description field, again good for additional info.', 'streamit'),
					'placeholder' => 'Click to enter a date'
				),

				array(
					'id'          => 'opt_date',
					'type'        => 'date',
					'title'       => esc_html__('Coming Soon Date', 'streamit'),
					'required'  => array('maintenance_radio', '=', '2'),
					'placeholder' => 'Select-Date'
				),

			)
		));
	}
}
