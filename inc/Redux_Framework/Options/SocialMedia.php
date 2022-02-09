<?php

/**
 * Streamit\Utility\Redux_Framework\Options\SocialMedia class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class SocialMedia extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title'            => esc_html__('Social Media', 'streamit'),
			'id'               => 'social_link',
			'icon'             => 'el-icon-share',
			'fields'           => array(

				array(
					'id'       => 'social-media-iq',
					'type'     => 'sortable',
					'title'    => esc_html__('Social Media Option', 'streamit'),
					'subtitle' => esc_html__('Enter social media url.', 'streamit'),
					'mode'     => 'text',
					'label'    => true,
					'options'  => array(
						'facebook'     	=> '',
						'twitter'       => '',
						'google-plus'  	=> '',
						'github'      	=> '',
						'instagram'     => '',
						'linkedin'      => '',
						'tumblr'        => '',
						'pinterest'     => '',
						'dribbble'      => '',
						'reddit'        => '',
						'flickr'        => '',
						'skype'         => '',
						'youtube'  => '',
						'vimeo'         => '',
						'soundcloud'    => '',
						'weixin'        => '',
						'renren'        => '',
						'weibo'         => '',
						'xing'          => '',
						'qq'            => '',
						'rss'           => '',
						'vk'            => '',
						'behance'       => '',
						'snapchat'      => '',
					),
				),

			),
		));
	}
}
