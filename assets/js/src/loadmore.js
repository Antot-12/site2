(function (jQuery) {

	jQuery(document).ready(function () {

		let streamit_options = jQuery('.streamit_datapass').data('options');
		let streamit_options_blog = jQuery('.streamit_datapass_blog').data('options');
		let streamit_option_achive = jQuery('.watchlist-contens').data('options');



		if (streamit_options == "load_more") {
			jQuery('.streamit_loadmore_btn').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let button = jQuery(this),
					data = {
						'action': 'loadmore',
						'query': streamit_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': streamit_loadmore_params.current_page
					};
				jQuery.ajax({ // you can also use jQuery.post here
					url: streamit_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).prev('div').append(data); // insert new posts
							streamit_loadmore_params.current_page++;

							if (streamit_loadmore_params.current_page == streamit_loadmore_params.max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});
		}
		if (streamit_options_blog == "load_more") {
			//** blog load more *//
			jQuery('.streamit_loadmore_btn_blog').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let button = jQuery(this),
					data = {
						'action': 'loadmore_blog',
						'query': streamit_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': streamit_loadmore_params.current_page
					};

				jQuery.ajax({ // you can also use jQuery.post here
					url: streamit_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).parent().find('.streamit-blog-main-list').append(data); // insert new posts
							streamit_loadmore_params.current_page++;

							if (streamit_loadmore_params.current_page == streamit_loadmore_params.max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});

		}

		if (streamit_option_achive == "load_more") {
			jQuery('.streamit_loadmore_btn').click(function () {
				let button_load = jQuery(this).attr('data-loading-text');
				let button_text = jQuery(this).text();
				let max_page = jQuery('.watchlist-contens').data('pages');
				let button = jQuery(this),
					data = {
						'action': 'loadmore_archive',
						'query': streamit_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': streamit_loadmore_params.current_page,
						'availablepost': jQuery('.watchlist-contens').data('displaypost'),
					};
				jQuery.ajax({ // you can also use jQuery.post here
					url: streamit_loadmore_params.ajaxurl, // AJAX handler
					data: data,
					type: 'POST',
					beforeSend: function (xhr) {
						button.text(button_load); // change the button text, you can also add a preloader image
					},
					success: function (data) {
						if (data) {
							button.text(button_text).prev('div').append(data); // insert new posts
							streamit_loadmore_params.current_page++;

							if (streamit_loadmore_params.current_page == max_page)
								button.remove(); // if last page, remove the button

						} else {
							button.remove(); // if no data, remove the button as well
						}
					}
				});
			});
		}
	});

	jQuery(function (jQuery) {

		let canBeLoaded = true,
			bottomOffset = 2000; // the distance (in px) from the page bottom when you want to load more posts

		let streamit_options = jQuery('.streamit_datapass').data('options');
		let streamit_options_blog = jQuery('.streamit_datapass_blog').data('options');
		let streamit_option_archive = jQuery('.streamit_datapass_archive').data('options')
		if (streamit_options == "infinite_scroll") {

			jQuery(window).scroll(function () {
				let data = {
					'action': 'loadmore',
					'query': streamit_loadmore_params.posts,
					'page': streamit_loadmore_params.current_page
				};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {

					jQuery.ajax({
						url: streamit_loadmore_params.ajaxurl,
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								jQuery('#main').find('article:last-of-type').after(data); // where to insert posts
								canBeLoaded = true; // the ajax is completed, now we can run it again
								streamit_loadmore_params.current_page++;
							} else {
								jQuery(".loader-wheel-container").html('');
							}

						}
					});
				}


			});

		}
		if (streamit_options_blog == "infinite_scroll") {
			jQuery(window).scroll(function () {

				//** search load more *//
				let data = {
					'action': 'loadmore_blog',
					'query': streamit_loadmore_params.posts,
					'page': streamit_loadmore_params.current_page
				};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {

					jQuery.ajax({
						url: streamit_loadmore_params.ajaxurl,
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								jQuery('#main').find('.streamit-blog-main-list').append(data); // where to insert posts
								canBeLoaded = true; // the ajax is completed, now we can run it again
								streamit_loadmore_params.current_page++;
							} else {
								jQuery(".loader-wheel-container").html('');
							}

						}
					});
				}


			});
		}
		//For Archive page 
		if (streamit_option_archive == "infinite_scroll") {
			jQuery(window).scroll(function () {

				//** search load more *//

				let max_page = jQuery('.watchlist-contens').data('pages');
				let loader_wheel =jQuery('.loader-wheel-container');
				let button = jQuery(this),
					data = {
						'action': 'loadmore_archive',
						'query': streamit_loadmore_params.posts, // that's how we get params from wp_localize_script() function
						'page': streamit_loadmore_params.current_page,
						'availablepost': jQuery('.watchlist-contens').data('displaypost'),
					};

				if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {
					jQuery.ajax({ // you can also use jQuery.post here
						url: streamit_loadmore_params.ajaxurl, // AJAX handler
						data: data,
						type: 'POST',
						beforeSend: function (xhr) {
							canBeLoaded = false;
						},
						success: function (data) {
							if (data) {
								jQuery(".loader-wheel-container").html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
								loader_wheel.prev('div').append(data); // insert new posts
								streamit_loadmore_params.current_page++;
								canBeLoaded = true; // the ajax is completed, now we can run it again

								if (streamit_loadmore_params.current_page == max_page)
								jQuery(".loader-wheel-container").html(''); // if last page, remove the button
								
							} else {
								jQuery(".loader-wheel-container").html(''); // if last page, remove the button
							}
						}
					});
				}


			});
		}


		//** Cast infinite scroll**//
		if (jQuery("#cast-person-list").length > 0) {
			jQuery("#cast-person-list").scroll(function () {
				let _this = jQuery(this);
				let streamit_options_person_all = _this.find('.streamit_cast_list.active').data('options');
				if (streamit_options_person_all == 'infinite_scroll') {
					//** person load more *//
					if (jQuery(document).scrollTop() > (jQuery(document).height() - bottomOffset) && canBeLoaded == true) {
						canBeLoaded = false;
						let streamit_current_page = parseInt(_this.find('.streamit_cast_list.active').data('current-page'));
						let post = _this.find('.streamit_cast_list.active').attr('data-attibute');
						let url = window.location.href;
						let data = {
							'action': 'loadmore_person',
							'query': streamit_loadmore_params.posts,
							'page': streamit_current_page,
							'href': url,
							'post_type': post,
						};
						streamit_current_page++;
						_this.find('.streamit_cast_list.active').data('current-page', streamit_current_page);
						jQuery.ajax({
							url: streamit_loadmore_params.ajaxurl,
							data: data,
							type: 'POST',
							success: function (data) {
								if (data) {
									_this.find('.streamit_cast_list.active .loader-wheel-container').html('<div class="loader-wheel"><i><i><i><i><i><i><i><i><i><i><i><i></i></i></i></i></i></i></i></i></i></i></i></i></div>');
									_this.find('.streamit_cast_list.active .cast-related-list tr:last-child').after(data); // where to insert posts
									canBeLoaded = true; // the ajax is completed, now we can run it again

								} else {
									_this.find('.streamit_cast_list.active .loader-wheel-container').html('');
								}

							}
						});
					}

				}
			});
		}


	});


})(jQuery);