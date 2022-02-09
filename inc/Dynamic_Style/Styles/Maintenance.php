<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Banner class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Maintenance extends Component
{

    public function __construct()
    {
        $this->streamit_maintenance_mode();
    }
    public function streamit_maintenance_mode()
    {
        $streamit_options =  get_option('streamit_options');
        if (isset($streamit_options['mainte_mode'])) {
            $options = $streamit_options['mainte_mode'];
            if ($options == "yes") {
                global $pagenow;
                if ($pagenow !== 'wp-login.php' && !current_user_can('manage_options') && !is_admin()) {
                    // header('Content-Type: text/html; charset=utf-8');

                    require_once get_template_directory() . '/template-parts/maintenance/maintenance.php';
                    
                    add_action('wp_enqueue_scripts', array($this,'streamit_maintance_js_css'));

                    die;
                }
            }
        }
    }
    public function streamit_maintance_js_css()
    {

        /* Custom JS */

        wp_enqueue_script('maintance-countTo', get_template_directory_uri() . '/assets/js/vendor/maintance/js/jquery.countTo.js', array('jquery'), '1.0', true);

        wp_enqueue_script('maintance-countdown', get_template_directory_uri() . '/assets/js/vendor/maintance/js/jquery.countdown.min.js', array('jquery'), '1.0', true);

        wp_enqueue_script('maintance-custom', get_template_directory_uri() . '/assets/js/vendor/maintance/js/maintance-custom.js', array(), '1.0', true);


        /* Custom CSS */

        wp_enqueue_style('maintance-style', get_template_directory_uri() . '/assets/css/vendor/maintance/css/main-style.css', array(), '1.0', 'all');

        wp_enqueue_style('maintance-responsive', get_template_directory_uri() . '/assets/css/vendor/maintance/css/main-responsive.css', array(), '1.0', 'all');

        wp_enqueue_style('maintance-countdown', get_template_directory_uri() . '/assets/css/vendor/maintance/css/jquery.countdown.css', array(), '1.0', 'all');
    }
}
