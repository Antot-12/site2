<?php
namespace Streamit\Utility\TGM;

/**
 * Streamit\Utility\Editor\Component class
 *
 * @package streamit
 */

use Streamit\Utility\Component_Interface;
use function add_action;

/**
 * Class for integrating with the block editor.
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 */
class Component implements Component_Interface
{

    /**
     * Gets the unique identifier for the theme component.
     *
     * @return string Component slug.
     */
    public function get_slug(): string
    {
        return 'tgm';
    }

    /**
     * Adds the action and filter hooks to integrate with WordPress.
     */
    public function initialize()
    {
        add_action('tgmpa_register', array($this, 'streamit_sp_register_required_plugins'));
    }

    /**
     * Register the required plugins for this theme.
     *
     * The variable passed to tgmpa_register_plugins() should be an array of plugin
     * arrays.
     *
     * This function is hooked into tgmpa_init, which is fired within the
     * TGM_Plugin_Activation class constructor.
     */
    function streamit_sp_register_required_plugins()
    {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */

        $plugins = array(

            array(
                'name'      => esc_html__('Advanced Custom Fields', 'streamit'),
                'slug'      => 'advanced-custom-fields',
                'required'  => true
            ),
            array(
                'name'      => esc_html__('Elementor', 'streamit'),
                'slug'      => 'elementor',
                'required'  => true
            ),
            array(
                'name'       => esc_html__('WP ULike - Most Advanced WordPress Marketing Toolkit', 'streamit'),
                'slug'       => 'wp-ulike',
                'required'   => true,
            ),

            array(
                'name'      => esc_html__('Paid Member Subscriptions', 'streamit'),
                'slug'      => 'paid-member-subscriptions',
                'required'  => true
            ),

            array(
                'name'      => esc_html__('Envato Market', 'streamit'),
                'slug'      => 'envato-market',
                'source'    => esc_url('https://assets.iqonic.design/wp/plugins/envato-market.zip'),
                'required'  => true
            ),

            array(
                'name'      => esc_html__('Meta Box – WordPress Custom Fields Framework', 'streamit'),
                'slug'      => 'meta-box',
                'required'  => true
            ),

            array(
                'name'      => esc_html__('Contact Form 7', 'streamit'),
                'slug'      => 'contact-form-7',
                'required'  => true
            ),
            array(
                'name'      => esc_html__('One Click Demo Import', 'streamit'),
                'slug'      => 'one-click-demo-import',
                'required'  => true
            ),

            array(
                'name'      => esc_html__('MAS Videos', 'streamit'),
                'slug'      => 'masvideos',
                'required'  => true
            ),
            array(
                'name'      => esc_html__('Streamit Extensions', 'streamit'),
                'slug'      => 'streamit-extensions',
                'source'    => esc_url('https://assets.iqonic.design/wp/plugins/streamit-new/streamit-extensions.zip'),
                'required'  => true,
            ),
            array(
                'name'      => esc_html__('Live streamit', 'streamit'),
                'slug'      => 'live-streamit',
                'source'    => esc_url('https://assets.iqonic.design/wp/plugins/streamit-new/live-streamit.zip'),
                'required'  => true,
            ),

        );

        /*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
        $config = array(
            'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'parent_slug'  => 'themes.php',            // Parent menu slug.
            'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa($plugins, $config);
    }
}
