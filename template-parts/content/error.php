<?php

/**
 * Template part for displaying the page content when an error has occurred
 *
 * @package streamit
 */

namespace Streamit\Utility;

?>
<div class="col-12">
	<section class="error text-center streamit-error">
		<?php get_template_part('template-parts/content/page_header'); ?>
		<div class="page-content">
			<?php if (is_home() && current_user_can('publish_posts')) { ?>
				<p>
					<?php
					printf(
						wp_kses(
							/* translators: 1: link to WP admin new post page. */
							esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'streamit'),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						),
						esc_url(admin_url('post-new.php'))
					);
					?>
				</p>
			<?php } elseif (is_search()) { ?>
				<div class="col-12">
					<p>
						<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'streamit'); ?>
					</p>
				</div>
			<?php } else { ?>
				<p>
					<?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'streamit'); ?>
				</p>
			<?php
			}
			get_search_form('');
			?>
		</div><!-- .page-content -->
	</section><!-- .error -->
</div>