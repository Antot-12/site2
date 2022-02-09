<?php

namespace Streamit\Utility;;
get_header();

$streamit_options = get_option('streamit_options');
$options = $streamit_options['streamit_blog_type'];
if (function_exists('set_post_view')) {
   set_post_view();
}
$video_url_link = get_post_meta(get_the_ID(), '_video_url_link');
$video_run_time = get_post_meta(get_the_ID(), '_video_run_time');
$trailer_link = get_field('name_trailer_link', get_the_ID());
$play_btn_text = isset($streamit_options['streamit_play_btn_text']) && !empty($streamit_options['streamit_play_btn_text']) ? $streamit_options['streamit_play_btn_text'] : 'Play Now';

$run_time = '';
if (isset($video_run_time[0])) {
   $run_time = $video_run_time[0];
}
?>
<div id="primary" class="content-area">
   <main id="main" class="site-main">

      <div class="main-content movi pt-0">
         <?php if (!is_page_template('streamit-full-width.php')) { ?>
            <div class="container-fluid">
            <?php } ?>
            <div class="row">
               <div class="col-lg-12">
                  <div class="video-container iq-main-slider">
                     <?php
                     while (have_posts()) : the_post();

                        masvideos_get_template_part('content', 'single-video');

                     endwhile; // end of the loop.
                     ?>
                  </div>
                  <div class="trending-info mt-4 pt-0 pb-4 mt-0">

                     <div class="row">
                        <div class="col-md-9 col-12 mb-auto">
                           <h3 class="trending-text big-title text-uppercase mt-0"><?php the_title(); ?></h3>
                           <ul class="p-0 mt-2 list-inline d-flex flex-wrap align-items-center movie-content movie-space-action">
                              <?php
                              $wp_object = wp_get_post_terms(get_the_ID(), 'video_cat');
                              if (!empty($wp_object)) {
                                 foreach ($wp_object as $val) {

                              ?>
                                    <li class="text-primary"> <a href="<?php echo get_tag_link($val->term_id)  ?>"><?php echo esc_html( $val->name) ?></a></li>

                              <?php }
                              } ?>
                           </ul>
                           <div class="d-flex flex-wrap align-items-center text-white text-detail flex-wrap mb-4 mt-3">
                              <span class="badge badge-secondary p-1 mr-2 single-view-count">
                                 <?php
                                 if (function_exists('set_post_view')) {
                                 ?>
                                    <i class="fas fa-eye"></i>
                                 <?php if (get_post_view() == 0) {
                                       echo esc_html('0 views');
                                    } else {
                                       echo get_post_view();
                                    };
                                 }
                                 ?></span>
                              <span class="span"><?php echo esc_html($run_time); ?></span>
                              <span class="trending-year"><?php echo get_the_date('M Y'); ?></span>
                           </div>

                           <ul class="list-inline p-0 m-0 share-icons music-play-lists">
                              <?php if (isset($streamit_options['streamit_display_social_icons'])) {
                                 if ($streamit_options['streamit_display_social_icons'] == 'yes') {
                              ?>
                                    <li class="share">
                                       <span><i class="ri-share-fill"></i></span>
                                       <div class="share-box">
                                          <div class="d-flex align-items-center">
                                             <a href="https://www.facebook.com/sharer?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                             <a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                             <a href="#" data-link='<?php the_permalink(); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
                                          </div>
                                       </div>
                                    </li>
                              <?php }
                              } ?>
                              <?php if (isset($streamit_options['streamit_display_like'])) {
                                 if ($streamit_options['streamit_display_like'] == 'yes') {
                              ?>
                                    <li>
                                       <div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="video" id="' . get_the_ID() . '" style="wpulike-heart"]'); ?></div>
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
                                    <a class="watch-list" rel="<?php echo get_the_ID(); ?>">
                                       <?php
                                       if (function_exists('add_to_watchlist')) {
                                          echo add_to_watchlist(get_the_ID());
                                       }
                                       ?>
                                    </a>
                                 <?php } ?>
                              </li>
                           </ul>

                           <?php
                           $tags =  wp_get_post_terms(get_the_ID(), 'video_tag');

                           if ($streamit_options['streamit_display_tag'] == 'yes' && isset($tags)) {
                           ?>
                              <ul class="p-0 list-inline d-flex flex-wrap align-items-center movie-content movie-space-action flex-wrap iq_tag-list">
                                 <?php
                                 if (!empty($tags)) {

                                 ?>
                                    <li class="text-primary text-lable"><i class="fas fa-tags" aria-hidden="true"></i><?php esc_html_e('Tags:', 'streamit'); ?></li>
                                    <?php
                                    foreach ($tags as $val) {
                                    ?>
                                       <li> <a href="<?php echo get_tag_link($val->term_id)  ?>"><?php echo esc_html( $val->name)?></a></li>

                                 <?php
                                    }
                                 } ?>
                              </ul>
                           <?php
                           }
                           ?>
                        </div>
                        <?php if (isset($streamit_options['streamit_display_trailer_link'])) {
                           if ($streamit_options['streamit_display_trailer_link'] == 'yes') {
                              if (in_array('video', $streamit_options['streamit_opt_multi_select'])) {
                                 if ($streamit_options['streamit_display_trailer_link_btn'] == 'no') {
                                    $trailer_img = get_field('name_trailer_img', get_the_ID());
                                    if (empty($trailer_img) && !has_post_thumbnail()) {
                                       $align = ' mt-0 trailer-play-btn ';
                                    } else {
                                       $align =  ' mt-4 ';
                                    }
                                 } else {
                                    $align =  ' mt-lg-0 trailer-play-btn ';
                                 } ?>
                                 <div class="trailor-video col-md-3 col-12 mt-md-0  <?php echo esc_attr($align); ?> mb-md-0 mb-1 text-lg-right">
                                    <?php
                                    streamit()->streamit_video_playbtn($streamit_options, $trailer_link);
                                    ?>

                                 </div>
                        <?php }
                           }
                        } ?>
                     </div>
                  </div>
                  <div class="streamit-content-details trending-info g-border">
                     <?php
                     $tab_uniqid = 'tab-' . uniqid();
                     global $episode;
                     ?>
                     <ul class="trending-pills-header d-flex nav nav-pills align-items-center text-center s-margin mb-5 justify-content-center" role="tablist">
                        <?php if (!empty(get_the_content())) { ?>
                           <li class="nav-item">
                              <a class="nav-link active show" data-toggle="pill" href="#<?php echo esc_attr($tab_uniqid); ?>description" role="tab" aria-selected="true"><?php echo esc_html('Description', 'streamit'); ?></a>
                           </li>
                        <?php } ?>
                        <?php if (isset($streamit_options['streamit_video_display_rating'])) {
                           if ($streamit_options['streamit_video_display_rating'] == 'yes') {
                        ?>
                              <li class="nav-item">
                                 <a class="nav-link" data-toggle="pill" href="#<?php echo esc_attr($tab_uniqid); ?>comment" role="tab" aria-selected="false"><?php echo esc_html('Comments', 'streamit'); ?></a>
                              </li>
                        <?php }
                        } ?>
                     </ul>
                     <div class="tab-content">
                        <?php if (!empty(get_the_content())) {
                           $content = str_word_count(get_the_content()); ?>
                           <div id="<?php echo esc_attr($tab_uniqid); ?>description" class="tab-pane fade active show" role="tabpanel">
                              <div class="description-content <?php if ($content > 100) {
                                                                  echo 'hideContent';
                                                               } ?>">
                                 <?php
                                 the_content();
                                 ?>
                              </div>
                              <?php
                              if ($content > 100) {
                              ?>
                                 <div class="show-more">
                                    <a href="javascript:void(0);" data-count="<?php echo esc_attr($content); ?>" data-showmore="<?php echo esc_attr__('More...', 'streamit'); ?>" data-showless="<?php echo esc_attr__('Less...', 'streamit'); ?>"><?php echo esc_html__('More...', 'streamit'); ?></a>
                                 </div>
                              <?php } ?>
                           </div>
                        <?php } ?>
                        <?php if (isset($streamit_options['streamit_video_display_rating'])) {
                           if ($streamit_options['streamit_video_display_rating'] == 'yes') {
                        ?>
                              <div id="<?php echo esc_attr($tab_uniqid); ?>comment" class="tab-pane fade" role="tabpanel">
                                 <?php
                                 if (comments_open() || get_comments_number()) :
                                    comments_template();
                                 endif;
                                 ?>
                              </div>
                        <?php }
                        } ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php if (!is_page_template('streamit-full-width.php')) { ?>
            </div>
         <?php } ?>
      </div>
      <?php
      if (isset($streamit_options['streamit_display_upcoming'])) {
         if ($streamit_options['streamit_display_upcoming'] == 'yes') {
            if (in_array('video', $streamit_options['streamit_upcoming_multi_select'])) {
               if ($streamit_options['streamit_upcoming_videos_all'] == 'selected') {
                  $args = array(
                     'post_type' => 'video',
                     'post_status' => 'publish',
                     'post__in' => $streamit_options['streamit_upcoming_videos_selected'],
                  );
               } else {
                  $args = array(
                     'post_type' => 'video',
                     'post_status' => 'publish',
                  );
               }
               if ($streamit_options['streamit_upcoming_videos_all'] == 'all') {
                  $args['posts_per_page'] = -1;
                  $args['meta_query'] = array(
                     array(
                        'key'     => 'name_upcoming',
                        'value'   => '"yes"',
                        'compare' => 'LIKE'
                     )
                  );
               }
               $upcomming_video = new \WP_Query($args);
               if ($upcomming_video->have_posts()) {
      ?>
                  <div id="iq-upcoming-video" class="iq-rtl-direction">
                     <?php if (!is_page_template('streamit-full-width.php')) { ?>
                        <div class="container-fluid">
                        <?php } ?>
                        <div class="row m-0">
                           <div class="col-sm-12 overflow-hidden p-0">
                              <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                                 <h4 class="main-title">
                                    <?php if (!empty($streamit_options['streamit_upcoming_title'])) {
                                       echo esc_attr($streamit_options['streamit_upcoming_title'], 'streamit');
                                    } else {
                                       echo __('Upcoming videos', 'streamit');
                                    } ?>
                                 </h4>
                              </div>
                              <div class="upcoming-contens">
                                 <ul class="inner-slider list-inline row p-0 mb-0">
                                    <?php
                                    while ($upcomming_video->have_posts()) {
                                       $upcomming_video->the_post();
                                       $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full");
                                       $trailer_link = get_field('name_trailer_link', get_the_ID());
                                       $video_run_time = get_post_meta(get_the_ID(), '_video_run_time');
                                       $video_url_link = get_post_meta(get_the_ID(), '_video_url_link');
                                       $video_choice = get_post_meta(get_the_ID(), '_video_choice');
                                       $meta = get_post_meta(get_the_ID());

                                       $run_time = '';
                                       $url_link = '';
                                       if (isset($video_run_time[0])) {
                                          $run_time = $video_run_time[0];
                                       }
                                       if (isset($video_choice[0])) {
                                          if ($video_choice[0] == 'video_url') {
                                             $url_link = $video_url_link[0];
                                          } else {
                                             $url_link = get_the_permalink();
                                          }
                                       }
                                    ?>
                                       <li class="slide-item">
                                          <div class="block-images position-relative">
                                             <div class="img-box">
                                                <img src="<?php echo esc_url($full_image[0]) ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                             </div>
                                             <div class="block-description">
                                                <h6>
                                                   <a href="<?php echo esc_url($url_link); ?>">
                                                      <?php the_title(); ?>
                                                   </a>
                                                </h6>
                                                <div class="video-time d-flex align-items-center my-2">
                                                   <span class="text-white"><?php echo esc_html($run_time); ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                   <a href="<?php echo esc_url($url_link); ?>" class="btn btn-hover iq-button">
                                                      <span><i class="fas fa-play mr-1" aria-hidden="true"></i><?php esc_html_e($play_btn_text); ?></span>
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
                                                                  <a href="#" data-link='<?php the_permalink(); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
                                                               </div>
                                                            </div>
                                                         </li>
                                                   <?php }
                                                   } ?>
                                                   <?php if (isset($streamit_options['streamit_display_like'])) {
                                                      if ($streamit_options['streamit_display_like'] == 'yes') {
                                                   ?>
                                                         <li>
                                                            <div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="video" id="' . get_the_ID() . '" style="wpulike-heart"]'); ?></div>
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
                                                         <a class="watch-list" rel="<?php echo get_the_ID(); ?>">
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
                                       </li>
                                    <?php
                                    }
                                    ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <?php if (!is_page_template('streamit-full-width.php')) { ?>
                        </div>
                     <?php } ?>
                  </div>
      <?php }
               wp_reset_postdata();
            }
         }
      } ?>
      <!-- #primary -->
   </main>
   <!-- #main -->
</div>
<!-- .container -->
<?php
get_footer();
