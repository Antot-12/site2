<?php
/**
 * Streamit\Utility\Nav_Menus\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Nav_Menus;

use Streamit\Utility\Component_Interface;
use Streamit\Utility\Templating_Component_Interface;
use WP_Post;
use function add_action;
use function add_filter;
use function register_nav_menus;
use function has_nav_menu;
use function wp_nav_menu;

/**
 * Class for managing navigation menus.
 *
 * Exposes template tags:
 * * `streamit()->is_primary_nav_menu_active()`
 * * `streamit()->display_primary_nav_menu( array $args = array() )`
 */
class Component implements Component_Interface, Templating_Component_Interface {

	const PRIMARY_NAV_MENU_SLUG = 'top';

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug() : string {
		return 'nav_menus';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize() {
		add_action( 'after_setup_theme', array( $this, 'action_register_nav_menus' ) );
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `streamit()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags() : array {
		return array(
			'is_primary_nav_menu_active' => array( $this, 'is_primary_nav_menu_active' ),
			'display_primary_nav_menu'   => array( $this, 'display_primary_nav_menu' ),
		);
	}

	/**
	 * Registers the navigation menus.
	 */
	public function action_register_nav_menus() {
		register_nav_menus(
			array(
				static::PRIMARY_NAV_MENU_SLUG => esc_html__( 'Top Menu', 'streamit' ),
				'social' => esc_html__( 'Social Links Menu', 'streamit' ),
			)
		);
	}

	/**
	 * Adds a dropdown symbol to nav menu items with children.
	 *
	 * Adds the dropdown markup after the menu link element,
	 * before the submenu.
	 *
	 * Javascript converts the symbol to a toggle button.
	 *
	 * @TODO:
	 * - This doesn't work for the page menu because it
	 *   doesn't have a similar filter. So the dropdown symbol
	 *   is only being added for page menus if JS is enabled.
	 *   Create a ticket to add to core?
	 *
	 * @param string  $item_output The menu item's starting HTML output.
	 * @param WP_Post $item        Menu item data object.
	 * @param int     $depth       Depth of menu item. Used for padding.
	 * @param object  $args        An object of wp_nav_menu() arguments.
	 * @return string Modified nav menu HTML.
	 */
	

	/**
	 * Checks whether the primary navigation menu is active.
	 *
	 * @return bool True if the primary navigation menu is active, false otherwise.
	 */
	public function is_primary_nav_menu_active() : bool {
		return (bool) has_nav_menu( static::PRIMARY_NAV_MENU_SLUG );
	}

	/**
	 * Displays the primary navigation menu.
	 *
	 * @param array $args Optional. Array of arguments. See `wp_nav_menu()` documentation for a list of supported
	 *                    arguments.
	 */
	public function display_primary_nav_menu( array $args = array() ) {
		if ( ! isset( $args['container'] ) ) {
			$args['container'] = '';
		}

		$args['theme_location'] = static::PRIMARY_NAV_MENU_SLUG;
		wp_nav_menu( $args );
	}
}
