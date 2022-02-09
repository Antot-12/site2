<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Loader class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Loader extends Component
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'streamit_loader_options'), 20);
    }

    public function streamit_loader_options()
    {
        $streamit_options = get_option('streamit_options');
        $loader_var = "";
        if (isset($streamit_options['loader_color'])) {
            $loader_var = $streamit_options['loader_color'];
            if (!empty($loader_var) && $loader_var != "#ffffff") {
                $loader_css = "
                    #loading {
                        background : $loader_var !important;
                    }";
            }
        }
        if (!empty($streamit_options["loader-dimensions"]["width"]) && $streamit_options["loader-dimensions"]["width"] != "px") {
            $loader_width = $streamit_options["loader-dimensions"]["width"];
            $loader_css .= '#loading img { width: ' . $loader_width . ' !important; }';
        }

        if (!empty($streamit_options["loader-dimensions"]["height"]) && $streamit_options["loader-dimensions"]["height"] != "px") {
            $loader_height = $streamit_options["loader-dimensions"]["height"];
            $loader_css .= '#loading img { height: ' . $loader_height . ' !important; }';
        }
        if (!empty($loader_css)) {
            wp_add_inline_style('streamit-style', $loader_css);
        }
    }
}
