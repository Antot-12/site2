<?php

/**
 * Template part for displaying a post's comment and edit links
 *
 * @package streamit
 */

namespace Streamit\Utility;

	$btn_txt = esc_html__('Read More', 'streamit');
	streamit()->streamit_get_blog_readmore_link(get_the_permalink(), $btn_txt);