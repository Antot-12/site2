<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package streamit
 */

namespace Streamit\Utility;

$streamit_options = get_option('streamit_options');
$is_sidebar = streamit()->is_primary_sidebar_active();
$post_section = streamit()->post_style();

$is_generes_tag = !empty(wp_get_post_terms(get_the_ID(), array('movie_genre', 'movie_tag', 'video_tag', 'video_cat', 'tv_show_tag', 'tv_show_genre')));
$options_streamit_load = '';
if (isset($streamit_options['streamit_blog'])) {
	$streamit_layout = $streamit_options['streamit_blog'];
}
if (isset($streamit_options['streamit_display_pagination'])) {
	$options_streamit_load = $streamit_options['streamit_display_pagination'];
}
get_header();
global $wp_query;
$options_streamit_load = isset($streamit_options['streamit_display_pagination']) ? $streamit_options['streamit_display_pagination'] : '';
?>
<div class="site-content-contain">
	<div id="content" class="site-content">
		<div id="primary" class="content-area search-page">
			<main id="main" class="watchlist-contens site-main streamit_datapass" data-options="<?php echo esc_attr($options_streamit_load); ?>">
				<div class="<?php echo esc_attr(class_exists('MasVideos') ? "container-fluid" : "container")  ?>">
					<div class="row">
						<?php
						if ($is_generes_tag  && class_exists('MasVideos')) {
							if (have_posts()) {
								unset($wp_query->query_vars['post_type'][4]);
								$query = new \WP_Query($wp_query->query_vars);
								while ($query->have_posts()) {

									$query->the_post();
									get_template_part('template-parts/content/entry_search', $query->get_post_type());
								}
							} else {
								get_template_part('template-parts/content/error');
							}
						} else {
							if ($is_sidebar) {
								echo '<div class="col-xl-8 col-sm-12 streamit-blog-main-list">';
							} else if ($streamit_layout != '4' && $streamit_layout != '5') {
								echo '<div class="col-lg-12 col-sm-12 streamit-blog-main-list">';
							}

							if (have_posts()) {
								while (have_posts()) {
									the_post();
									get_template_part('template-parts/content/entry', get_post_type(), $post_section['post']);
								}
							} else {
								get_template_part('template-parts/content/error');
							}

							if ($is_sidebar || $streamit_layout != '4' && $streamit_layout != '5') {
								echo '</div>';
							}
							get_sidebar();
						}


						?>
					</div>
					<?php
					if (isset($streamit_options['streamit_display_pagination'])) {
						$options = $streamit_options['streamit_display_pagination'];
						if ($options == "load_more") {
							if ($wp_query->max_num_pages > 1)
								echo '<a class="streamit_loadmore_btn btn btn-hover iq-button" tabindex="0" data-loading-text="' . $streamit_options['streamit_display_blog_loadmore_text_2'] . '"><span data-parallax="scroll">' . $streamit_options['streamit_display_blog_loadmore_text'] . '</span></a>';
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
				if (class_exists('MasVideos')) {
					if (isset($streamit_options['streamit_display_upcoming'])) {
						if ($streamit_options['streamit_display_upcoming'] == 'yes') {
							$args = array(
								'post_type' => 'movie',
								'post_status' => 'publish',
								'posts_per_page' => -1,
								'meta_query' => array(
									array(
										'key'     => 'name_upcoming',
										'value'   => '"yes"',
										'compare' => 'LIKE'
									)
								),
							);
							$upcomming_movie = new \WP_Query($args);
							if ($upcomming_movie->have_posts()) { ?>
								<div id="iq-upcoming-movie" class="iq-rtl-direction">
									<div class="container-fluid">
										<div class="row">
											<div class="col-sm-12 overflow-hidden">
												<div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
													<h4 class="main-title">
														<?php if (!empty($streamit_options['streamit_upcoming_title'])) {
															echo esc_attr($streamit_options['streamit_upcoming_title'], 'streamit');
														} else {
															echo __('Upcoming Movies', 'streamit');
														} ?>
													</h4>
												</div>
												<div class="upcoming-contens">
													<ul class="inner-slider list-inline row p-0 mb-0">
														<?php
														while ($upcomming_movie->have_posts()) {
															$upcomming_movie->the_post();
															$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full");
															$trailer_link = get_field('name_trailer_link', get_the_ID());
															$movie_run_time = get_post_meta(get_the_ID(), '_movie_run_time');
															$movie_url_link = get_post_meta(get_the_ID(), '_movie_url_link');
															$movie_choice = get_post_meta(get_the_ID(), '_movie_choice');
															$meta = get_post_meta(get_the_ID());

															$run_time = '';
															$url_link = '';
															$censor_rating = '';
															if (isset($movie_run_time[0])) {
																$run_time = $movie_run_time[0];
															}
															if (isset($movie_censor_rating[0])) {
																$censor_rating = $movie_censor_rating[0];
															}

															if (isset($movie_choice[0])) {
																if ($movie_choice[0] == 'movie_url') {
																	$url_link = $movie_url_link[0];
																} else {
																	$url_link = get_the_permalink();
																}
															}
														?>
															<li class="slide-item">
																<div class="block-images position-relative">
																	<div class="img-box">
																		<img src="<?php echo esc_url($full_image[0]) ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
																	</div>
																	<div class="block-description">
																		<h6>
																			<a href="<?php echo esc_url($url_link); ?>">
																				<?php the_title(); ?>
																			</a>
																		</h6>
																		<div class="movie-time d-flex align-items-center my-2">
																			<div class="badge badge-secondary p-1 mr-2"><?php echo esc_html($censor_rating, 'streamit'); ?></div>
																			<span class="text-white"><?php echo esc_html($run_time, 'streamit'); ?></span>
																		</div>
																		<div class="hover-buttons">
																			<a href="<?php echo esc_url($url_link); ?>" class="btn btn-hover iq-button">
																				<span><i class="fas fa-play mr-1" aria-hidden="true"></i><?php echo esc_html__('Play Now', 'streamit'); ?></span>
																			</a>
																		</div>
																	</div>
																	<div class="block-social-info">
																		<ul class="list-inline p-0 m-0 music-play-lists">
																			<?php if (isset($streamit_options['streamit_display_social_icons'])) {
																				if ($streamit_options['streamit_display_social_icons'] == 'yes') {
																			?>
																					<li class="share">
																						<span><i class="ri-share-fill"></i></span>
																						<div class="share-box">
																							<div class="d-flex align-items-center">
																								<a href="https://www.facebook.com/sharer?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-facebook-fill"></i></a>
																								<a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-twitter-fill"></i></a>
																								<a href="#" data-link='<?php the_permalink(); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
																							</div>
																						</div>
																					</li>
																			<?php }
																			} ?>
																			<?php if (isset($streamit_options['streamit_display_like']) && class_exists('wp_ulike')) {
																				if ($streamit_options['streamit_display_like'] == 'yes') {
																			?>
																					<li>
																						<div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="movie" id="' . get_the_ID() . '" style="wpulike-heart"]'); ?></div>
																					</li>
																			<?php }
																			} ?>
																			<li>
																				<?php
																				if (!is_user_logged_in()) {
																					if (isset($streamit_options['streamit_signin_link'])) {
																						$streamit_signin_link = $streamit_options['streamit_signin_link'];

																				?>
																						<a class="watch-list-not" href="<?php echo esc_url(site_url() . '/' . $streamit_signin_link) ?>">
																							<span><i class="ri-add-line"></i></span>
																						</a>
																					<?php }
																				} else {
																					?>
																					<a class="watch-list" rel="<?php echo get_the_ID(); ?>">
																						<?php
																						echo add_to_watchlist(get_the_ID());
																						?>
																					</a>
																				<?php } ?>
																			</li>
																		</ul>
																	</div>
																</div>
															</li>
														<?php } ?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
				<?php }
						}
					}
				} ?>
			</main><!-- #primary -->
		</div>
	</div>
</div>
<?php
get_footer();
