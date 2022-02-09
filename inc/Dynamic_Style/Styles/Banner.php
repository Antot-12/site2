<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Banner class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Banner extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'streamit_banner_dynamic_style'), 20);
        add_action('wp_enqueue_scripts', array($this, 'streamit_opacity_color'), 20);
    }

    public function streamit_banner_dynamic_style()
    {
        $page_id = get_queried_object_id();
        $streamit_options = get_option('streamit_options');
        $dynamic_css = '';

        if (function_exists('get_field') && get_field('key_banner_display', $page_id) == 'no') {
            if (get_field('key_banner_display', $page_id) == 'no') {
                $dynamic_css .=
                    '.iq-breadcrumb-one { display: none !important; }
                    .content-area .site-main {padding : 0 !important; }';
            }
        } else if (isset($streamit_options['display_banner'])) {
            if ($streamit_options['display_banner'] == 'no') {
                $dynamic_css .=
                    '.iq-breadcrumb-one { display: none !important; }
                    .content-area .site-main {padding : 0 !important; }';
            }
        }
        $key = (function_exists('get_field')) ? get_field('field_display_breadcrumb', $page_id) : "";
        if (isset($key['display_title']) && $key['display_title'] != 'default'  && $key['display_title'] == 'no') {
            $dynamic_css .= '.iq-breadcrumb-one .title { display: none !important; }';
        } else if (isset($streamit_options['display_title'])) {

            if ($streamit_options['display_title'] == 'no') {
                $dynamic_css .= '.iq-breadcrumb-one .title { display: none !important; }';
            }
        }

        if (isset($key['display_breadcumb']) && $key['display_breadcumb'] != 'default'  && $key['display_breadcumb'] == 'no') {
            $dynamic_css .= '.iq-breadcrumb-one .breadcrumb { display: none !important; }';
        } else if (isset($streamit_options['display_breadcumb'])) {
            if ($streamit_options['display_breadcumb'] == 'no') {
                $dynamic_css .= '.iq-breadcrumb-one .breadcrumb { display: none !important; }';
            }
        }

        if (isset($streamit_options['bg_title_color'])) {

            if ($streamit_options['bg_title_color'] == 'yes') {
                $dynamic = $streamit_options['bg_title_color'];
                $dynamic_css .= !empty($dynamic) ? '.iq-breadcrumb-one .title { color: ' . $dynamic . ' !important; }' : '';
            }
        }
        if (isset($streamit_options['bg_type'])) {
            $opt = $streamit_options['bg_type'];
            if ($opt == '1') {
                if (isset($streamit_options['bg_color']) && !empty($streamit_options['bg_color'])) {
                    $dynamic = $streamit_options['bg_color'];
                    $dynamic_css .= !empty($dynamic) ? '.iq-breadcrumb-one { background: ' . $dynamic . ' !important; }' : '';
                }
            }
            if ($opt == '2') {
                if (isset($streamit_options['banner_image']['url'])) {
                    $dynamic = $streamit_options['banner_image']['url'];
                    $dynamic_css .= !empty($dynamic) ? '.iq-breadcrumb-one { background-image: url(' . $dynamic . ') !important; }' : '';
                }
            }
            
        }
        if (!empty($dynamic_css)) {
            wp_add_inline_style('streamit-style', $dynamic_css);
        }
    }
    public function streamit_opacity_color()
    {
        //Set Background Opacity Color
        $streamit_options = get_option('streamit_options');

        if (!empty($streamit_options['bg_opacity']) && $streamit_options['bg_opacity'] == "3") {
            $bg_opacity = $streamit_options['opacity_color']['rgba'];
        }

        if (!empty($streamit_options['bg_opacity']) && $streamit_options['bg_opacity'] == "3") {
            if (!empty($bg_opacity)) {
                $dynamic_css = "
                .breadcrumb-video::before,.breadcrumb-bg::before, .breadcrumb-ui::before {
                    background : $bg_opacity !important;
                }";
                wp_add_inline_style('streamit-style', $dynamic_css);
            }
        }
    }
}
