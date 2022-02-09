<?php

/**
 * Template Name: Streamit Full Width
 * Template Post Type: post, movie , tv_show , video , episode
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage streamit
 * @since 1.0
 * @version 1.0
 */
get_header();
?>
<div class="<?php echo esc_attr($col); ?>">

	<?php
	if (is_singular('movie')) {
		get_template_part('single', 'movie');
	} else if (is_singular('video')) {
		get_template_part('single', 'video');
	} else if (is_singular('tv_show')) {
		get_template_part('single', 'tv-show');
	} else if (is_singular('episode')) {
		get_template_part('single', 'episode');
	} else {
		get_template_part('single');
	}
	wp_reset_postdata();
	?>
</div>

<?php get_footer();
