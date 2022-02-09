<?php

/**
 * Template part for displaying a post's taxonomy terms
 *
 * @package streamit
 */

namespace Streamit\Utility;

$taxonomies = wp_list_filter(
	get_object_taxonomies($post, 'objects'),
	array(
		'public' => true,
	)
);

$postcat = get_the_category();
if ($postcat) { ?>
	<ul class="iq-blogcat">
		<li class="iq-tag-title">
			<i class="fas fa-film" aria-hidden="true"></i> <?php echo __('Categories:', 'streamit'); ?>
		</li>
		<?php foreach ($postcat as $cat) { ?>
			<li><a href="<?php echo get_category_link($cat->cat_ID) ?>"><?php echo esc_html($cat->name); ?></a></li>
		<?php } ?>
	</ul>
<?php
}

$post_tags = get_the_tags();
if ($post_tags) { ?>
	<ul class="iq-blogtag">
		<li class="iq-tag-title">
			<i class="fas fa-tags" aria-hidden="true"></i> <?php echo __('Tags:', 'streamit'); ?>
		</li>
		<?php foreach ($post_tags as $post_tag) { ?>
			<li><a href="<?php echo get_tag_link( $post_tag ); ?>"><?php echo esc_html($post_tag->name); ?></a></li>
		<?php } ?>
	</ul>
<?php }	?>