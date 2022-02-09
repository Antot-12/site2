<?php

/**
 * Streamit\Utility\Scripts\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Scripts;

use Streamit\Utility\Component_Interface;
use Streamit\Utility\Templating_Component_Interface;
use function Streamit\Utility\streamit;
use function add_action;
use function wp_enqueue_script;
use function get_theme_file_uri;
use function get_theme_file_path;

class Component implements Component_Interface
{

	/**
	 * Associative array of CSS files, as $handle => $data pairs.
	 * $data must be an array with keys 'file' (file path relative to 'assets/css' directory), and optionally 'global'
	 * (whether the file should immediately be enqueued instead of just being registered) and 'preload_callback'
	 * (callback function determining whether the file should be preloaded for the current request).
	 *
	 * Do not access this property directly, instead use the `get_css_files()` method.
	 *
	 * @var array
	 */
	protected $js_files;

	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'scripts';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_action('wp_enqueue_scripts', array($this, 'action_enqueue_scripts'));
	}

	/**
	 * Registers or enqueues stylesheets.
	 *
	 * Stylesheets that are global are enqueued. All other stylesheets are only registered, to be enqueued later.
	 */
	public function action_enqueue_scripts()
	{
		global $wp_query;
		$js_uri = get_theme_file_uri('/assets/js/');
		$js_dir = get_theme_file_path('/assets/js/');

		$js_files = $this->get_js_files();
		foreach ($js_files as $handle => $data) {
			$src     = $js_uri . $data['file'];
			$version = streamit()->get_asset_version($js_dir . $data['file']);

			wp_enqueue_script($handle, $src, $data['dependency'], $version, $data['in_footer']);
		}
		wp_localize_script('streamit-loadmore', 'streamit_loadmore_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
			'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
			'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
			'max_page' => $wp_query->max_num_pages
		));
		wp_enqueue_script('streamit-loadmore');
	}

	/**
	 * Gets all JS files.
	 *
	 * @return array Associative array of $handle => $data pairs.
	 */
	protected function get_js_files(): array
	{
		if (is_array($this->js_files)) {
			return $this->js_files;
		}

		$js_files = array(
			'slick-min'     => array(
				'file'   => 'vendor/slick/slick.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'slick-animation'     => array(
				'file'   => 'vendor/slick/slick-animation.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'select2'     => array(
				'file'   => 'vendor/select2.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'magnific-popup'     => array(
				'file'   => 'vendor/jquery.magnific-popup.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'bootstrap'     => array(
				'file'   => 'vendor/bootstrap.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'wow'     => array(
				'file'   => 'vendor/wow.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'streamit-custom'     => array(
				'file'   => 'custom.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
			'streamit-loadmore'     => array(
				'file'   => 'loadmore.min.js',
				'dependency' => array('jquery'),
				'in_footer' => true,
			),
		);
		$this->js_files = array();
		foreach ($js_files as $handle => $data) {
			if (is_string($data)) {
				$data = array('file' => $data);
			}

			if (empty($data['file'])) {
				continue;
			}

			$this->js_files[$handle] = array_merge(
				array(
					'global'           => false,
					'preload_callback' => null,
					'media'            => 'all',
				),
				$data
			);
		}

		return $this->js_files;
	}
}
