<?php

/**
 * Template part for displaying a post's header
 *
 * @package streamit
 */

namespace Streamit\Utility;

$streamit_options = get_option('streamit_options');
?>


<?php
if (!is_search() || is_archive()) {
	if (isset($streamit_options['streamit_display_image'])) {
		$options = $streamit_options['streamit_display_image'];
		if ($options == "yes") {
			get_template_part('template-parts/content/entry_thumbnail', get_post_type());
		}
	} else {
		get_template_part('template-parts/content/entry_thumbnail', get_post_type());
	}
}
?>
<div class="iq-blog-detail">
	<?php
	get_template_part('template-parts/content/entry_meta', get_post_type());
	if (!is_single()) {
		get_template_part('template-parts/content/entry_title', get_post_type());
	}
	?>
	<!-- .entry-header -->