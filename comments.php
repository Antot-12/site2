<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package streamit
 */

namespace Streamit\Utility;

$post_section = streamit()->post_style();
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

?>
<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) {
	?>
		<h3 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			echo esc_html($comments_number);
			if ($comments_number == 1) {
				esc_html_e(' Comment', 'streamit');
			} else {
				esc_html_e(' Comments', 'streamit');
			}
			?>
		</h3>
		<?php the_comments_navigation(); ?>

		<?php streamit()->the_comments(); ?>

		<?php
		if (!comments_open()) {
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'streamit'); ?></p>
	<?php
		}
	}
	$args = array(
		'label_submit' => esc_html__('Post Comment', 'streamit'),
		'comment_notes_before' => esc_html__('Your email address will not be published. Required fields are marked *', 'streamit') . '',
		'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__('Comment', 'streamit') . '"></textarea></div>',
		'fields' => array(
			'author' => '<div class="row"><div class="col-lg-4"><div class="comment-form-author"><input id="author" name="author" aria-required="true" placeholder="' . esc_attr__('Name*', 'streamit') . '" /></div></div>',
			'email' => '<div class="col-lg-4"><div class="comment-form-email"><input id="email" name="email" placeholder="' . esc_attr__('Email*', 'streamit') . '" /></div></div>',
			'url' => '<div class="col-lg-4"><div class="comment-form-url"><input id="url" name="url" placeholder="' . esc_attr__('Website', 'streamit') . '" /></div></div></div>',
		),
		'submit_button'	=> '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" >
		<span class="iq-btn-text-holder">' . esc_html__('Post Comment', 'streamit') . '</span>
	</button>',
	);
	comment_form($args);
	?>
</div><!-- #comments -->