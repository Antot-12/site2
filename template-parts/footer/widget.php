<?php

/**
 * Template part for displaying the footer info
 *
 * @package streamit
 */

namespace Streamit\Utility;

$footer = streamit()->get_footer_option();
if (count($footer) == 0) {
	return;
}
$streamit_options = get_option('streamit_options');
$options = $streamit_options['streamit_footer_width'];
$standard_footer = '';
if($options == 6) {
	$standard_footer = 'footer-standard';
}
?>
    <div class="footer-top">
        <div class="container-fluid">
        <div class="row <?php echo esc_attr($standard_footer) ?>">
			<?php
			foreach ($footer['value'] as $key => $item) {
				if (is_active_sidebar('footer_' . ($key + 1) . '_sidebar')) { ?>
					<div class="<?php echo esc_attr($item, 'streamit'); ?>">
						<?php dynamic_sidebar('footer_' . ($key + 1) . '_sidebar'); ?>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>