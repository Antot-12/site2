<?php

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package streamit
 */

namespace Streamit\Utility;

global $wp_query;

$streamit_options = get_option('streamit_options');

$is_sidebar = streamit()->is_primary_sidebar_active();
$post_section = streamit()->post_style();
get_header();
global $wp_query;
$options_streamit_load = !empty($streamit_options) ? $streamit_options['streamit_genere_tag_category_item'] : '';
$args = $wp_query->query_vars;

$wp_query->query_vars['posts_per_page'] = $args['posts_per_page'] = isset($streamit_options['streamit_genere_tag_category_post_per_page']) && !empty($streamit_options['streamit_genere_tag_category_post_per_page']) ? $streamit_options['streamit_genere_tag_category_post_per_page'] : $wp_query->query_vars['posts_per_page'];

$wp_post = new \WP_Query($args);

$is_generes_tag = !empty(wp_get_post_terms(get_the_ID(), array('movie_genre', 'movie_tag', 'video_tag', 'video_cat', 'tv_show_tag', 'tv_show_genre')));
?>
<div class="site-content-contain">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main <?php echo esc_attr($is_generes_tag ? 'watchlist-contens streamit_datapass_archive' : 'streamit_datapass_blog'); ?>" data-displaypost="<?php echo esc_attr($args['posts_per_page']) ?>" data-options="<?php echo esc_attr($is_generes_tag ? $options_streamit_load : $streamit_options['streamit_display_pagination']); ?>" data-pages="<?php echo esc_attr($wp_query->max_num_pages) ?>">
				<?php
				if (class_exists('MasVideos') && $is_generes_tag) {
					if ($wp_post->have_posts()) {

				?>
						<div class="container-fluid">
							<div class="row">
								<?php

								while ($wp_post->have_posts()) {
									$wp_post->the_post();
									get_template_part('template-parts/content/entry_search', $wp_post->get_post_type());
								}

								?>
							</div>
							<?php
							if (isset($streamit_options['streamit_genere_tag_category_item'])) {
								$options = $streamit_options['streamit_genere_tag_category_item'];
								if ($options == "load_more") {
									if ($wp_query->max_num_pages > 1)
										echo '<a class="streamit_loadmore_btn btn btn-hover iq-button" tabindex="0" data-loading-text="' . $streamit_options['streamit_genere_tag_category_loadmore_text_2'] . '"><span data-parallax="scroll">' . $streamit_options['streamit_genere_tag_category_display_loadmore_text'] . '</span></a>';
								} elseif ($options == "infinite_scroll") {

									echo '<div class="loader-wheel-container"></div>';
								} else {
									get_template_part('template-parts/content/pagination');
								}
							} else {
								get_template_part('template-parts/content/pagination');
							}
							?>

						</div>
					<?php
					}
				} else {


					$args = $wp_query->query_vars;

					unset($args['post_type']);
					unset($args['posts_per_page']);
					$args['post_type'] = array('post');


					?>
					<div class="container">
						<div class="row <?php echo esc_attr($post_section['row_reverse']); ?>">
							<?php

							if ($is_sidebar) {
								echo '<div class="col-xl-8 col-sm-12 streamit-blog-main-list">';
							} else if (!empty($streamit_options) && $streamit_options['streamit_blog'] != '4' && $streamit_options['streamit_blog'] != '5') {
								echo '<div class="col-lg-12 col-sm-12 streamit-blog-main-list">';
							}
							$query = new \WP_Query($args);
							if ($query->have_posts()) {
								while ($query->have_posts()) {
									$query->the_post();
									get_template_part('template-parts/content/entry', $query->get_post_type(), $post_section['post']);
								}
							} else {
								get_template_part('template-parts/content/error');
							}

							if ($is_sidebar || !empty($streamit_options) && $streamit_options['streamit_blog'] != '4' && $streamit_options['streamit_blog'] != '5') {
								echo '</div>';
							}
							get_sidebar();

							?>
						</div>
						<?php
						if (!is_singular()) {
							if (isset($streamit_options['streamit_display_pagination'])) {
								$options = $streamit_options['streamit_display_pagination'];
								if ($options == "load_more") {
									if ($wp_query->max_num_pages > 1)
										echo '<a class="streamit_loadmore_btn_blog btn btn-hover iq-button" tabindex="0" data-loading-text="' . $streamit_options['streamit_display_blog_loadmore_text_2'] . '"><span>' . $streamit_options['streamit_display_blog_loadmore_text'] . '</span></a>';
								} elseif ($options == "infinite_scroll") {

									echo '<div class="loader-wheel-container"></div>';
								} else {
									get_template_part('template-parts/content/pagination');
								}
							} else {
								get_template_part('template-parts/content/pagination');
							}
						}

						?>
					</div>

				<?php
				}
				?>
			</main><!-- #main -->
		</div> <!-- #primary -->

	</div>

</div>
<?php
get_footer();
