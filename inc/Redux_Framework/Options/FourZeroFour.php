<?php

/**
 * Streamit\Utility\Redux_Framework\Options\FourZeroFour class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class FourZeroFour extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('404', 'streamit'),
			'id'    => 'fourzerofour-section',
			'icon'  => 'el-icon-error',
			'desc'  => esc_html__('This section contains options for 404.', 'streamit'),
			'fields' => array(

				array(
					'id'       	=> 'streamit_404_banner_image',
					'type'     	=> 'media',
					'url'      	=> true,
					'title'    	=> esc_html__('404 Page Default Banner Image', 'streamit'),
					'read-only' => false,
					'default'  	=> array('url' => get_template_directory_uri() . '/assets/images/redux/404.png'),
					'subtitle' 	=> esc_html__('Upload banner image for your Website. Otherwise blank field will be displayed in place of this section.', 'streamit'),
				),

				array(
					'id'        => 'streamit_fourzerofour_title',
					'type'      => 'text',
					'title'     => esc_html__('404 Page Title', 'streamit'),
					'default'   => esc_html__('Oops! This Page is Not Found.', 'streamit'),
				),

				array(
					'id'        => 'streamit_four_description',
					'type'      => 'textarea',
					'title'     => esc_html__('404 Page Description', 'streamit'),
					'default'   => esc_html__('The requested page does not exist.', 'streamit'),
				),

				array(
					'id'        => '404_backtohome_title',
					'type'      => 'text',
					'title'     => esc_html__('404 Page Button', 'streamit'),
					'default'   => esc_html__('Back to Home', 'streamit'),
				),
			)
		));
	}
}
