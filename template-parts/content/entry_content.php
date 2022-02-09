<?php

/**
 * Template part for displaying a post's content
 *
 * @package streamit
 */

namespace Streamit\Utility;


if (is_single()) {
	the_content();
} else {
	the_excerpt();
}
?>
