<?php

/**
 * Streamit\Utility\Redux_Framework\Options\Page class
 *
 * @package streamit
 */

namespace Streamit\Utility\Redux_Framework\Options;

use Redux;
use Streamit\Utility\Redux_Framework\Component;

class Page extends Component
{

	public function __construct()
	{
		$this->set_widget_option();
	}

	protected function set_widget_option()
	{
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Page Settings', 'streamit'),
			'icon'  => 'el el-cog',
			'customizer_width' => '500px',
		));

		$icons = ["fa-500px", "fa-adjust", "fa-adn", "fa-align-center", "fa-align-justify", "fa-align-left", "fa-align-right", "fa-amazon", "fa-ambulance", "fa-american-sign-language-interpreting", "fa-anchor", "fa-android", "fa-angellist", "fa-angle-double-down", "fa-angle-double-left", "fa-angle-double-right", "fa-angle-double-up", "fa-angle-down", "fa-angle-left", "fa-angle-right", "fa-angle-up", "fa-apple", "fa-archive", "fa-area-chart", "fa-arrow-circle-down", "fa-arrow-circle-left", "fa-arrow-circle-o-down", "fa-arrow-circle-o-left", "fa-arrow-circle-o-right", "fa-arrow-circle-o-up", "fa-arrow-circle-right", "fa-arrow-circle-up", "fa-arrow-down", "fa-arrow-left", "fa-arrow-right", "fa-arrow-up", "fa-arrows", "fa-arrows-alt", "fa-arrows-h", "fa-arrows-v", "fa-assistive-listening-systems", "fa-asterisk", "fa-at", "fa-audio-description", "fa-backward", "fa-balance-scale", "fa-ban", "fa-bar-chart", "fa-barcode", "fa-bars", "fa-battery-empty", "fa-battery-full", "fa-battery-half", "fa-battery-quarter", "fa-battery-three-quarters", "fa-bed", "fa-beer", "fa-behance", "fa-behance-square", "fa-bell", "fa-bell-o", "fa-bell-slash", "fa-bell-slash-o", "fa-bicycle", "fa-binoculars", "fa-birthday-cake", "fa-bitbucket", "fa-bitbucket-square", "fa-black-tie", "fa-blind", "fa-bluetooth", "fa-bluetooth-b", "fa-bold", "fa-bolt", "fa-bomb", "fa-book", "fa-bookmark", "fa-bookmark-o", "fa-braille", "fa-briefcase", "fa-btc", "fa-bug", "fa-building", "fa-building-o", "fa-bullhorn", "fa-bullseye", "fa-bus", "fa-buysellads", "fa-calculator", "fa-calendar", "fa-calendar-check-o", "fa-calendar-minus-o", "fa-calendar-o", "fa-calendar-plus-o", "fa-calendar-times-o", "fa-camera", "fa-camera-retro", "fa-car", "fa-caret-down", "fa-caret-left", "fa-caret-right", "fa-caret-square-o-down", "fa-caret-square-o-left", "fa-caret-square-o-right", "fa-caret-square-o-up", "fa-caret-up", "fa-cart-arrow-down", "fa-cart-plus", "fa-cc", "fa-cc-amex", "fa-cc-diners-club", "fa-cc-discover", "fa-cc-jcb", "fa-cc-mastercard", "fa-cc-paypal", "fa-cc-stripe", "fa-cc-visa", "fa-certificate", "fa-chain-broken", "fa-check", "fa-check-circle", "fa-check-circle-o", "fa-check-square", "fa-check-square-o", "fa-chevron-circle-down", "fa-chevron-circle-left", "fa-chevron-circle-right", "fa-chevron-circle-up", "fa-chevron-down", "fa-chevron-left", "fa-chevron-right", "fa-chevron-up", "fa-child", "fa-chrome", "fa-circle", "fa-circle-o", "fa-circle-o-notch", "fa-circle-thin", "fa-clipboard", "fa-clock-o", "fa-clone", "fa-cloud", "fa-cloud-download", "fa-cloud-upload", "fa-code", "fa-code-fork", "fa-codepen", "fa-codiepie", "fa-coffee", "fa-cog", "fa-cogs", "fa-columns", "fa-comment", "fa-comment-o", "fa-commenting", "fa-commenting-o", "fa-comments", "fa-comments-o", "fa-compass", "fa-compress", "fa-connectdevelop", "fa-contao", "fa-copyright", "fa-creative-commons", "fa-credit-card", "fa-credit-card-alt", "fa-crop", "fa-crosshairs", "fa-css3", "fa-cube", "fa-cubes", "fa-cutlery", "fa-dashcube", "fa-database", "fa-deaf", "fa-delicious", "fa-desktop", "fa-deviantart", "fa-diamond", "fa-digg", "fa-dot-circle-o", "fa-download", "fa-dribbble", "fa-dropbox", "fa-drupal", "fa-edge", "fa-eject", "fa-ellipsis-h", "fa-ellipsis-v", "fa-empire", "fa-envelope", "fa-envelope-o", "fa-envelope-square", "fa-envira", "fa-eraser", "fa-eur", "fa-exchange", "fa-exclamation", "fa-exclamation-circle", "fa-exclamation-triangle", "fa-expand", "fa-expeditedssl", "fa-external-link", "fa-external-link-square", "fa-eye", "fa-eye-slash", "fa-eyedropper", "fa-facebook", "fa-facebook-official", "fa-facebook-square", "fa-fast-backward", "fa-fast-forward", "fa-fax", "fa-female", "fa-fighter-jet", "fa-file", "fa-file-archive-o", "fa-file-audio-o", "fa-file-code-o", "fa-file-excel-o", "fa-file-image-o", "fa-file-o", "fa-file-pdf-o", "fa-file-powerpoint-o", "fa-file-text", "fa-file-text-o", "fa-file-video-o", "fa-file-word-o", "fa-files-o", "fa-film", "fa-filter", "fa-fire", "fa-fire-extinguisher", "fa-firefox", "fa-first-order", "fa-flag", "fa-flag-checkered", "fa-flag-o", "fa-flask", "fa-flickr", "fa-floppy-o", "fa-folder", "fa-folder-o", "fa-folder-open", "fa-folder-open-o", "fa-font", "fa-font-awesome", "fa-fonticons", "fa-fort-awesome", "fa-forumbee", "fa-forward", "fa-foursquare", "fa-frown-o", "fa-futbol-o", "fa-gamepad", "fa-gavel", "fa-gbp", "fa-genderless", "fa-get-pocket", "fa-gg", "fa-gg-circle", "fa-gift", "fa-git", "fa-git-square", "fa-github", "fa-github-alt", "fa-github-square", "fa-gitlab", "fa-glass", "fa-glide", "fa-glide-g", "fa-globe", "fa-google", "fa-google-plus", "fa-google-plus-official", "fa-google-plus-square", "fa-google-wallet", "fa-graduation-cap", "fa-gratipay", "fa-h-square", "fa-hacker-news", "fa-hand-lizard-o", "fa-hand-o-down", "fa-hand-o-left", "fa-hand-o-right", "fa-hand-o-up", "fa-hand-paper-o", "fa-hand-peace-o", "fa-hand-pointer-o", "fa-hand-rock-o", "fa-hand-scissors-o", "fa-hand-spock-o", "fa-hashtag", "fa-hdd-o", "fa-header", "fa-headphones", "fa-heart", "fa-heart-o", "fa-heartbeat", "fa-history", "fa-home", "fa-hospital-o", "fa-hourglass", "fa-hourglass-end", "fa-hourglass-half", "fa-hourglass-o", "fa-hourglass-start", "fa-houzz", "fa-html5", "fa-i-cursor", "fa-ils", "fa-inbox", "fa-indent", "fa-industry", "fa-info", "fa-info-circle", "fa-inr", "fa-instagram", "fa-internet-explorer", "fa-ioxhost", "fa-italic", "fa-joomla", "fa-jpy", "fa-jsfiddle", "fa-key", "fa-keyboard-o", "fa-krw", "fa-language", "fa-laptop", "fa-lastfm", "fa-lastfm-square", "fa-leaf", "fa-leanpub", "fa-lemon-o", "fa-level-down", "fa-level-up", "fa-life-ring", "fa-lightbulb-o", "fa-line-chart", "fa-link", "fa-linkedin", "fa-linkedin-square", "fa-linux", "fa-list", "fa-list-alt", "fa-list-ol", "fa-list-ul", "fa-location-arrow", "fa-lock", "fa-long-arrow-down", "fa-long-arrow-left", "fa-long-arrow-right", "fa-long-arrow-up", "fa-low-vision", "fa-magic", "fa-magnet", "fa-male", "fa-map", "fa-map-marker", "fa-map-o", "fa-map-pin", "fa-map-signs", "fa-mars", "fa-mars-double", "fa-mars-stroke", "fa-mars-stroke-h", "fa-mars-stroke-v", "fa-maxcdn", "fa-meanpath", "fa-medium", "fa-medkit", "fa-meh-o", "fa-mercury", "fa-microphone", "fa-microphone-slash", "fa-minus", "fa-minus-circle", "fa-minus-square", "fa-minus-square-o", "fa-mixcloud", "fa-mobile", "fa-modx", "fa-money", "fa-moon-o", "fa-motorcycle", "fa-mouse-pointer", "fa-music", "fa-neuter", "fa-newspaper-o", "fa-object-group", "fa-object-ungroup", "fa-odnoklassniki", "fa-odnoklassniki-square", "fa-opencart", "fa-openid", "fa-opera", "fa-optin-monster", "fa-outdent", "fa-pagelines", "fa-paint-brush", "fa-paper-plane", "fa-paper-plane-o", "fa-paperclip", "fa-paragraph", "fa-pause", "fa-pause-circle", "fa-pause-circle-o", "fa-paw", "fa-paypal", "fa-pencil", "fa-pencil-square", "fa-pencil-square-o", "fa-percent", "fa-phone", "fa-phone-square", "fa-picture-o", "fa-pie-chart", "fa-pied-piper", "fa-pied-piper-alt", "fa-pied-piper-pp", "fa-pinterest", "fa-pinterest-p", "fa-pinterest-square", "fa-plane", "fa-play", "fa-play-circle", "fa-play-circle-o", "fa-plug", "fa-plus", "fa-plus-circle", "fa-plus-square", "fa-plus-square-o", "fa-power-off", "fa-print", "fa-product-hunt", "fa-puzzle-piece", "fa-qq", "fa-qrcode", "fa-question", "fa-question-circle", "fa-question-circle-o", "fa-quote-left", "fa-quote-right", "fa-random", "fa-rebel", "fa-recycle", "fa-reddit", "fa-reddit-alien", "fa-reddit-square", "fa-refresh", "fa-registered", "fa-renren", "fa-repeat", "fa-reply", "fa-reply-all", "fa-retweet", "fa-road", "fa-rocket", "fa-rss", "fa-rss-square", "fa-rub", "fa-safari", "fa-scissors", "fa-scribd", "fa-search", "fa-search-minus", "fa-search-plus", "fa-sellsy", "fa-server", "fa-share", "fa-share-alt", "fa-share-alt-square", "fa-share-square", "fa-share-square-o", "fa-shield", "fa-ship", "fa-shirtsinbulk", "fa-shopping-bag", "fa-shopping-basket", "fa-shopping-cart", "fa-sign-in", "fa-sign-language", "fa-sign-out", "fa-signal", "fa-simplybuilt", "fa-sitemap", "fa-skyatlas", "fa-skype", "fa-slack", "fa-sliders", "fa-slideshare", "fa-smile-o", "fa-snapchat", "fa-snapchat-ghost", "fa-snapchat-square", "fa-sort", "fa-sort-alpha-asc", "fa-sort-alpha-desc", "fa-sort-amount-asc", "fa-sort-amount-desc", "fa-sort-asc", "fa-sort-desc", "fa-sort-numeric-asc", "fa-sort-numeric-desc", "fa-soundcloud", "fa-space-shuttle", "fa-spinner", "fa-spoon", "fa-spotify", "fa-square", "fa-square-o", "fa-stack-exchange", "fa-stack-overflow", "fa-star", "fa-star-half", "fa-star-half-o", "fa-star-o", "fa-steam", "fa-steam-square", "fa-step-backward", "fa-step-forward", "fa-stethoscope", "fa-sticky-note", "fa-sticky-note-o", "fa-stop", "fa-stop-circle", "fa-stop-circle-o", "fa-street-view", "fa-strikethrough", "fa-stumbleupon", "fa-stumbleupon-circle", "fa-subscript", "fa-subway", "fa-suitcase", "fa-sun-o", "fa-superscript", "fa-table", "fa-tablet", "fa-tachometer", "fa-tag", "fa-tags", "fa-tasks", "fa-taxi", "fa-television", "fa-tencent-weibo", "fa-terminal", "fa-text-height", "fa-text-width", "fa-th", "fa-th-large", "fa-th-list", "fa-themeisle", "fa-thumb-tack", "fa-thumbs-down", "fa-thumbs-o-down", "fa-thumbs-o-up", "fa-thumbs-up", "fa-ticket", "fa-times", "fa-times-circle", "fa-times-circle-o", "fa-tint", "fa-toggle-off", "fa-toggle-on", "fa-trademark", "fa-train", "fa-transgender", "fa-transgender-alt", "fa-trash", "fa-trash-o", "fa-tree", "fa-trello", "fa-tripadvisor", "fa-trophy", "fa-truck", "fa-try", "fa-tty", "fa-tumblr", "fa-tumblr-square", "fa-twitch", "fa-twitter", "fa-twitter-square", "fa-umbrella", "fa-underline", "fa-undo", "fa-universal-access", "fa-university", "fa-unlock", "fa-unlock-alt", "fa-upload", "fa-usb", "fa-usd", "fa-user", "fa-user-md", "fa-user-plus", "fa-user-secret", "fa-user-times", "fa-users", "fa-venus", "fa-venus-double", "fa-venus-mars", "fa-viacoin", "fa-viadeo", "fa-viadeo-square", "fa-video-camera", "fa-vimeo", "fa-vimeo-square", "fa-vine", "fa-vk", "fa-volume-control-phone", "fa-volume-down", "fa-volume-off", "fa-volume-up", "fa-weibo", "fa-weixin", "fa-whatsapp", "fa-wheelchair", "fa-wheelchair-alt", "fa-wifi", "fa-wikipedia-w", "fa-windows", "fa-wordpress", "fa-wpbeginner", "fa-wpforms", "fa-wrench", "fa-xing", "fa-xing-square", "fa-y-combinator", "fa-yahoo", "fa-yelp", "fa-yoast", "fa-youtube", "fa-youtube-play", "fa-youtube-square"];

		$iconArray = [];

		foreach ($icons as $icon) {
			$iconArray['fas ' . $icon] = ucwords(str_replace('-', ' ', $icon));
		}
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Trailer Link', 'streamit'),
			'id'    => 'single-custom-post-trailer-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_display_trailer_link',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Trailer Link', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the trailer link details page', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('no', 'streamit')
				),

				array(
					'id'        => 'streamit_display_trailer_link_btn',
					'type'      => 'button_set',
					'options'   => array(
						'yes' => esc_html__('Default', 'streamit'),
						'no' => esc_html__('Thumbnail', 'streamit')
					),
					'title' => esc_html__('Select Style', 'streamit'),
					'default'   => 'yes',
					'required'  => array('streamit_display_trailer_link', '=', 'yes'),
				),

				array(
					'id'       => 'streamit_opt_multi_select',
					'type'     => 'select',
					'multi'    => true,
					'title'    => __('Select Post Type', 'streamit'),
					'subtitle' => __('Select specific Post to display the trailer link', 'streamit'),
					'options'  => array(
						'movie' => 'Movie',
						'tv_show' => 'Tv Show',
						'video' => 'Video',
						'episode' => 'Episode'
					),
					'default'  => array('movie', 'tv_show', 'video', 'episode'),
					'required'  => array('streamit_display_trailer_link', '=', 'yes'),
				),

				array(
					'id'       => 'streamit_trailer_link_icon',
					'type'     => 'select',
					'select2'  => array('containerCssClass' => 'fa'),
					'title'    => esc_html__('Trailer Link button Icon', 'streamit'),
					'width'     => '100%',
					'class'    => 'font-icons',
					'options'  => $iconArray,
					'default' => 'fas fa-play',
					'required'  => array('streamit_display_trailer_link', '=', 'yes'),
				),

				array(
					'id'        => 'streamit_trailer_link_text',
					'type'      => 'text',
					'title'     => esc_html__('Trailer Link Text', 'streamit'),
					'default'   => 'Trailer Link',
					'required'  => array('streamit_display_trailer_link', '=', 'yes'),
				),
			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Cast', 'streamit'),
			'id'    => 'single-custom-post-cast-options',
			'subsection' => true,
			'fields' => array(
				array(
					'id'        => 'streamit_display_cast',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Cast', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Cast ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),


				array(
					'id'        => 'streamit_cast_title',
					'type'      => 'text',
					'required'  => array('streamit_display_cast', '=', 'yes'),
					'title'     => esc_html__('Cast button title', 'streamit'),
					'default'   => 'Starring',
				),
			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Recommeded', 'streamit'),
			'id'    => 'single-custom-post-recommeded-options',
			'subsection' => true,
			'fields' => array(
				array(
					'id'        => 'streamit_display_recommended',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Recommended', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Recommended ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),


				array(
					'id'        => 'streamit_recommended_title',
					'type'      => 'text',
					'required'  => array('streamit_display_recommended', '=', 'yes'),
					'title'     => esc_html__('Recommended button title', 'streamit'),
					'default'   => 'Recommended',
				),

			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Related Videos', 'streamit'),
			'id'    => 'single-custom-post-related-video-options',
			'subsection' => true,
			'fields' => array(
				array(
					'id'        => 'streamit_display_related_video',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Related Videos', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Related Videos', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),


				array(
					'id'        => 'streamit_display_related_video_title',
					'type'      => 'text',
					'required'  => array('streamit_display_related_video', '=', 'yes'),
					'title'     => esc_html__('Related button title', 'streamit'),
					'default'   => 'Related Videos',
				),

			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Related Movies', 'streamit'),
			'id'    => 'single-custom-post-related-movie-options',
			'subsection' => true,
			'fields' => array(
				array(
					'id'        => 'streamit_display_related_movie',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Related Movies', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Related Movies', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),
		
		
				array(
					'id'        => 'streamit_display_related_movie_title',
					'type'      => 'text',
					'required'  => array('streamit_display_related_movie', '=', 'yes'),
					'title'     => esc_html__('Related button title', 'streamit'),
					'default'   => 'Related Movies',
				),
				array(
					'id'        => 'streamit_related_movies_all',
					'type'      => 'select',
					'title'     => esc_html__('Show All Related Movies', 'streamit'),
					'required'  => array(
						array('streamit_display_related_movie', 'equals', 'yes'),
					),
					'options'   => array(
						'all' => esc_html__('All', 'streamit'),
						'selected' => esc_html__('Selected', 'streamit')
					),
					'default'   => 'all'
				),
				array(
					'id'        => 'streamit_related_movies_selected',
					'type'      => 'select',
					'required'  => array(
						array('streamit_display_related_movie', '=', 'yes'),
						array('streamit_related_movies_all', '=', 'selected'),
					),
					'data'     => 'posts',
					'multi'    => true,
					'title'     => esc_html__('Select Movies For Related List', 'streamit'),
					'desc'      =>  esc_html__('Use Related movies on a page which you selected.(Note:If the movie is not selected then all the movies will appear)', 'streamit'),
					'args' => array(
						'post_type' => 'movie',
						'post_status' => 'publish',
						'posts_per_page' => '-1',
					),
				),
		
			)
		
		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Upcomming', 'streamit'),
			'id'    => 'single-custom-post-upcomming-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_display_upcoming',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Upcomming', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Upcoming ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),


				array(
					'id'        => 'streamit_upcoming_title',
					'type'      => 'text',
					'required'  => array('streamit_display_upcoming', '=', 'yes'),
					'title'     => esc_html__('Upcomming button title', 'streamit'),
					'default'   => 'Upcomming',
				),

				array(
					'id'        => 'streamit_upcoming_title',
					'type'      => 'text',
					'required'  => array('streamit_display_upcoming', '=', 'yes'),
					'title'     => esc_html__('Upcomming button title', 'streamit'),
					'default'   => 'Upcomming',
				),

				array(
					'id'       => 'streamit_upcoming_multi_select',
					'type'     => 'select',
					'multi'    => true,
					'title'    => __('Select Post Type', 'streamit'),
					'subtitle' => __('Select specific Post to display upcomming List', 'streamit'),
					'options'  => array(
						'movie' => 'Movie',
						'video' => 'Video'
					),
					'default'  => array('movie', 'video'),
					'required'  => array('streamit_display_upcoming', '=', 'yes'),
				),


				array(
					'id'        => 'streamit_upcoming_movies_all',
					'type'      => 'select',
					'title'     => esc_html__('Show All Upcomming Movies', 'streamit'),
					'required'  => array(
						array('streamit_display_upcoming', 'equals', 'yes'),
						array('streamit_upcoming_multi_select', 'equals', 'movie'),
					),
					'options'   => array(
						'all' => esc_html__('All', 'streamit'),
						'selected' => esc_html__('Selected', 'streamit')
					),
					'default'   => 'all'
				),


				array(
					'id'        => 'streamit_upcoming_movies_selected',
					'type'      => 'select',
					'required'  => array(
						array('streamit_display_upcoming', 'equals', 'yes'),
						array('streamit_upcoming_movies_all', 'equals', 'selected'),
					),
					'data'     => 'posts',
					'multi'    => true,
					'title'     => esc_html__('Select Movies For Upcomming List', 'streamit'),
					'desc'      =>  esc_html__('Use upcomming movies on a page which you selected.(Note:If the movie is not selected then all the movies will appear)', 'streamit'),
					'args' => array(
						'post_type' => 'movie',
						'post_status' => 'publish',
						'posts_per_page' => '-1',
					),
				),

				array(
					'id'        => 'streamit_upcoming_videos_all',
					'type'      => 'select',
					'title'     => esc_html__('Show All Upcomming Videos', 'streamit'),
					'required'  => array(
						array('streamit_display_upcoming', 'equals', 'yes'),
						array('streamit_upcoming_multi_select', 'equals', 'video'),
					),
					'options'   => array(
						'all' => esc_html__('All', 'streamit'),
						'selected' => esc_html__('Selected', 'streamit')
					),
					'default'   => 'all'
				),


				array(
					'id'        => 'streamit_upcoming_videos_selected',
					'type'      => 'select',
					'required'  => array(
						array('streamit_display_upcoming', 'equals', 'yes'),
						array('streamit_upcoming_videos_all', 'equals', 'selected'),
					),
					'data'     => 'posts',
					'multi'    => true,
					'title'     => esc_html__('Select Videos For Upcomming List', 'streamit'),
					'desc'      =>  esc_html__('Use upcomming videos on a page which you selected.(Note:If the video is not selected then all the videos will appear)', 'streamit'),
					'args' => array(
						'post_type' => 'video',
						'post_status' => 'publish',
						'posts_per_page' => '-1',
					),
				),
			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Latest Episodes', 'streamit'),
			'id'    => 'single-custom-post-latest-episode-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_display_latest_episode',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Latest Episodes', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Latest Episodes ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => 'yes'
				),


				array(
					'id'        => 'streamit_latest_episodes_title',
					'type'      => 'text',
					'required'  => array('streamit_display_latest_episode', '=', 'yes'),
					'title'     => esc_html__('Latest Episodes button title', 'streamit'),
					'default'   => 'Latest Episodes',
				),

			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Comments', 'streamit'),
			'id'    => 'single-custom-post-comments-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_movie_display_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Movie Comments', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Comments ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),

				array(
					'id'        => 'streamit_tvshow_display_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Tv-Show Comments', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Comments ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('no', 'streamit')
				),

				array(
					'id'        => 'streamit_episode_display_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Episode Comments', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Comments ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),

				array(
					'id'        => 'streamit_video_display_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Video Comments', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Comments ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),

			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Starring/Genres/Tags', 'streamit'),
			'id'    => 'custom-text-custom-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_starring_title',
					'type'      => 'text',
					'title'     => esc_html__('Starring', 'streamit'),
					'default' => esc_html__('Starring', 'streamit')
				),

				array(
					'id'        => 'streamit_genres_title',
					'type'      => 'text',
					'title'     => esc_html__('Genres title', 'streamit'),
					'default' => esc_html__('Genres', 'streamit')
				),


				array(
					'id'        => 'streamit_tag_title',
					'type'      => 'text',
					'title'     => esc_html__('Tag title', 'streamit'),
					'default' => esc_html__('Tags', 'streamit')
				),
				array(
					'id'        => 'streamit_display_tag',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Tags ', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Tags ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit')
				),

				array(
					'id'        => 'streamit_genere_tag_category_item',
					'type'      => 'button_set',
					'title'     => esc_html__('Genres, Tags , Categories Page Setting', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Post ', 'streamit'),
					'options'   => array(
						'load_more' => esc_html__('Load More', 'streamit'),
						'infinite_scroll' => esc_html__('Infinite Scroll', 'streamit')
					),
					'default'=> esc_html__('load_more','streamit'),

				),

				array(
					'id'        => 'streamit_genere_tag_category_display_loadmore_text',
					'type'      => 'text',
					'title'     => esc_html__('Load More button text', 'streamit'),
					'default'   => esc_html__('Load More', 'streamit'),
					'required'  => array('streamit_genere_tag_category_item', '=', 'load_more'),
				),
				array(
					'id'        => 'streamit_genere_tag_category_loadmore_text_2',
					'type'      => 'text',
					'title'     => esc_html__('Load More button text', 'streamit'),
					'default'   => esc_html__('Loading...', 'streamit'),
					'required'  => array('streamit_genere_tag_category_item', '=', 'load_more'),
				),
				array(
					'id'        => 'streamit_genere_tag_category_post_per_page',
					'type'      => 'text',
					'title'     => esc_html__('Item Per Page', 'streamit'),
					'default'   => '12',
				),


			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Big Heading Texture', 'streamit'),
			'id'    => 'custom-text-bigheading-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'       => 'streamit_big_heading_title_bg_type',
					'type'     => 'button_set',
					'title'    => esc_html__('Set Heading Texture Background Type', 'streamit'),
					'options'  => array(
						'1' => 'Color',
						'2' => 'Image',
					),
					'default'  => '2'
				),

				array(
					'id'       => 'streamit_big_heading_title_banner_image',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__('Set Heading Texture Image', 'streamit'),
					'read-only' => false,
					'required'  => array('streamit_big_heading_title_bg_type', '=', '2'),
					'subtitle' => esc_html__('Upload Image for your heading texture background.', 'streamit'),
					'default'  => array('url' => get_template_directory_uri() . '/assets/images/redux/texure.jpg'),
				),

				array(
					'id'            => 'streamit_big_heading_title_bg_color',
					'type'          => 'color',
					'title'         => esc_html__('Set Heading Texture Color', 'streamit'),
					'required'  => array('streamit_big_heading_title_bg_type', '=', '1'),
					'mode'          => 'background',
					'transparent'   => false,
					'default' => '#fff'
				),

			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Rating / Play Button', 'streamit'),
			'id'    => 'custom-text-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id'        => 'streamit_imdb_display_rating',
					'type'      => 'button_set',
					'title'     => esc_html__('Display IMDB Rating Out Of 10', 'streamit'),
					'subtitle' => esc_html__('Turn on to display IMDB rating Out of 10 ', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('no', 'streamit')
				),

				array(
					'id'        => 'streamit_display_single_star',
					'type'      => 'button_set',
					'title'     => esc_html__('Display Single Star', 'streamit'),
					'subtitle' => esc_html__('Turn on to display single star', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('On', 'streamit'),
						'no' => esc_html__('Off', 'streamit')
					),
					'default'   => esc_html('yes', 'streamit'),
					'required'  => array('streamit_imdb_display_rating', '=', 'yes'),
				),
				array(
					'id'        => 'streamit_play_btn_text',
					'type'      => 'text',
					'title'     => esc_html__('Play Button Text', 'streamit'),
					'subtitle' => esc_html__('Enter Text For Changing Button Text In Inner Page  ', 'streamit'),
					'default'   => __('Play Now', 'streamit'),
				),
				
			)

		));
		Redux::set_section($this->opt_name, array(
			'title' => esc_html__('Person/Cast Detail Page', 'streamit'),
			'id'    => 'cast-page-options',
			'subsection' => true,
			'fields' => array(

				array(
					'id' => 'streamit_cast_most_viewer_section',
					'type' => 'section',
					'title' =>  esc_html__('Most Viewer', 'streamit'),
					'indent' => true
				),

				array(
					'id'        => 'streamit_show_cast_most_viewer',
					'type'      => 'button_set',
					'title'     => esc_html__('Show List', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the most viewer post', 'streamit'),
					'options'   => array(
						'yes' => esc_html__('yes', 'streamit'),
						'no' => esc_html__('No', 'streamit'),
					),
					'default'   => 'yes',
				),

				array(
					'id'        => 'streamit_cast_most_viewer',
					'type'      => 'text',
					'title'     => esc_html__('Heading', 'streamit'),
					'default'   => __('Most Viewer', 'streamit'),
					'required'  => array('streamit_show_cast_most_viewer', '=', 'yes'),
				),

				array(
					'id' => 'streamit_related_cast_section',
					'type' => 'section',
					'title' =>  esc_html__('Related Cast', 'streamit'),
					'indent' => true
				),

				array(
					'id'        => 'streamit_cast_related_post_title',
					'type'      => 'text',
					'title'     => esc_html__('Heading', 'streamit'),
					'default'   => __('Acting', 'streamit'),
				),
				array(
					'id'        => 'streamit_cast_use_infinite_scroll',
					'type'      => 'button_set',
					'title'     => esc_html__('Show Infinite Scroll', 'streamit'),
					'subtitle' => esc_html__('Turn on to display the Infinite Scroll', 'streamit'),
					'options'   => array(
						'infinite_scroll' => esc_html__('yes', 'streamit'),
						'no' => esc_html__('No', 'streamit'),
					),
					'default'   => 'infinite_scroll',
				),
			)

		));
	}
}
