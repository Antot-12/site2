<?php
/**
 * The template for displaying search form
 *
 * This template can be overridden by copying it to yourtheme/masvideos/searchform.php.
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

if( ! isset( $post_type ) ) {
    return;
}

?>
<form method="get" class="search-form masvideos-search masvideos-search-<?php echo esc_attr( $post_type ); ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="masvideos-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html__( 'Search for:', 'streamit' ); ?></label>
    <input type="search" id="masvideos-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search &hellip;', 'streamit' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="search-submit"><?php vodi_get_template( 'templates/svg/search-icon.svg' ); ?><span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'streamit' ); ?></span></button>
    <input type="hidden" name="post_type" value="<?php echo esc_attr( $post_type ); ?>" />
</form>
