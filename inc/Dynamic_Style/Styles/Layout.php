<?php

/**
 * Streamit\Utility\Dynamic_Style\Styles\Layout class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style\Styles;

use Streamit\Utility\Dynamic_Style\Component;
use function add_action;

class Layout extends Component
{

    public function __construct()
    {
        $this->streamit_maintenance_mode();
    }
    public function streamit_maintenance_mode()
    {
        $streamit_options =  get_option('streamit_options');
        if (isset($streamit_options['streamit_enable_sswitcher'])) {
            if ($streamit_options['streamit_enable_sswitcher']) {
                add_action('wp_enqueue_scripts', array($this, 'streamit_style_switcher_styles'), 20);
                add_action('wp_footer', array($this, 'streamit_style_switcher'));
            }
        }
    }

    public function streamit_style_switcher_styles()
    {
        wp_enqueue_script('iq-style-switcher-js', get_template_directory_uri() . '/assets/js/vendor/layout/iq-style-switcher.js', array(), '20140826', false);

        wp_enqueue_style('iq-style-switcher-css', get_template_directory_uri() . '/assets/css/vendor/layout/iq-style-switcher.css', array(), '1.0.0');
    }


    public function streamit_style_switcher()
    {
        $streamit_options = get_option('streamit_options');
        $options = $streamit_options['streamit_layout_mode_options']; ?>

        <div class="iq-theme-feature hidden-xs hidden-sm hidden-md">
            <div class="iq-switchbuttontoggler"><i class="fas fa-cog"></i></div>
            <div class="spanel">
                <form name="styleswitcher" action="<?php echo esc_url(home_url('/')); ?>" method="post">
                    <div class="presets">
                        <ul id="preset" class="preset">
                            <?php if ($options == 2) { ?>
                                <li class="active"><a class="ltr" id="ltr" href="?preset=2"><?php esc_html_e('LTR', 'streamit'); ?><input name="b" type="radio" value="LTR" hidden></a></li>
                                <li><a class="rtl" href="?preset=1" id="rtl"><?php esc_html_e('RTL', 'streamit'); ?><input name="b" type="radio" value="RTL" hidden></a></li>
                            <?php } else { ?>
                                <li class="active"><a class="ltr" id="ltr" href="?preset=1"><?php esc_html_e('LTR', 'streamit'); ?><input name="b" type="radio" value="1" hidden></a></li>
                                <li><a class="rtl" href="?preset=2" id="rtl"><?php esc_html_e('RTL', 'streamit'); ?><input name="b" type="radio" value="2" hidden></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
