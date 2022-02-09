<?php

/**
 * Template part for displaying the page content when a 404 error has occurred
 *
 * @package streamit
 */

namespace Streamit\Utility;

$streamit_options = get_option('streamit_options');
?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="error-404 not-found">
				<div class="page-content">
					<div class="row">
						<div class="col-sm-12 text-center">
							<?php
							if (!empty($streamit_options['streamit_404_banner_image']['url'])) { ?>
								<div class="fourzero-image mb-5">
									<img src="<?php echo esc_url($streamit_options['streamit_404_banner_image']['url']); ?>" alt="<?php esc_attr_e('404', 'streamit'); ?>" />
								</div>

							<?php } else { ?>

								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/redux/404.png" alt="<?php esc_attr_e('404', 'streamit'); ?>" />

							<?php } ?>
							<h4>
								<?php
								$four_title = 'Oops! This Page is Not Found.';
								if (isset($streamit_options['streamit_fourzerofour_title']) && !empty($streamit_options['streamit_fourzerofour_title'])) {
									$four_title = $streamit_options['streamit_fourzerofour_title'];
								}
								echo esc_html($four_title);
								?>
							</h4>
							<p class="mb-5">
								<?php
								$four_des = 'The requested page does not exist.';
								if (isset($streamit_options['streamit_four_description']) && !empty($streamit_options['streamit_four_description'])) {
									$four_des = $streamit_options['streamit_four_description'];
								}
								echo esc_html($four_des);
								?>
							</p>
							<div class="d-block">
								<a class="btn btn-hover iq-button" href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Back to Home', 'streamit'); ?></a>
							</div>
						</div>
					</div>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->