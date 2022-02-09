<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\AdditionalCode class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class AdditionalCode extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'streamit_inline_css'), 20);
        add_action('wp_enqueue_scripts', array($this, 'streamit_inline_js'), 20);
    }

    public function streamit_inline_css()
    {
        $streamit_options = get_option('streamit_options');
        $custom_style = "";

        if (!empty($streamit_options['streamit_css_code'])) {
            $streamit_css_code = $streamit_options['streamit_css_code'];
            $custom_style = $streamit_css_code;
            wp_add_inline_style('streamit-style', $custom_style);
        }
    }

    public function streamit_inline_js()
    {
        $streamit_options = get_option('streamit_options');
        $custom_js = "";

        if (!empty($streamit_options['streamit_js_code'])) {
            $streamit_js_code = $streamit_options['streamit_js_code'];

            $custom_js = $streamit_js_code;
            wp_register_script('streamit-custom-js', '', [], '', true);
            wp_enqueue_script('streamit-custom-js');
            wp_add_inline_script('streamit-custom-js', wp_specialchars_decode($custom_js));
        }
    }
}
