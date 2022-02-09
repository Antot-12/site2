<?php

/**
 * Template part for displaying a post's title
 *
 * @package streamit
 */

namespace Streamit\Utility;

if (!is_singular(get_post_type()) && !empty(trim(get_the_title()))) {
	echo '<div class="blog-title"><h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title() . '</a></h3></div>';
}
