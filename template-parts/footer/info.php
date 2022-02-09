<?php

/**
 * Template part for displaying the footer info
 *
 * @package streamit
 */

namespace Streamit\Utility;
?>
<?php
if (class_exists('ReduxFramework')) {
	$streamit_options = get_option('streamit_options');
?>
	<?php if (isset($streamit_options['display_copyright']) &&  $streamit_options['display_copyright'] == 'yes') { ?>
		<div class="copyright-footer">
			<div class="pt-3 pb-3">
				<div class="row flex-row-reverse justify-content-between">
					<div class="col-lg-12 col-md-12 text-lg-<?php echo esc_attr($streamit_options['footer_copyright_align']); ?> text-md-center text-center">
						<?php if (isset($streamit_options['footer_copyright'])) {  ?>
							<span class="copyright">
								<?php echo html_entity_decode($streamit_options['footer_copyright']); ?>
							</span>
						<?php } else {	?>
							<span class="copyright">
								<a target="_blank" rel="nofollow" href="<?php echo esc_url('https://themeforest.net/user/iqonicthemes/portfolio/'); ?>">
									<?php esc_html_e('© 2021', 'streamit'); ?>
									<strong><?php esc_html_e(' Streamit ', 'streamit'); ?></strong>
									<?php esc_html_e('. All Rights Reserved.', 'streamit'); ?>
								</a>
							</span>
						<?php } ?>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	<?php } ?>
<?php } else { ?>
	<div class="copyright-footer">
		<div class="pt-3 pb-3">
			<div class="row flex-row-reverse justify-content-between">
				<div class="col-lg-12 col-md-12 text-center">
					<span class="copyright">
						<a target="_blank" rel="nofollow" href="<?php echo esc_url(__('https://themeforest.net/user/iqonicthemes/portfolio/', 'streamit')); ?>">
							<?php esc_html_e('© 2022', 'streamit'); ?>
							<strong><?php esc_html_e(' streamit ', 'streamit'); ?></strong>
							<?php esc_html_e('. All Rights Reserved.', 'streamit'); ?>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div><!-- .site-info -->
<?php } ?>