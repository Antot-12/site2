<?php

/**
 * Template part for displaying the header navigation menu
 *
 * @package streamit
 */

namespace Streamit\Utility;

if (!class_exists('ReduxFramework')) {
	return;
}
$streamit_options = get_option('streamit_options');

$get_avatar = get_template_directory_uri() . '/assets/images/redux/user.png';
if (is_user_logged_in()) {
	$current_user = wp_get_current_user();
	$get_avatar = get_the_author_meta('streamit_profile_image', $current_user->ID);
	if (empty($get_avatar)) {
		$get_avatar = get_avatar_url($current_user->ID);
	}
}
?>
<div class="iq-usermenu-dropdown">
	<ul class="d-flex align-items-center">
		<?php if (isset($streamit_options['display_search_icon_header']) && $streamit_options['display_search_icon_header'] == 'yes') {
		?>
			<li class="nav-item nav-icon header-search-right">
				<a href="javascript:void(0);" class="search-toggle device-search active" id="btn-search">
					<i class="ri-search-line"></i>
				</a>
				<div class="search-box iq-search-bar d-search">
					<?php get_search_form(); ?>
				</div>
			</li>
		<?php }
		if (isset($streamit_options['display_user_icon_header']) && $streamit_options['display_user_icon_header'] == 'yes') { ?>
			<li class="nav-item nav-icon header-user-rights">
				<a href="javascript:void(0);" class="iq-user-dropdown search-toggle p-0 d-flex align-items-center active" data-toggle="search-toggle" id="btn-user-list">
					<img src="<?php echo esc_url($get_avatar); ?>" class="img-fluid avatar-40 rounded-circle" alt="user">
				</a>
				<?php
				if (!is_user_logged_in()) { ?>

					<div class="iq-sub-dropdown iq-user-dropdown">
						<div class="iq-card shadow-none m-0">
							<div class="iq-card-body p-0 pl-3 pr-3">
								<?php
								if (isset($streamit_options['streamit_signin_link'])) {
									$streamit_signin_link = get_page_link($streamit_options['streamit_signin_link']);
									$streamit_signin_title = $streamit_options['streamit_signin_title']; ?>
									<a href="<?php echo esc_url($streamit_signin_link) ?>" class="iq-sub-card setting-dropdown">
										<div class="media align-items-center">
											<?php
											if (isset($streamit_options['streamit_signin_icon'])) {
												$streamit_signin_icons = $streamit_options['streamit_signin_icon'];
											}
											?>
											<div class="right-icon">
												<i class="<?php echo esc_attr($streamit_signin_icons); ?>"></i>
											</div>

											<div class="media-body ml-3">
												<h6 class="m-0">
													<?php
													if (!empty($streamit_signin_title)) {
														echo esc_html($streamit_signin_title);
													} else {
														echo esc_html__('Sign In', 'streamit');
													} ?>
												</h6>
											</div>
										</div>
									</a>
								<?php
								}
								if (isset($streamit_options['streamit_signup_link'])) {
									$streamit_signup_link = get_page_link($streamit_options['streamit_signup_link']);
									$streamit_signup_title = $streamit_options['streamit_signup_title'];
								?>
									<a href="<?php echo esc_url($streamit_signup_link) ?>" class="iq-sub-card setting-dropdown">
										<div class="media align-items-center">
											<?php
											if (isset($streamit_options['streamit_signup_icon'])) {
												$streamit_signup_icons = $streamit_options['streamit_signup_icon'];
											}
											?>
											<div class="right-icon">
												<i class="<?php echo esc_attr($streamit_signup_icons); ?>"></i>

											</div>

											<div class="media-body ml-3">
												<h6 class="m-0 ">
													<?php
													if (!empty($streamit_signup_title)) {
														echo esc_html($streamit_signup_title);
													} else {
														echo esc_html__('Sign Up', 'streamit');
													} ?>
												</h6>
											</div>
										</div>
									</a>
								<?php
								} ?>
							</div>
						</div>
					</div>
				<?php

				} else { ?>

					<div class="iq-sub-dropdown iq-user-dropdown">
						<div class="iq-card shadow-none m-0">
							<div class="iq-card-body p-0 pl-3 pr-3">
								<?php
								if (isset($streamit_options['streamit_profile_link'])) {
									$streamit_profile_link = get_page_link($streamit_options['streamit_profile_link']);
									$streamit_profile_title = $streamit_options['streamit_profile_title']; ?>
									<a href="<?php echo esc_url($streamit_profile_link) ?>" class="iq-sub-card setting-dropdown">
										<div class="media align-items-center">

											<?php
											if (isset($streamit_options['streamit_profile_icon'])) {
												$streamit_profile_icons = $streamit_options['streamit_profile_icon'];
											}
											?>
											<div class="right-icon">
												<i class="<?php echo esc_attr($streamit_profile_icons); ?>"></i>
											</div>

											<div class="media-body ml-3">
												<h6 class="m-0 ">
													<?php
													if (!empty($streamit_profile_title)) {
														echo esc_html($streamit_profile_title);
													} else {
														echo esc_html__('Profile', 'streamit');
													} ?>
												</h6>
											</div>
										</div>
									</a>
									<?php
								}
								if ($streamit_options['streamit_display_watchlist'] == 'yes') {

									if (isset($streamit_options['streamit_watchlist_link'])) {
										$streamit_profile_link = get_page_link($streamit_options['streamit_watchlist_link']);
										$streamit_profile_title = $streamit_options['streamit_watchlist_title']; ?>
										<a href="<?php echo esc_url($streamit_profile_link) ?>" class="iq-sub-card setting-dropdown">
											<div class="media align-items-center">

												<?php
												if (isset($streamit_options['streamit_watchlist_icon'])) {
													$streamit_watchlist_icons = $streamit_options['streamit_watchlist_icon'];
												}
												?>
												<div class="right-icon">
													<i class="<?php echo esc_attr($streamit_watchlist_icons); ?>"></i>
												</div>


												<div class="media-body ml-3">
													<h6 class="m-0 ">
														<?php
														if (!empty($streamit_profile_title)) {
															echo esc_html($streamit_profile_title);
														} else {
															echo esc_html__('Watchlist', 'streamit');
														} ?>
													</h6>
												</div>
											</div>
										</a>
								<?php
									}
								} ?>

								<a href="<?php echo wp_logout_url(home_url()); ?>" class="iq-sub-card setting-dropdown">
									<div class="media align-items-center">

										<?php
										$streamit_logout_icons = '';
										if (isset($streamit_options['streamit_logout_icon'])) {
											$streamit_logout_icons = $streamit_options['streamit_logout_icon'];
										}
										$streamit_logout_title = '';
										if (isset($streamit_options['streamit_logout_title'])) {
											$streamit_logout_title = $streamit_options['streamit_logout_title'];
										}
										?>
										<div class="right-icon">
											<i class="<?php echo esc_attr($streamit_logout_icons); ?>"></i>
										</div>

										<div class="media-body ml-3">
											<h6 class="m-0 "><?php echo esc_html($streamit_logout_title); ?></h6>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				<?php
				} ?>
			</li>
		<?php } ?>
	</ul>
</div>