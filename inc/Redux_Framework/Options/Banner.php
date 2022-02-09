<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Banner class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Banner extends Component
{

    public function __construct()
    {
        $this->set_widget_option();
    }

    protected function set_widget_option()
    {
        Redux::set_section($this->opt_name, array(
            'title' => esc_html__('Banner Settings', 'streamit'),
            'id'    => 'banner',
            'icon'  => 'el el-cog',
            'desc'  => esc_html__('This section contains options for Page Breadcrumbs Area.', 'streamit'),
            'fields' => array(
                array(
                    'id'        => 'streamit_page_banner_image',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => esc_html__('Default Banner Image', 'streamit'),
                    'read-only' => false,
                    'subtitle'  => esc_html__('Upload default banner image for your Website.', 'streamit'),
                    'desc'      => esc_html__("This banner image displays only with style - 1,2", "streamit")
                ),
                array(
                    'id'        => 'bg_image',
                    'type'      => 'image_select',
                    'title'     => esc_html__('Select Banner Style', 'streamit'),
                    'subtitle'  => esc_html__('Select the style that best fits your needs.', 'streamit'),
                    'options'   => array(
                        '1'      => array(
                            'alt' => esc_attr__('Style1', 'streamit'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-1.jpg',
                        ),
                        '2'      => array(
                            'alt' => esc_attr__('Style2', 'streamit'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-2.jpg',
                        ),
                        '3'      => array(
                            'alt' => esc_attr__('Style3', 'streamit'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-3.jpg',
                        ),
                        '4'      => array(
                            'alt' => esc_attr__('Style4', 'streamit'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-4.jpg',
                        ),
                        '5'      => array(
                            'alt' => esc_attr__('Style5', 'streamit'),
                            'img' => get_template_directory_uri() . '/assets/images/redux/bg-5.jpg',
                        ),
                    ),
                    'default' => '1'
                ),

                array(
                    'id' => 'display_banner',
                    'type' => 'button_set',
                    'title' => esc_html__('Display Banner on inner Pages', 'streamit'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'streamit'),
                        'no' => esc_html__('No', 'streamit')
                    ),
                    'default' => esc_html__('yes', 'streamit')
                ),

                array(
                    'id' => 'display_breadcrumbs',
                    'type' => 'button_set',
                    'title' => esc_html__('Display breadcrumbs (navigation) on banner', 'streamit'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'streamit'),
                        'no' => esc_html__('No', 'streamit')
                    ),
                    'required' => array('display_banner', '=', 'yes'),
                    'default' => esc_html__('yes', 'streamit')
                ),

                array(
                    'id' => 'display_title',
                    'type' => 'button_set',
                    'title' => esc_html__('Display title on banner', 'streamit'),
                    'options' => array(
                        'yes' => esc_html__('Yes', 'streamit'),
                        'no' => esc_html__('No', 'streamit')
                    ),
                    'required' => array('display_banner', '=', 'yes'),
                    'default' => esc_html__('yes', 'streamit')
                ),


                array(
                    'id' => 'breadcum_title_tag',
                    'type' => 'select',
                    'desc' => __('Select title tag', 'streamit'),
                    'options' => array(
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h5' => 'h4',
                        'h5' => 'h5',
                        'h6' => 'h6'
                    ),
                    'required' => array('display_title', '=', 'yes'),
                    'default' => 'h2'
                ),

                array(
                    'id' => 'bg_title_color',
                    'type' => 'color',
                    'desc' => esc_html__('Set title color', 'streamit'),
                    'default'       => '',
                    'mode' => 'background',
                    'required' => array(
                        'display_title',
                        '=',
                        'yes'
                    ),
                    'transparent' => false
                ),

                array(
                    'id'       => 'bg_type',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Banner Background', 'streamit'),
                    'options'  => array(
                        '1' => 'Color',
                        '2' => 'Image'
                    ),
                    'default'  => '2'
                ),
                array(
                    'id'            => 'bg_color',
                    'type'          => 'color',
                    'desc'         => esc_html__('Set banner background Color', 'streamit'),
                    'required'  => array('bg_type', '=', '1'),
                    'mode'          => 'background',
                    'transparent'   => false
                ),
                array(
                    'id'       => 'banner_image',
                    'type'     => 'media',
                    'url'      => false,
                    'desc'    => esc_html__('Set banner background image', 'streamit'),
                    'read-only' => false,
                    'required'  => array('bg_type', '=', '2'),
                    'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/bg.jpg'),
                ),
            )
        ));
    }
}
