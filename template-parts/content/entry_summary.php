<?php

/**
 * Template part for displaying a post's summary
 *
 * @package streamit
 */

namespace Streamit\Utility;
?>

<div class="blog-content">
	<?php
	if (!empty($post->post_excerpt) && ord($post->post_excerpt) !== 38) {
			the_excerpt();
	} else {
		the_content( '', TRUE );
	}
	?>
</div><!-- .entry-summary -->