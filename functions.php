<?php

/**
 * Streamit functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package streamit
 */

define('STREAMIT_MINIMUM_WP_VERSION', '4.5');
define('STREAMIT_MINIMUM_PHP_VERSION', '7.0');

// Bail if requirements are not met.
if (version_compare($GLOBALS['wp_version'], STREAMIT_MINIMUM_WP_VERSION, '<') || version_compare(phpversion(), STREAMIT_MINIMUM_PHP_VERSION, '<')) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

// Include WordPress shims.
require get_template_directory() . '/inc/wordpress-shims.php';
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/import.php';

// Setup autoloader (via Composer or custom).
if (file_exists(get_template_directory() . '/vendor/autoload.php')) {
	require get_template_directory() . '/vendor/autoload.php';
} else {
	/**
	 * Custom autoloader function for theme classes.
	 *
	 * @access private
	 *
	 * @param string $class_name Class name to load.
	 * @return bool True if the class was loaded, false otherwise.
	 */
	function streamit_autoload($class_name)
	{
		$namespace = 'Streamit\Utility';

		if (strpos($class_name, $namespace . '\\') !== 0) {
			return false;
		}

		$parts = explode('\\', substr($class_name, strlen($namespace . '\\')));

		$path = get_template_directory() . '/inc';
		foreach ($parts as $part) {
			$path .= '/' . $part;
		}
		$path .= '.php';

		if (!file_exists($path)) {
			return false;
		}

		require_once $path;

		return true;
	}
	spl_autoload_register('streamit_autoload');
}

// Load the `streamit()` entry point function.
require get_template_directory() . '/inc/functions.php';
// Initialize the theme.
call_user_func('Streamit\Utility\streamit');


// Custom Code
if (is_user_logged_in()) {
	$user = wp_get_current_user();
	if ($user->roles[0] === 'subscriber') {
		show_admin_bar(false);
	}
}
//  Gredient Color
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',')
{
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	$rgbArray = array();
	if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal = hexdec($hexStr);
		$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
		$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
		$rgbArray['blue'] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
		$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false; //Invalid hex color code
	}
	return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

// ** Mas Video review count rating ** //
if (!function_exists('masvideos_star_rating')) {
	function masvideos_star_rating($args = array())
	{
		$defaults = array(
			'rating' => 0,
			'type'   => 'rating',
			'number' => 0,
			'echo'   => true,
		);
		$r = wp_parse_args($args, $defaults);

		$rating = (float) str_replace(',', '.', $r['rating']);

		if ('percent' === $r['type']) {
			$rating = round($rating / 5, 0) / 2;
		}

		$full_stars = floor($rating);
		$half_stars = ceil($rating - $full_stars);
		$empty_stars = 5 - $full_stars - $half_stars;

		if ($r['number']) {
			$format = _n('%1$s rating based on %2$s rating', '%1$s rating based on %2$s ratings', $r['number']);
			$title = sprintf($format, number_format_i18n($rating, 1), number_format_i18n($r['number']));
		} else {
			$title = sprintf(__('%s rating', 'streamit'), number_format_i18n($rating, 1));
		}

		$output = '<div class="star-rating">';
		$output .= '<span class="screen-reader-text">' . $title . '</span>';
		$output .= str_repeat('<div class="star star-full" aria-hidden="true"></div>', $full_stars);
		$output .= str_repeat('<div class="star star-half" aria-hidden="true"></div>', $half_stars);
		$output .= str_repeat('<div class="star star-empty" aria-hidden="true"></div>', $empty_stars);
		$output .= '</div>';

		if ($r['echo']) {
			wp_kses($output, 'post');
		}

		return $output;
	}
}