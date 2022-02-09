<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package streamit
 */

namespace Streamit\Utility;

$post_section = streamit()->post_style();
get_header();
get_template_part('template-parts/content/error', '404');
get_footer();
