<?php

/**
 * Streamit\Utility\Comments\Component class
 *
 * @package streamit
 */

namespace Streamit\Utility\Common;

use Streamit\Utility\Component_Interface;
use Streamit\Utility\Templating_Component_Interface;
use function add_action;

/**
 * Class for managing comments UI.
 *
 * Exposes template tags:
 * * `streamit()->the_comments( array $args = array() )`
 *
 * @link https://wordpress.org/plugins/amp/
 */
class Component implements Component_Interface, Templating_Component_Interface
{
	/**
	 * Gets the unique identifier for the theme component.
	 *
	 * @return string Component slug.
	 */
	public function get_slug(): string
	{
		return 'common';
	}

	/**
	 * Adds the action and filter hooks to integrate with WordPress.
	 */
	public function initialize()
	{
		add_filter('widget_tag_cloud_args', array($this, 'streamit_widget_tag_cloud_args'), 100);
		add_filter('wp_list_categories', array($this, 'streamit_categories_postcount_filter'), 100);
		add_filter('get_archives_link', array($this, 'streamit_style_the_archive_count'), 100);
		add_filter('get_the_archive_title_prefix', '__return_false');
		add_filter('upload_mimes', array($this, 'streamit_mime_types'), 100);
		add_action('wp_enqueue_scripts', array($this, 'streamit_remove_wp_block_library_css'), 100);
		add_action('wp_enqueue_scripts', array($this, 'streamit_remove_wp_block_library_css'), 100);
		add_action('wp_enqueue_scripts', array($this, 'streamit_remove_wp_block_library_css'), 100);
		add_filter('pre_get_posts', array($this, 'streamit_searchfilter'), 100);
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		));
		add_action('admin_notices',  array($this, 'streamit_latest_version_announcement'));
		add_action('admin_enqueue_scripts', array($this, 'wpdocs_selectively_enqueue_admin_script'));
		add_action('wp_ajax_streamit_dismiss_notice', array($this, 'streamit_dismiss_notice'), 10);
	}

	public function __construct()
	{
		add_filter('the_content', array($this, 'streamit_remove_empty_p'));
		add_filter('get_the_content', array($this, 'streamit_remove_empty_p'));
		add_filter('get_the_excerpt', array($this, 'streamit_remove_empty_p'));
		add_filter('the_excerpt', array($this, 'streamit_remove_empty_p'));
	}

	/**
	 * Gets template tags to expose as methods on the Template_Tags class instance, accessible through `streamit()`.
	 *
	 * @return array Associative array of $method_name => $callback_info pairs. Each $callback_info must either be
	 *               a callable or an array with key 'callable'. This approach is used to reserve the possibility of
	 *               adding support for further arguments in the future.
	 */
	public function template_tags(): array
	{
		return array(
			'streamit_pagination' 		=> array($this, 'streamit_pagination'),
			'streamit_inner_breadcrumb' 	=> array($this, 'streamit_inner_breadcrumb'),
			'streamit_get_embed_video' 	=> array($this, 'streamit_get_embed_video'),
			'streamit_get_svg' 			=> array($this, 'streamit_get_svg'),
		);
	}

	//return svg content or else image tag
	function streamit_get_svg($file, $class = "", $alt = "streamit")
	{
		global $wp_filesystem;
		$content =   '';

		require_once(ABSPATH . '/wp-admin/includes/file.php');
		WP_Filesystem();
		if ("svg" == wp_check_filetype($file)["ext"]) {
			$content = $wp_filesystem->get_contents($file);
		} else {
			$content = '<img class="' . esc_attr($class) . '" src="' . esc_url($file) . '" alt="' . esc_attr($alt) . '">';
		}
		return $content;
	}

	function streamit_get_embed_video($post_id)
	{
		$post = get_post($post_id);
		$content = do_shortcode(apply_filters('the_content', $post->post_content));
		$embeds = get_media_embedded_in_content($content);
		if (!empty($embeds)) {
			foreach ($embeds as $embed) {
				if (strpos($embed, 'video') || strpos($embed, 'youtube') || strpos($embed, 'vimeo') || strpos($embed, 'dailymotion') || strpos($embed, 'vine') || strpos($embed, 'wordPress.tv') || strpos($embed, 'embed') || strpos($embed, 'audio') || strpos($embed, 'iframe') || strpos($embed, 'object')) {
					return $embed;
				}
			}
		} else {
			return;
		}
	}

	function streamit_remove_empty_p($string)
	{
		return preg_replace('/<p>(?:\s|&nbsp;)*?<\/p>/i', '', $string);
	}

	function streamit_remove_wp_block_library_css()
	{
		wp_dequeue_style('wp-block-library-theme');
	}

	public function streamit_widget_tag_cloud_args($args)
	{
		$args['largest'] = 1;
		$args['smallest'] = 1;
		$args['unit'] = 'em';
		$args['format'] = 'list';

		return $args;
	}
	function streamit_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	function streamit_categories_postcount_filter($variable)
	{
		$variable = str_replace('(', '<span class="post_count"> (', $variable);
		$variable = str_replace(')', ') </span>', $variable);
		return $variable;
	}

	function streamit_style_the_archive_count($links)
	{
		$links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount"> (', $links);
		$links = str_replace('&nbsp;)</li>', ' </li></span>', $links);
		return $links;
	}

	public function streamit_pagination($numpages = '', $pagerange = '', $paged = '')
	{
		if (empty($pagerange)) {
			$pagerange = 2;
		}
		global $paged;
		if (empty($paged)) {
			$paged = 1;
		}
		if ($numpages == '') {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if (!$numpages) {
				$numpages = 1;
			}
		}
		/**
		 * We construct the pagination arguments to enter into our paginate_links
		 * function.
		 */
		$pagination_args = array(
			'format' => '?paged=%#%',
			'total' => $numpages,
			'current' => $paged,
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => $pagerange,
			'prev_next' => true,
			'prev_text'       => '<i class="fas fa-chevron-left"></i>',
			'next_text'       => '<i class="fas fa-chevron-right"></i>',
			'type' => 'list',
			'add_args' => false,
			'add_fragment' => ''
		);

		$paginate_links = paginate_links($pagination_args);
		if ($paginate_links) {
			echo '<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="pagination justify-content-center">
								<nav aria-label="Page navigation">';
			printf(esc_html__('%s', 'streamit'), $paginate_links);
			echo '</nav>
					</div>
				</div>';
		}
	}

	public function streamit_inner_breadcrumb()
	{
		$streamit_options = get_option('streamit_options');
		$breadcrumb_style = '';
		if (!is_front_page() && !is_singular('person') && !is_singular('video') && !is_singular('tv_show') && !is_singular('movie') && !is_singular('episode') && !is_404()) { ?>
			<div class="iq-breadcrumb-one">
				<div class="container-fluid">
					<?php
					if (!empty($streamit_options['bg_image'])) {
						$breadcrumb_style = $streamit_options['bg_image'];
					}
					if (class_exists('ReduxFramework') && $breadcrumb_style == '1') {    ?>
						<div class="row align-items-center justify-content-center text-center">
							<div class="col-sm-12">
								<nav aria-label="breadcrumb" class="text-center iq-breadcrumb-two">
									<?php
									$this->streamit_breadcrumbs_title();
									if (isset($streamit_options['display_breadcrumbs'])) {
										$display_breadcrumb = $streamit_options['display_breadcrumbs'];
										if ($display_breadcrumb == "yes") {
									?>
											<ol class="breadcrumb main-bg">
												<?php $this->streamit_custom_breadcrumbs(); ?>
											</ol>
									<?php
										}
									}
									?>
								</nav>

							</div>
						</div>
					<?php } elseif (class_exists('ReduxFramework') && $breadcrumb_style == '2') { ?>

						<div class="row align-items-center">
							<div class="col-lg-8 col-md-8 text-left align-self-center">
								<nav aria-label="breadcrumb" class="text-left">
									<?php
									$this->streamit_breadcrumbs_title();
									if (isset($streamit_options['display_breadcrumbs'])) {
										$display_breadcrumb = $streamit_options['display_breadcrumbs'];
										if ($display_breadcrumb == "yes") { ?>
											<ol class="breadcrumb main-bg">
												<?php $this->streamit_custom_breadcrumbs(); ?>
											</ol>
									<?php
										}
									} ?>
								</nav>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 text-right wow fadeInRight">
								<?php $this->streamit_breadcrumbs_feature_image(); ?>
							</div>
						</div>
					<?php } elseif (class_exists('ReduxFramework') && $breadcrumb_style == '3') { ?>

						<div class="row align-items-center">
							<div class="col-lg-4 col-md-4 col-sm-12 wow fadeInLeft">
								<?php $this->streamit_breadcrumbs_feature_image(); ?>
							</div>
							<div class="col-lg-8 col-md-8 text-left align-self-center">
								<nav aria-label="breadcrumb" class="text-right streamit-breadcrumb-nav">
									<?php
									$this->streamit_breadcrumbs_title();
									if (isset($streamit_options['display_breadcrumbs'])) {
										$display_breadcrumb = $streamit_options['display_breadcrumbs'];
										if ($display_breadcrumb == "yes") { ?>
											<ol class="breadcrumb main-bg justify-content-end">
												<?php $this->streamit_custom_breadcrumbs(); ?>
											</ol>
									<?php
										}
									}
									?>
								</nav>
							</div>
						</div>
					<?php } elseif (class_exists('ReduxFramework') && $breadcrumb_style == '4') { ?>

						<div class="row align-items-center iq-breadcrumb-three">
							<div class="col-sm-6 mb-3 mb-lg-0 mb-md-0">
								<?php $this->streamit_breadcrumbs_title(); ?>
							</div>
							<div class="col-sm-6 ext-lg-right text-md-right text-sm-left">
								<nav aria-label="breadcrumb" class="iq-breadcrumb-two">
									<?php
									if (isset($streamit_options['display_breadcrumbs'])) {
										$display_breadcrumb = $streamit_options['display_breadcrumbs'];
										if ($display_breadcrumb == "yes") {
									?>
											<ol class="breadcrumb main-bg justify-content-end">
												<?php $this->streamit_custom_breadcrumbs(); ?>
											</ol>
									<?php
										}
									} ?>
								</nav>
							</div>
						</div>
					<?php } elseif (class_exists('ReduxFramework') && $breadcrumb_style == '5') { ?>

						<div class="row align-items-center iq-breadcrumb-three">
							<div class="col-sm-6 mb-3 mb-lg-0 mb-md-0">
								<nav aria-label="breadcrumb" class="text-left iq-breadcrumb-two">
									<?php
									if (isset($streamit_options['display_breadcrumbs'])) {
										$display_breadcrumb = $streamit_options['display_breadcrumbs'];
										if ($display_breadcrumb == "yes") {
									?>
											<ol class="breadcrumb main-bg justify-content-start">
												<?php $this->streamit_custom_breadcrumbs(); ?>
											</ol>
									<?php
										}
									}
									?>
								</nav>
							</div>
							<div class="col-sm-6 text-right">
								<?php $this->streamit_breadcrumbs_title(); ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="row align-items-center">
							<div class="col-sm-12">
								<nav aria-label="breadcrumb" class="text-center">
									<?php $this->streamit_breadcrumbs_title(); ?>
									<ol class="breadcrumb main-bg">
										<?php $this->streamit_custom_breadcrumbs(); ?>
									</ol>
								</nav>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php
		}
	}

	function streamit_breadcrumbs_title()
	{

		$streamit_options = get_option('streamit_options');
		$title_tag = 'h2';
		$title = '';
		if (isset($streamit_options['breadcum_title_tag']) && !empty($streamit_options['breadcum_title_tag'])) {
			$title_tag = $streamit_options['breadcum_title_tag'];
		}

		if (is_archive()) {
			$title = get_the_archive_title();
		} elseif (is_search()) {
			$title = esc_html__('Search', 'streamit');
		} elseif (is_404()) {
			if (isset($streamit_options['streamit_fourzerofour_title'])) {
				$title = $streamit_options['streamit_fourzerofour_title'];
			} else {
				$title = __('Oops! That page can not be found.', 'streamit');
			}
		} elseif (is_home()) {
			$title = wp_title('', false);
		} else {
			$title = get_the_title();
		}
		if (!empty(trim($title))) :
		?>
			<<?php echo esc_attr($title_tag); ?> class="title">
				<?php echo wp_kses($title, array(['span' => array()])); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php
		endif;
	}

	function streamit_breadcrumbs_feature_image()
	{
		$streamit_options = get_option('streamit_options');
		$bnurl = '';
		$page_id = get_queried_object_id();
		if (has_post_thumbnail($page_id) && !is_single()) {
			$image_array = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'full');
			$bnurl = $image_array[0];
		} elseif (is_404()) {
			if (!empty($streamit_options['streamit_404_banner_image']['url'])) {
				$bnurl = $streamit_options['streamit_404_banner_image']['url'];
			}
		} elseif (is_home()) {
			if (!empty($streamit_options['streamit_blog_banner_image']['url'])) {
				$bnurl = $streamit_options['streamit_blog_banner_image']['url'];
			}
		} else {
			if (!empty($streamit_options['streamit_page_banner_image']['url'])) {
				$bnurl = $streamit_options['streamit_page_banner_image']['url'];
			}
		}

		if (!empty($bnurl)) {
			$img_pos = "";
			if (!empty($streamit_options['bg_image']) && !$streamit_options['bg_image'] == 1) {
				$img_pos = 'float-right';
			}
		?>
			<img src="<?php echo esc_url($bnurl); ?>" class="img-fluid <?php echo esc_attr($img_pos) ?>" alt="<?php esc_attr_e('banner', 'streamit'); ?>">
		<?php
		}
	}
	function streamit_custom_breadcrumbs()
	{

		$show_on_home = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$home = '' . esc_html__('Home', 'streamit') . ''; // text for the 'Home' link
		$show_current = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

		global $post;
		$home_link = esc_url(home_url());

		if (is_front_page()) {

			if ($show_on_home == 1) echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li>';
		} else {
			echo '<li class="breadcrumb-item"><a href="' . $home_link . '">' . $home . '</a></li> ';
			if (is_home()) {
				echo  '<li class="breadcrumb-item active">' . esc_html__('Blogs', 'streamit') . '</li>';
			} elseif (is_category()) {
				$this_cat = get_category(get_query_var('cat'), false);
				if ($this_cat->parent != 0) echo '<li class="breadcrumb-item">' . get_category_parents($this_cat->parent, TRUE, '  ') . '</li>';
				echo  '<li class="breadcrumb-item active">' . esc_html__('Archive by category : ', 'streamit') . ' "' . single_cat_title('', false) . '" </li>';
			} elseif (is_search()) {
				echo  '<li class="breadcrumb-item active">' . esc_html__('Search results for : ', 'streamit') . ' "' . get_search_query() . '"</li>';
			} elseif (is_day()) {
				echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo '<li class="breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>  ';
				echo  '<li class="breadcrumb-item active">' . get_the_time('d') . '</li>';
			} elseif (is_month()) {
				echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo  '<li class="breadcrumb-item active">' . get_the_time('F') . '</li>';
			} elseif (is_year()) {
				echo  '<li class="breadcrumb-item active">' . get_the_time('Y') . '</li>';
			} elseif (is_single() && !is_attachment()) {
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if (!empty($slug)) {
						echo '<li class="breadcrumb-item"><a href="' . $home_link . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
					}
					if ($show_current == 1) echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
				} else {
					$cat = get_the_category();
					if (!empty($cat)) {
						$cat = $cat[0];

						if ($show_current == 0) $cat = preg_replace("#^(.+)\s\s$#", "$1", $cat);
						echo '<li class="breadcrumb-item">' . get_category_parents($cat, TRUE, '  ') . '</li>';
						if (!empty(get_the_title())) {
							if ($show_current == 1) echo  '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
						}
					}
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
				$post_type = get_post_type_object(get_post_type());
				if (!empty($post_type->labels->singular_name)) {
					echo  '<li class="breadcrumb-item active">' . $post_type->labels->singular_name . '</li>';
				}
			} elseif (!is_single() && is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				$cat = $cat[0];
				echo '<li class="breadcrumb-item">' . get_category_parents($cat, TRUE, '  ') . '</li>';
				echo '<li class="breadcrumb-item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
				if ($show_current == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title() . '</li>';
			} elseif (is_page() && !$post->post_parent) {
				if ($show_current == 1) echo  '<li class="breadcrumb-item active">' . get_the_title() . '</li>';
			} elseif (is_page() && $post->post_parent) {
				$trail = '';
				// $page_title = '<li class="breadcrumb-item">' . get_the_title($post->ID) . '</li>';
				if ($post->post_parent) {
					$parent_id = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_post($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) $trail .= $crumb;
				}

				echo wp_kses($trail, ["li" => ["class" => true], "a" => ["href" => true]]);
				if ($show_current == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title() . '</li>';
			} elseif (is_tag()) {
				echo  '<li class="breadcrumb-item active">' . esc_html__('Posts tagged', 'streamit') . ' "' . single_tag_title('', false) . '"</li>';
			} elseif (is_author()) {
				global $author;
				$userdata = get_userdata($author);
				echo  '<li class="breadcrumb-item active">' . esc_html__('Articles posted by : ', 'streamit') . ' ' . $userdata->display_name . '</li>';
			} elseif (is_404()) {
				echo  '<li class="breadcrumb-item active">' . esc_html__('Error 404', 'streamit') . '</li>';
			}

			if (get_query_var('paged')) {
				echo '<li class="breadcrumb-item active">' . esc_html__('Page', 'streamit') . ' ' . get_query_var('paged') . '</li>';
			}
		}
	}

	function streamit_searchfilter($query)
	{
		if (!is_admin()) {
			if ($query->is_search) {
				$query->set('post_type', array('movie', 'tv_show', 'episode', 'video', 'post'));
			}
			return $query;
		}
	}
	public function streamit_latest_version_announcement()
	{
		global $current_user;
		$user_id = $current_user->ID;
		if (!get_user_meta($user_id, 'streamit_notification_5_0_0')) { ?>
			<div class="notice notice-error streamit-notice  is-dismissible" id="streamit_notification_5_0_0">
				<div class="streamit-notice-main-box d-flex">
					<div class="streamit-notice-logo-push">
						<span><img  src="<?php echo esc_url(get_template_directory_uri());  ?>/assets/images/redux/options.png"> </span>
					</div>
					<div class="streamit-notice-message">
						<h3 style="color:red;"><?php esc_html_e('Attention!! Streamit v2.0.0 Is Here!', 'streamit'); ?></h3>
						<div class="streamit-notice-message-inner">
							<strong class="text-bold "><?php esc_html_e('Streamit Extensions Plugin Needs update.', 'streamit'); ?>&nbsp;&nbsp;
							<a class="" href="<?php echo esc_url('https://assets.iqonic.design/documentation/wordpress/streamit-doc/index.html#update-plugin' ,'streamit') ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html('Click Here - How To Update Plugin','streamit') ?></a></strong>
						</div>
					</div>
				</div>
				<div class="streamit-notice-cta">
					<button class="streamit-notice-dismiss streamit-dismiss-welcome notice-dismiss" data-msg="streamit_notification_5_0_0"><span class="screen-reader-text"><?php esc_html_e('Dismiss', 'streamit'); ?></span></button>
				</div>
			</div>
		<?php }
	}
	public function wpdocs_selectively_enqueue_admin_script()
	{
		wp_enqueue_script('admin-custom', get_template_directory_uri() . '/assets/js/admin-custom.min.js', array());
		wp_enqueue_style('admin-custom', get_template_directory_uri() . '/assets/css/admin-custom.min.css');
	}
	public 	function streamit_dismiss_notice()
	{
		global $current_user;
		$user_id = $current_user->ID;
		if (!empty($_POST['action']) && $_POST['action'] == 'streamit_dismiss_notice') {

			add_user_meta($user_id, 'streamit_notification_5_0_0', 'true', true);
			wp_send_json_success();
		}
	}
}
