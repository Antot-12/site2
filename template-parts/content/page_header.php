<?php
/**
 * Template part for displaying the page header of the currently displayed page
 *
 * @package streamit
 */

namespace Streamit\Utility;

if ( is_404() ) {
	?>
	<div class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'streamit' ); ?>
		</h1>
	</div><!-- .page-header -->
	<?php
} elseif ( is_home() && ! have_posts() ) {
	?>
	<div class="page-header">
		<h1 class="page-title">
			<?php esc_html_e( 'Nothing Found', 'streamit' ); ?>
		</h1>
	</div><!-- .page-header -->
	<?php
} elseif ( is_home() && ! is_front_page() ) {
	?>
	<div class="page-header">
		<h1 class="page-title">
			<?php single_post_title(); ?>
		</h1>
	</div><!-- .page-header -->
	<?php
} elseif ( is_search() ) {
	?>
	<div class="page-header">
		<h3 class="page-title">
			<?php
			esc_html_e( 'Nothing Found', 'streamit' );
			?>
		</h3>
	</div><!-- .page-header -->
	<?php
} elseif ( is_archive() ) {
	?>
	<div class="page-header">
		<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );
		?>
	</div><!-- .page-header -->
	<?php
}
