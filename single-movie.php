<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage streamit
 * @since 1.0
 * @version 1.0
 */


namespace Streamit\Utility;

get_header();
if (function_exists('set_post_view')) {
   set_post_view();
}
$streamit_options = get_option('streamit_options');
$options = $streamit_options['streamit_blog_type'];
$movie_run_time = get_post_meta(get_the_ID(), '_movie_run_time');
$movie_url_link = get_post_meta(get_the_ID(), '_movie_url_link');
$movie_avg_rate = get_post_meta(get_the_ID(), '_masvideos_average_rating');
$recommended_movie_ids = get_post_meta(get_the_ID(), '_recommended_movie_ids');
$related_video_ids = get_post_meta(get_the_ID(), '_related_video_ids');
$movie_imdb_rating = get_post_meta(get_the_ID(), 'name_custom_imdb_rating');
$trailer_link = get_field('name_trailer_link', get_the_ID());
$avg_rate = '';
$run_time = '';
$url_link = '';
$censor_rating = '';
$imdb_rating = '';
$award_img = '';
$award_desc = '';
$play_btn_text = isset($streamit_options['streamit_play_btn_text']) && !empty($streamit_options['streamit_play_btn_text']) ? $streamit_options['streamit_play_btn_text'] : 'Play Now';

if (isset($movie_imdb_rating[0])) {
   $imdb_rating = $movie_imdb_rating[0];
   if ($streamit_options['streamit_imdb_display_rating'] === 'yes') {
      if ($streamit_options['streamit_display_single_star'] === 'no') {
         $imdb_rating = $imdb_rating;
      }
   } else {
      $imdb_rating = floatval($imdb_rating) / 2;
   }
}
if (isset($movie_avg_rate[0])) {
   $avg_rate = $movie_avg_rate[0];
}
$movie_release_year = get_post_meta(get_the_ID(), '_movie_release_date', true);
$movie_year = '';
if (!empty($movie_release_year)) {
   $movie_year = date('M Y', $movie_release_year);
}
$movie_run_time = get_post_meta(get_the_ID(), '_movie_run_time');
$movie_censor_rating = get_post_meta(get_the_ID(), '_movie_censor_rating');
if (isset($movie_run_time[0])) {
   $run_time = $movie_run_time[0];
}
if (isset($movie_censor_rating[0])) {
   $censor_rating = $movie_censor_rating[0];
}
if (function_exists('get_field')) {
   $award_key = get_field('name_award', get_the_ID());
   if (!empty($award_key['url'])) {
      $award_img = $award_key['url'];
   }
   if (!empty(get_field('name_award_desc', get_the_ID()))) {
      $award_desc = get_field('name_award_desc', get_the_ID());
   }
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
                        masvideos_get_template_part('content', 'single-movie');
                     endwhile; // end of the loop.
                     ?>
                  </div>
                  <div class="trending-info mt-4 pt-0 pb-4">
                     <div class="row">
                        <div class="col-md-9 col-12 mb-auto">
                           <div class="d-md-flex single-details">
                              <h3 class="trending-text big-title text-uppercase mt-0"><?php the_title(); ?></h3>
                              <?php if (isset($movie_imdb_rating[0]) && !empty($movie_imdb_rating[0])) { ?>
                                 <div class="slider-ratting d-flex align-items-center ml-md-3 ml-0" data-animation-in="fadeInLeft">
                                    <ul class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                       <?php
                                       if (isset($streamit_options['streamit_imdb_display_rating']) && $streamit_options['streamit_imdb_display_rating'] == 'yes' && $streamit_options['streamit_display_single_star'] == 'yes') {
                                       ?>
                                          <li>
                                             <i class="fas fa-star" aria-hidden="true"></i>
                                          </li>
                                          <?php
                                       } else {
                                          for ($i = 1; $i <= ceil($imdb_rating); $i++) {
                                             if (($imdb_rating - floor($imdb_rating)) > 0 && $i == ceil($imdb_rating)) {
                                          ?>
                                                <li>
                                                   <i class="fas fa-star-half" aria-hidden="true"></i>
                                                </li>
                                             <?php
                                                continue;
                                             }
                                             ?>
                                             <li>
                                                <i class="fas fa-star" aria-hidden="true"></i>
                                             </li>
                                       <?php
                                          }
                                       }
                                       ?>
                                    </ul>
                                    <span class="text-white ml-2"><?php echo esc_html(round($imdb_rating, 1) . ' (imdb)', 'streamit'); ?></span>
                                 </div>
                              <?php } ?>
                           </div>
                           <ul class="p-0 mt-2 list-inline d-flex flex-wrap align-items-center movie-content movie-space-action flex-wrap">
                              <?php
                              $wp_object = wp_get_post_terms(get_the_ID(), 'movie_genre');
                              if (!empty($wp_object)) {
                                 foreach ($wp_object as $val) {
                              ?>
                                    <li class="text-primary"> <a href="<?php echo get_tag_link($val->term_id) ?>"><?php echo esc_html( $val->name) ?></a></li>

                              <?php }
                              } ?>
                           </ul>

                           <div class="d-flex flex-wrap align-items-center text-white text-detail flex-wrap mb-4">
                              <span class="badge badge-secondary"><?php echo esc_html($censor_rating, 'streamit'); ?></span>
                              <span class="ml-3"><?php echo esc_html($run_time, 'streamit'); ?></span>
                              <span class="trending-year"><?php echo esc_html($movie_year, 'streamit'); ?></span>
                              <span class="trending-year single-view-count">
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
                           $tags =  wp_get_post_terms(get_the_ID(), 'movie_tag');
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
                                       <li><a href="<?php echo get_tag_link($val->term_id)   ?>"><?php echo esc_html( $val->name) ?></a></li>
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
                              if (in_array('movie', $streamit_options['streamit_opt_multi_select'])) {
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
                                 <div class="trailor-video col-md-3 col-12 mt-lg-0 <?php echo esc_attr($align); ?> mb-md-0 mb-1 text-lg-right">
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
                     global $movie;
                     ?>
                     <ul class="trending-pills-header d-flex nav nav-pills align-items-center text-center s-margin mb-5 justify-content-center" role="tablist">
                        <?php if (!empty(get_the_content())) { ?>
                           <li class="nav-item">
                              <a class="nav-link active show" data-toggle="pill" href="#<?php echo esc_attr($tab_uniqid); ?>description" role="tab" aria-selected="true"><?php echo esc_html('Description', 'streamit'); ?></a>
                           </li>
                        <?php } ?>
                        <?php if (isset($streamit_options['streamit_movie_display_rating'])) {
                           if ($streamit_options['streamit_movie_display_rating'] == 'yes') {
                        ?>
                              <li class="nav-item">
                                 <a class="nav-link" data-toggle="pill" href="#<?php echo esc_attr($tab_uniqid); ?>review" role="tab" aria-selected="false"><?php echo esc_html('Rate & Review', 'streamit'); ?></a>
                              </li>
                        <?php }
                        } ?>
                        <?php
                        if (!$movie || $movie->get_sources()) { ?>
                           <li class="nav-item">
                              <a class="nav-link" data-toggle="pill" href="#<?php echo esc_attr($tab_uniqid); ?>sources" role="tab" aria-selected="false"><?php echo esc_html('Sources', 'streamit'); ?></a>
                           </li>
                        <?php } ?>
                     </ul>
                     <div class="tab-content">
                        <?php if (!empty(get_the_content())) {
                           $content = str_word_count(get_the_content());
                        ?>
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
                              <?php }  ?>
                           </div>
                        <?php } ?>
                        <?php if (isset($streamit_options['streamit_movie_display_rating'])) {
                           if ($streamit_options['streamit_movie_display_rating'] == 'yes') {
                        ?>
                              <div id="<?php echo esc_attr($tab_uniqid); ?>review" class="tab-pane fade" role="tabpanel">
                                 <?php
                                 if (comments_open() || get_comments_number()) :
                                    comments_template();
                                 endif;
                                 ?>
                              </div>
                        <?php }
                        } ?>
                        <?php
                        if (!$movie || $movie->get_sources()) { ?>
                           <div id="<?php echo esc_attr($tab_uniqid); ?>sources" class="tab-pane fade" role="tabpanel">
                              <?php
                              masvideos_get_template_part('single-movie-sources'); ?>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php if (!is_page_template('streamit-full-width.php')) { ?>
            </div>
         <?php } ?>
      </div>
      <?php
      // Cast or starring
      if (isset($streamit_options['streamit_display_cast'])) {
         if ($streamit_options['streamit_display_cast'] == 'yes') {
            global $movie;
            $casts = $movie->get_cast();
            if (!empty($casts)) {
      ?>
               <div id="iq-favorites" class="s-margin detail-cast-list iq-rtl-direction">
                  <?php if (!is_page_template('streamit-full-width.php')) { ?>
                     <div class="container-fluid">
                     <?php } ?>
                     <div class="row m-0">
                        <div class="col-sm-12 overflow-hidden p-0">
                           <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                              <h4 class="main-title">
                                 <?php if (!empty($streamit_options['streamit_cast_title'])) {
                                    echo esc_attr($streamit_options['streamit_cast_title'], 'streamit');
                                 } else {
                                    echo __('Starring', 'streamit');
                                 } ?>
                              </h4>
                           </div>
                           <div class="favorites-contens iq-smovie-slider">
                              <ul class="inner-slider list-inline row p-0 mb-0">
                                 <?php
                                 foreach ($casts as $cast) {
                                    $person = masvideos_get_person($cast['id']);
                                    if ($person && is_a($person, 'MasVideos_Person')) {
                                 ?>
                                       <li class="slide-item iq-ltr-direction">
                                          <div class="cast-images position-relative">
                                             <div class="col-sm-4 col-12 img-box p-0">
                                                <?php echo masvideos_get_person_thumbnail('thumbnail', $person); ?>
                                             </div>
                                             <div class="col-sm-8 col-12 block-description">
                                                <h6 class="iq-title">
                                                   <a href="<?php the_permalink($person->get_ID()); ?>">
                                                      <?php echo esc_html($person->get_name(), 'streamit'); ?>
                                                   </a>
                                                </h6>
                                                <?php if (!empty($cast['character'])) : ?>
                                                   <div class="movie-time d-flex align-items-center my-2">
                                                      <span class="text-white"><?php echo __('As ', 'streamit') . esc_html($cast['character']); ?></span>
                                                   </div>
                                                <?php endif; ?>
                                             </div>
                                          </div>

                                       </li>
                                 <?php }
                                 } ?>

                              </ul>
                           </div>
                        </div>
                     </div>
                     <?php if (!is_page_template('streamit-full-width.php')) { ?>
                     </div>
                  <?php } ?>
               </div>
            <?php  }
            wp_reset_postdata();
         }
      }
      //Recommended Movies
      if (isset($streamit_options['streamit_display_recommended'])) {
         if ($streamit_options['streamit_display_recommended'] == 'yes') {
            if (isset($recommended_movie_ids[0]) && !empty($recommended_movie_ids[0])) { ?>
               <div id="iq-favorites" class="s-margin iq-rtl-direction">
                  <?php if (!is_page_template('streamit-full-width.php')) { ?>
                     <div class="container-fluid">
                     <?php } ?>
                     <div class="row m-0">
                        <div class="col-sm-12 overflow-hidden p-0">
                           <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                              <h4 class="main-title">
                                 <?php if (!empty($streamit_options['streamit_recommended_title'])) {
                                    echo esc_attr($streamit_options['streamit_recommended_title'], 'streamit');
                                 } else {
                                    echo __('Recommended', 'streamit');
                                 } ?>
                              </h4>
                           </div>
                           <div class="favorites-contens iq-smovie-slider">
                              <ul class="inner-slider list-inline row p-0 mb-0">
                                 <?php
                                 foreach ($recommended_movie_ids[0] as $r_movie) {
                                    $r_movie_obj = get_post($r_movie);
                                    if ($r_movie_obj) {
                                       $attachement_url = wp_get_attachment_url(get_post_thumbnail_id($r_movie_obj->ID));
                                       if (isset($attachement_url) && !empty($attachement_url))
                                          $attachement_url = $attachement_url;
                                       else
                                          $attachement_url = '';

                                       $run_time = '';
                                       $censor_rating = '';
                                       $url_link  = get_post_permalink($r_movie);
                                       $movie_run_time = get_post_meta($r_movie, '_movie_run_time');

                                       $movie_censor_rating = get_post_meta($r_movie, '_movie_censor_rating');
                                       if (isset($movie_run_time[0])) {
                                          $run_time = $movie_run_time[0];
                                       }
                                       if (isset($movie_censor_rating[0])) {
                                          $censor_rating = $movie_censor_rating[0];
                                       }
                                 ?>
                                       <li class="slide-item">
                                          <div class="block-images position-relative">
                                             <div class="img-box">
                                                <img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                             </div>
                                             <div class="block-description">
                                                <h6 class="iq-title">
                                                   <a href="<?php echo esc_url($url_link); ?>">
                                                      <?php echo esc_html($r_movie_obj->post_title, 'streamit'); ?>
                                                   </a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                   <div class="badge badge-secondary p-1 mr-2"><?php echo esc_html($censor_rating, 'streamit'); ?></div>
                                                   <span class="text-white"><?php echo esc_html($run_time, 'streamit'); ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                   <a href="<?php echo esc_url($url_link); ?>" class="btn btn-hover iq-button">
                                                      <span><i class="fas fa-play mr-1" aria-hidden="true"></i><?php echo esc_html($play_btn_text, 'iqonic'); ?></span>
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
                                                                  <a href="#" data-link='<?php get_permalink($r_movie_obj->ID); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
                                                               </div>
                                                            </div>
                                                         </li>
                                                   <?php }
                                                   } ?>
                                                   <?php if (isset($streamit_options['streamit_display_like'])) {
                                                      if ($streamit_options['streamit_display_like'] == 'yes') {
                                                   ?>
                                                         <li>
                                                            <div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="movie" id="' . $r_movie_obj->ID . '" style="wpulike-heart"]'); ?></div>
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
                                                         <a class="watch-list" rel="<?php echo esc_attr($r_movie_obj->ID, 'streamit'); ?>">
                                                            <?php
                                                            if (function_exists('add_to_watchlist')) {
                                                               echo add_to_watchlist($r_movie_obj->ID);
                                                            }
                                                            ?>
                                                         </a>
                                                      <?php } ?>
                                                   </li>
                                                </ul>
                                             </div>
                                          </div>

                                       </li>
                                 <?php }
                                 } ?>

                              </ul>
                           </div>
                        </div>
                     </div>
                     <?php if (!is_page_template('streamit-full-width.php')) { ?>
                     </div>
                  <?php } ?>
               </div>
            <?php  }
            wp_reset_postdata();
         }
      }

      // Related Movies
      if (isset($streamit_options['streamit_display_related_movie'])) {
         if ($streamit_options['streamit_display_related_movie'] == 'yes') { ?>
            <div id="iq-favorites" class="s-margin iq-rtl-direction">
               <?php if (!is_page_template('streamit-full-width.php')) { ?>
                  <div class="container-fluid">
                  <?php } ?>
                  <div class="row m-0">
                     <div class="col-sm-12 overflow-hidden p-0">
                        <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                           <h4 class="main-title">
                              <?php if (!empty($streamit_options['streamit_display_related_movie_title'])) {
                                 echo esc_attr($streamit_options['streamit_display_related_movie_title'], 'streamit');
                              } else {
                                 echo esc_html__('Related Movies', 'streamit');
                              } ?>
                           </h4>
                        </div>
                        <div class="favorites-contens iq-smovie-slider">
                           <ul class="inner-slider list-inline row p-0 mb-0">
                              <?php
                              $terms_id = array_map(function ($item) {
                                 return   $item->term_id;
                              }, wp_get_post_terms(get_the_ID(), 'movie_genre'));
                              $args = array(
                                 'post_type' => 'movie',
                                 'post_status' => 'publish',
                                 'orderby' => 'rand',
                              );
                              $args[] = $streamit_options['streamit_related_movies_all'] == 'selected' ? array(
                                 'post__in' => $streamit_options['streamit_related_movies_selected'],
                              ) : array(
                                 'tax_query' => array(
                                    array(
                                       'taxonomy' => 'movie_genre',
                                       'field' => 'term_id',
                                       'terms' => $terms_id,
                                    )
                                 )
                              );

                              $page_post_id = get_the_ID();
                              $related_movies = new \WP_Query($args);
                              while ($related_movies->have_posts()) {
                                 $related_movies->the_post();
                                 $r_movie_obj = get_post();

                                 if ($page_post_id == get_the_ID()) {
                                    continue;
                                 }

                                 $attachement_url = wp_get_attachment_url(get_post_thumbnail_id($r_movie_obj->ID));
                                 if (isset($attachement_url) && !empty($attachement_url))
                                    $attachement_url = $attachement_url;
                                 else
                                    $attachement_url = '';

                                 $run_time = '';
                                 $url_link  = get_post_permalink(get_the_ID());
                                 $movie_run_time = get_post_meta(get_the_ID(), '_movie_run_time');
                                 if (isset($movie_run_time[0])) {
                                    $run_time = $movie_run_time[0];
                                 }
                              ?>
                                 <li class="slide-item">
                                    <div class="block-images position-relative">
                                       <div class="img-box">
                                          <img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                       </div>
                                       <div class="block-description">
                                          <h6 class="iq-title">
                                             <a href="<?php echo esc_url($url_link); ?>">
                                                <?php echo esc_html($r_movie_obj->post_title, 'streamit'); ?>
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
                                                            <a href="https://www.facebook.com/sharer?u=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                                            <a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                                            <a href="#" data-link='<?php echo get_the_permalink(); ?>' class="share-ico iq-copy-link"><i class="ri-links-fill"></i></a>
                                                         </div>
                                                      </div>
                                                   </li>
                                             <?php }
                                             } ?>
                                             <?php if (isset($streamit_options['streamit_display_like'])) {
                                                if ($streamit_options['streamit_display_like'] == 'yes') {
                                             ?>
                                                   <li>
                                                      <div class="iq-like-btn"><?php echo do_shortcode('[wp_ulike for="movie" id="' . $r_movie_obj->ID . '" style="wpulike-heart"]'); ?></div>
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
                                                   <a class="watch-list" rel="<?php echo esc_attr($r_movie_obj->ID, 'streamit'); ?>">
                                                      <?php
                                                      if (function_exists('add_to_watchlist')) {
                                                         echo add_to_watchlist($r_movie_obj->ID);
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
                              } ?>

                           </ul>
                        </div>
                     </div>
                  </div>
                  <?php if (!is_page_template('streamit-full-width.php')) { ?>
                  </div>
               <?php } ?>
            </div>
            <?php
            wp_reset_postdata();
         }
      }

      // Upcomming Movies
      if (isset($streamit_options['streamit_display_upcoming'])) {
         if ($streamit_options['streamit_display_upcoming'] == 'yes') {
            if (in_array('movie', $streamit_options['streamit_upcoming_multi_select'])) {
               if ($streamit_options['streamit_upcoming_movies_all'] == 'selected') {
                  $args = array(
                     'post_type' => 'movie',
                     'post_status' => 'publish',
                     'post__in' => $streamit_options['streamit_upcoming_movies_selected'],
                  );
               } else {
                  $args = array(
                     'post_type' => 'movie',
                     'post_status' => 'publish',
                  );
               }
               if ($streamit_options['streamit_upcoming_movies_all'] == 'all') {
                  $args['posts_per_page'] = -1;
                  $args['meta_query'] = array(
                     array(
                        'key'     => 'name_upcoming',
                        'value'   => '"yes"',
                        'compare' => 'LIKE'
                     )
                  );
               }
               $upcomming_movie = new \WP_Query($args);
               if ($upcomming_movie->have_posts()) {
            ?>
                  <div id="iq-upcoming-movie" class="iq-rtl-direction">
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
                                       echo __('Upcoming Movies', 'streamit');
                                    } ?>
                                 </h4>
                              </div>
                              <div class="upcoming-contens">
                                 <ul class="inner-slider list-inline row p-0 mb-0">
                                    <?php
                                    while ($upcomming_movie->have_posts()) {
                                       $upcomming_movie->the_post();
                                       $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "full");
                                       $trailer_link = get_field('name_trailer_link', get_the_ID());
                                       $movie_run_time = get_post_meta(get_the_ID(), '_movie_run_time');
                                       $movie_url_link = get_post_meta(get_the_ID(), '_movie_url_link');
                                       $movie_choice = get_post_meta(get_the_ID(), '_movie_choice');
                                       $meta = get_post_meta(get_the_ID());
                                       $movie_censor_rating = get_post_meta(get_the_ID(), '_movie_censor_rating');
                                       $run_time = '';
                                       $url_link = '';
                                       $censor_rating = '';
                                       if (isset($movie_run_time[0])) {
                                          $run_time = $movie_run_time[0];
                                       }
                                       if (isset($movie_censor_rating[0])) {
                                          $censor_rating = $movie_censor_rating[0];
                                       }

                                       if (isset($movie_choice[0])) {
                                          if ($movie_choice[0] == 'movie_url') {
                                             $url_link = $movie_url_link[0];
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
                                                <h6 class="iq-title">
                                                   <a href="<?php echo esc_url($url_link); ?>">
                                                      <?php the_title(); ?>
                                                   </a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2">
                                                   <div class="badge badge-secondary p-1 mr-2"><?php echo esc_html($censor_rating, 'streamit'); ?></div>
                                                   <span class="text-white"><?php echo esc_html($run_time); ?></span>
                                                </div>
                                                <div class="hover-buttons">
                                                   <a href="<?php echo esc_url($url_link); ?>" class="btn btn-hover iq-button">
                                                      <span><i class="fas fa-play mr-1" aria-hidden="true"></i><?php echo esc_html($play_btn_text, 'streamit'); ?></span>
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
      }
      ?>
   </main>
   <!-- #main -->
</div>
<!-- .container -->

<?php get_footer();
