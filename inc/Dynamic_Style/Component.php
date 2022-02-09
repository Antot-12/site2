<?php
/**
 * Streamit\Utility\Editor\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Dynamic_Style;

use Streamit\Utility\Component_Interface;
use Streamit\Utility\Dynamic_Style\Styles;

/**
 * Class for integrating with the block editor.
 *
 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
 */
class Component implements Component_Interface {

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'dynamic_style';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_add_dynamic_styles' ) );
	}

	public function action_add_dynamic_styles( ) {

		new Styles\Header();
		new Styles\HeaderSticky();
		new Styles\BodyContainer();
		new Styles\Footer();
		new Styles\Banner();
		new Styles\Color();
		new Styles\General();
		new Styles\Loader();
		new Styles\Typography();
		new Styles\Logo();
		new Styles\Layout();
		new Styles\AdditionalCode();
		new Styles\Maintenance();
	}

	public function streamit_dynamic_style ( $streamit_css_array ){
		foreach ( $streamit_css_array as $css_part ) {
			if ( ! empty( $css_part[ 'value' ] ) ) {
				echo esc_attr($css_part[ 'elements' ]) . "{\n";
				echo esc_attr($css_part[ 'property' ]) . ":" . esc_attr($css_part[ 'value' ]) . ";\n";
				echo "}\n\n";
			}
		}
	}

	public function streamit_add_inline ( $streamit_css_array ){
		wp_add_inline_style('streamit-style',$streamit_css_array);
	}
}
