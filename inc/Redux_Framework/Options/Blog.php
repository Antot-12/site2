<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Blog class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Blog extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Blog', 'streamit'),
			'id'    => 'editor',
			'icon'  => 'el el-quotes',
			'customizer_width' => '500px',
		));

		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('General Blogs', 'streamit'),
			'id'    => 'blog-section',
			'subsection' => true,
			'desc'  => esc_html__('This section contains options for blog.', 'streamit'),
			'fields' => array(

				array(
					'id'       => 'streamit_blog_banner_image',
					'type'     => 'media',
					'url'      => true,
					'title'    => esc_html__('Blog Page Default Banner Image', 'streamit'),
					'read-only' => false,
					'subtitle' => esc_html__('Upload banner image for your Website. Otherwise blank field will be displayed in place of this section.', 'streamit') . '<b>' . esc_html__("(Note:Only Display Banner Style Second & Third in Page Banner Setting)", "streamit") . '</b>',
				),

				array(
					'id'        => 'streamit_blog',
					'type'      => 'image_select',
					'title'     => esc_html__('Blog page Setting', 'streamit'),
					'subtitle'  => wp_kses(__('Choose among these structures (Right Sidebar, Left Sidebar, 1column, 2column and 3column) for your blog section.<br />To filling these column sections you should go to appearance > widget.<br />And put every widget that you want in these sections.', 'streamit'), array('br' => array())),
					'options'   => array(
						'1' => array('title' => esc_html__('Right Sidebar', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux//right-side.jpg'),
						'2' => array('title' => esc_html__('Left Sidebar', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux//left-side.jpg'),
						'3' => array('title' => esc_html__('One Columns', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux//single-column.jpg'),
						'4' => array('title' => esc_html__('Two Columns', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux//two-column.jpg'),
						'5' => array('title' => esc_html__('Three Columns', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux//three-column.jpg'),
					),
					'default'   => '1',
				),

				array(
					'id'        => 'streamit_display_pagination',
					'type'      => 'button_set',
					'title'     => esc_html__('Post Settings', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Post ', 'streamit'),
					'options'   => array(
						'pagination' => esc_html__('Pagination', 'streamit'),
						'load_more' => esc_html__('Load More', 'streamit'),
						'infinite_scroll' => esc_html__('Infinite Scroll', 'streamit')
					),
					'default'   => 'infinite_scroll'
				),
				array(
					'id'        => 'streamit_display_blog_loadmore_text',
					'type'      => 'text',
					'title'     => esc_html__('Load More button text', 'streamit'),
					'default'   => esc_html__('Load More', 'streamit'),
					'required'  => array('streamit_display_pagination', '=', 'load_more'),
				),
				array(
					'id'        => 'streamit_display_blog_loadmore_text_2',
					'type'      => 'text',
					'title'     => esc_html__('Load More button text', 'streamit'),
					'default'   => esc_html__('Loading...', 'streamit'),
					'required'  => array('streamit_display_pagination', '=', 'load_more'),
				),
				array(
					'id'        => 'streamit_display_image',
					'type'      => 'button_set',
					'title'     => esc_html__('Featured Image on Blog Archive Page', 'streamit'),
					'subtitle' => esc_html__('Turn on to display featured images on the blog or archive pages.', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => 'yes'
				),
			)
		));

		Redux::set_section(
			$this->opt_name,
			array(
				'title'      => esc_html__('Blog Single Post', 'streamit'),
				'id'         => 'basic',
				'subsection' => true,
				'fields'     => array(

					array(
						'id'        => 'streamit_blog_type',
						'type'      => 'image_select',
						'title'     => esc_html__('Blog Single page Setting', 'streamit'),
						'subtitle'  => wp_kses(__('Choose among these structures (Right Sidebar, Left Sidebar and 1column) for your blog section.<br />To filling these column sections you should go to appearance > widget.<br />And put every widget that you want in these sections.', 'streamit'), array('br' => array())),
						'options'   => array(
							'1' => array('title' => esc_html__('Right Sidebar', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/right-side.jpg'),
							'2' => array('title' => esc_html__('Left Sidebar', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/left-side.jpg'),
							'3' => array('title' => esc_html__('Full Width', 'streamit'), 'img' => get_template_directory_uri() . '/assets/images/redux/single-column.jpg'),
						),
						'default'   => '1',
					),

					array(
						'id'        => 'streamit_display_comment',
						'type'      => 'button_set',
						'title'     => esc_html__('Comments', 'streamit'),
						'subtitle' => esc_html__('Turn on to display comments', 'streamit'),
						'options'   => array(
							'yes' => esc_html__('On', 'streamit'),
							'no' => esc_html__('Off', 'streamit')
						),
						'default'   => esc_html__('yes', 'streamit')
					),

				)
			)
		);
	}
}
