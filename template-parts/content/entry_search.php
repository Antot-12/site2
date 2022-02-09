<?php

/**
 * Template part for displaying a post's page
 *
 * @package streamit
 */

namespace Streamit\Utility;

?>
<article id="post-<?php the_ID(); ?>" class="col-lg-3 col-md-4 col-sm-6 wl-child">
    <div class="block-images position-relative watchlist-img">
        <?php
        $streamit_options = get_option('streamit_options');

        if (isset($streamit_options['streamit_display_image'])) {
            $options = $streamit_options['streamit_display_image'];
            if ($options == "yes") {
                if (has_post_thumbnail()) {
                    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "medium_large");
        ?>
                    <div class="img-box">
                        <style>
                            @media (min-width: 1920px) {
                                <?php
                                $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full");
                                ?>
                            }
                        </style>
                        <img src="<?php echo esc_url($full_image[0]) ?>" class="img-fluid" alt="image">
                    </div>
        <?php }
            }
        } ?>
        <div class="block-description">
            <h6 class="iq-title">
                <a href="<?php echo esc_url(get_the_permalink()); ?>">
                    <?php the_title(); ?>
                </a>
            </h6>
            <div class="movie-time d-flex align-items-center my-2">
                <span class="text-white"><?php echo get_the_date(); ?></span>
            </div>
            <div class="hover-buttons">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="btn btn-hover iq-button">
                    <i class="fas fa-play mr-1" aria-hidden="true"></i>
                    <?php _e('Play Now', 'streamit') ?>
                </a>
            </div>
        </div>
        <div class="block-social-info">
            <ul class="list-inline p-0 m-0 music-play-lists">
                <?php if (isset($streamit_options['streamit_display_social_icons'])) {
                    if ($streamit_options['streamit_display_social_icons'] == 'yes') {
                ?>
                        <li class="share">
                            <span><i class="ri-share-fill"></i></span>
                            <div class="share-box">
                                <div class="d-flex align-items-center">
                                    <a href="https://www.facebook.com/sharer?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                    <a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                    <a href="#" data-link='<?php get_permalink(get_the_ID()); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
                                </div>
                            </div>
                        </li>
                <?php }
                } ?>
                <?php if (isset($streamit_options['streamit_display_like']) && class_exists( 'wp_ulike' ) ) {
                    if ($streamit_options['streamit_display_like'] == 'yes') {
                ?>
                        <li>
                            <div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="movie" id="' . get_the_ID() . '" style="wpulike-heart"]'); ?></div>
                        </li>
                <?php }
                } ?>
                <li>
                    <?php
                    if (!is_user_logged_in()) {
                        if (isset($streamit_options['streamit_signin_link'])) {
                            $streamit_signin_link = get_page_link($streamit_options['streamit_signin_link']);

                    ?>
                            <a class="watch-list-not" href="<?php echo esc_url($streamit_signin_link) ?>">
                                <span><i class="ri-add-line"></i></span>
                            </a>
                        <?php }
                    } else {
                        ?>
                        <a class="watch-list" rel="<?php echo esc_attr(get_the_ID(), 'streamit'); ?>">
                            <?php
                            if (function_exists('add_to_watchlist')) {
                                echo add_to_watchlist(get_the_ID());
                            }
                            ?>
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>

    </div>
</article>