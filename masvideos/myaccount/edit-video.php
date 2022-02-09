<?php
/**
 * Video
 *
 * Shows edit video page.
 *
 * This template can be overridden by copying it to yourtheme/masvideos/myaccount/edit-video.php.
 *
 * HOWEVER, on occasion MasVideos will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package MasVideos/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$id = ! empty( $video ) ? $video->get_id() : 0;

do_action( 'masvideos_before_edit_video_form' ); ?>

<form method="post" class="edit-video-form">

	<div class="edit-video-form-header">
		<div class="container">
			<h3><?php echo esc_html( $title ); ?></h3><?php // @codingStandardsIgnoreLine ?>
			<?php if( isset( $fields['video_attachment_id'] ) ) {
				$key = 'video_attachment_id';
				$field = $fields['video_attachment_id'];
				$value = isset( $field['value'] ) ? $field['value'] : null;
				masvideos_form_field( $key, $field, masvideos_get_post_data_by_key( $key, $value ), $id );
			} ?>
		</div>
	</div>

	<div class="masvideos-edit-video-fields">

		<?php do_action( "masvideos_before_edit_video_form_fields" ); ?>

    	<div class="masvideos-edit-video-form-fields">
    		<div class="masvideos-edit-video-form-fields-inner">

				<?php if (isset($fields['image_id'] ) ) {
				$key = 'image_id';
				$field = $fields['image_id'];
				$value = isset( $field['value'] ) ? $field['value'] : null;
				masvideos_form_field( $key, $field, masvideos_get_post_data_by_key( $key, $value ), $id );
				} ?>

				<div class="masvideos-edit-video-fields-inner">	

					<div class="masvideos-edit-video-fields__field-wrapper">
						<?php foreach ( $fields as $key => $field ) {

							if ( in_array($key, array('image_id', 'video_attachment_id' ) ) ) {
							continue;
						}

						$value = isset( $field['value'] ) ? $field['value'] : null;
						masvideos_form_field( $key, $field, masvideos_get_post_data_by_key( $key, $value ), $id );
						} ?>
					</div>

					<?php do_action( "masvideos_after_edit_video_form_fields" ); ?>

					<p>
						<button type="submit" class="button" name="edit-video" value="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></button>
						<?php if( ! empty( $button_draft_text ) ) : ?>
							<button type="submit" class="button edit-video" name="edit-video" value="draft"><?php echo esc_html( $button_draft_text ); ?></button>
						<?php endif; ?>
						<?php wp_nonce_field( 'masvideos-edit-video', 'masvideos-edit-video-nonce' ); ?>
						<input name="id" type="hidden" value="<?php echo esc_attr( $id ); ?>" />
					</p>
				</div>
			</div>
		</div>
    </div>
</form>

<?php do_action( 'masvideos_after_edit_video_form' ); ?>
