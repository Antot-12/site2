<?php
/**
 * Template part for displaying the custom header media
 *
 * @package streamit
 */

namespace Streamit\Utility;

if ( ! has_header_image() ) {
	return;
}

?>
<figure class="header-image">
	<?php the_header_image_tag(); ?>
</figure><!-- .header-image -->
