<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package streamit
 */

namespace Streamit\Utility;

use Elementor\Plugin;

$footer_class = '';
$streamit_options = get_option('streamit_options');
$is_default = true;

if (isset($streamit_options['display_footer'])) {
	$options = $streamit_options['display_footer'];
	if ($options == "yes") {
		if (isset($streamit_options['footer_image']['url'])) {
			$bgurl = $streamit_options['footer_image']['url'];
		}
	}
}
?>
<footer id="colophon" class="footer streamit-uniq footer-one iq-bg-dark" <?php if (!empty($bgurl)) { ?> style="background-image: url(<?php echo esc_url($bgurl); ?> ) !important;" <?php } ?>>
	<?php
	get_template_part('template-parts/footer/widget');
	get_template_part('template-parts/footer/info');
	?>
</footer><!-- #colophon -->
</div><!-- .site-content-contain -->
</div><!-- #page -->

<!-- === back-to-top === -->
<div id="back-to-top">
	<a class="top" id="top" href="#top">
		<i class="ion-ios-arrow-up"></i>
	</a>
</div>
<!-- === back-to-top End === -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>