<?php

/**
 * The Template for displaying all single tv shows
 *
 * This template can be overridden by copying it to yourtheme/masvideos/single-tv-show.php.
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

namespace Streamit\Utility;

defined('ABSPATH') || exit;

get_header();

$streamit_options = get_option('streamit_options');
$meta = get_post_meta(get_the_ID());
$tv_imdb_rating = $meta['name_custom_imdb_rating'];
$recommended_tv_show_person_ids = get_post_meta(get_the_ID(), '_cast');
$recommended_person_cast_ids = !empty($recommended_tv_show_person_ids)? $recommended_tv_show_person_ids[0] :null;

$season_data = get_post_meta(get_the_ID(), '_seasons');
$get_latest_ep = '#';
$imdb_rating = 0;
$trailer_link = get_field('name_trailer_link', get_the_ID());
if (isset($tv_imdb_rating[0])) {
   $imdb_rating = $tv_imdb_rating[0];
   if ($streamit_options['streamit_imdb_display_rating'] === 'yes') {
      if ($streamit_options['streamit_display_single_star'] === 'no') {
         $imdb_rating = $imdb_rating;
      }
   } else {
      $imdb_rating = floatval($imdb_rating) / 2;
   }
}
if (isset($season_data[0]) && !empty($season_data[0])) {
   $season_count = count($season_data[0]) - 1;

   if (empty($season_data[0][$season_count]['episodes'])) {
      $season_count--;
   }

   $get_latest_ep_id = $season_data[0][$season_count]['episodes'][count($season_data[0][$season_count]['episodes']) - 1];
   $get_latest_ep = get_permalink($get_latest_ep_id);
}
?>
<div id="primary" class="content-area">
   <main id="main" class="site-main">
      <?php if (!is_page_template('streamit-full-width.php')) { ?>
         <div class="container-fluid">
         <?php } ?>
         <div class="banner-wrapper overlay-wrapper iq-main-slider" style="background:url('<?php echo get_the_post_thumbnail_url(); ?>')">
            <div class="banner-caption">
               <div class="movie-detail">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="trending-info">
                           <h1 class="trending-text big-title text-uppercase mt-0"><?php the_title(); ?></h1>
                           <?php if (isset($tv_imdb_rating[0]) && !empty($tv_imdb_rating[0])) { ?>
                              <div class="slider-ratting d-flex align-items-center" data-animation-in="fadeInLeft">
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
                                 <span class="text-white ml-3"><?php echo esc_html(round($imdb_rating, 1), 'iqonic'); ?> (<?php echo esc_html_e('imdb', 'streamit'); ?>)</span>
                              </div>
                           <?php } ?>
                           <ul class="p-0 list-inline d-flex flex-wrap align-items-center movie-content">
                              <?php
                              $wp_object = wp_get_post_terms(get_the_ID(), 'tv_show_genre');
                              if (!empty($wp_object)) {
                                 foreach ($wp_object as $val) {

                              ?>
                                    <li class="text-primary"> <a href="<?php echo get_tag_link($val->term_id) ?>"><?php echo esc_html( $val->name) ?></a></li>

                              <?php }
                              } ?>
                           </ul>
                           <div class="d-flex flex-wrap align-items-center text-white text-detail">
                              <span class="">
                                 <?php
                                 if (isset($season_data[0]) && !empty($season_data[0])) {
                                    echo esc_html(count($season_data[0]), 'streamit');
                                    if (count($season_data[0]) <= 1)
                                       echo esc_html__(' Season', 'streamit');
                                    else
                                       echo esc_html__(' Seasons', 'streamit');
                                 } else {
                                    echo esc_html__('No seasons released yet', 'streamit');
                                 }
                                 ?>
                              </span>
                              <span class="trending-year"><?php echo get_the_date('M Y') ?></span>
                           </div>

                           <div class="trending-dec">
                              <?php
                              if (!empty(get_the_content())) {
                                 the_content();
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="position-relative">
                  <?php
                  if ($get_latest_ep != '#') {
                  ?>
                     <a href="<?php echo esc_url($get_latest_ep, 'streamit') ?>" class="d-flex align-items-center">
                        <div class="play-button">
                           <i class="fas fa-play"></i>
                        </div>
                        <h4 class="w-name text-white font-weight-700"><?php echo esc_html__('Watch latest Episode', 'streamit') ?></h4>
                     </a>

                  <?PHP
                  }
                  ?>

               </div>
               <div class="row">
                  <div class="col-12 mt-auto mb-auto">
                     <ul class="list-inline p-0 m-0 share-icons music-play-lists">
                        <?php if (isset($streamit_options['streamit_display_social_icons'])) {
                           if ($streamit_options['streamit_display_social_icons'] == 'yes') {
                        ?>
                              <li class="share">
                                 <span><i class="ri-share-fill"></i></span>
                                 <div class="share-box tv-show-detail">
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
                                 echo add_to_watchlist(get_the_ID());
                                 ?>
                              </a>
                           <?php } ?>
                        </li>
                     </ul>

                     <?php
                     $tags =  wp_get_post_terms(get_the_ID(), 'tv_show_tag');
                     if ($streamit_options['streamit_display_tag'] == 'yes' && !empty($tags)) {
                     ?>

                        <ul class="p-0 list-inline d-flex flex-wrap align-items-center movie-content movie-space-action flex-wrap iq_tag-list">
                           <?php
                           if (!empty($tags)) {
                           ?>
                              <li class="text-primary text-lable"><i class="fas fa-tags" aria-hidden="true"></i><?php esc_html_e('Tags:', 'streamit') ?></li>
                              <?php
                              foreach ($tags as $val) {
                              ?>
                                 <li> <a href="<?php echo get_tag_link($val->term_id)  ?>"><?php echo esc_html( $val->name) ?></a></li>
                              <?php
                              } ?>
                        </ul>
                  <?php
                           }
                        }
                  ?>
                  </div>
               </div>

            </div>

            <?php if (isset($streamit_options['streamit_display_trailer_link'])) {
               if ($streamit_options['streamit_display_trailer_link'] == 'yes') {
                  if (in_array('tv_show', $streamit_options['streamit_opt_multi_select'])) {
                     if ($streamit_options['streamit_display_trailer_link_btn'] == 'no') {
                        $trailer_img = get_field('name_trailer_img', get_the_ID());
                        if (empty($trailer_img) && !has_post_thumbnail()) {
                           $align = ' trailer-play-btn ';
                        } else {
                           $align =  '';
                        }
                     } else {
                        $align =  ' trailer-play-btn ';
                     } ?>
                     <div class="trailor-video  text-sm-right p-3 <?php echo esc_attr($align); ?> col-md-3 col-12">
                        <?php
                        streamit()->streamit_video_playbtn($streamit_options, $trailer_link);
                        ?>

                     </div>
            <?php }
               }
            } ?>
         </div>
         <div class="main-content bottom-space height-100">
            <?php if (isset($season_data[0]) && !empty($season_data[0])) {

            ?>
               <div class="seasons">
                  <div class="iq-custom-select d-inline-block sea-epi s-margin">
                     <select name="cars" class="form-control season-select">
                        <?php
                        foreach ($season_data[0] as $index => $val) {

                        ?>
                           <option value="<?php echo esc_attr($index); ?>"><?php echo esc_html($val['name'], 'streamit'); ?></option>

                        <?php } ?>
                     </select>
                  </div>
                  <ul class="trending-pills d-flex nav nav-pills align-items-center text-center s-margin" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active show" data-toggle="pill" href="#episodes" role="tab" aria-selected="true">
                           <?php echo esc_html__('Episodes', 'streamit'); ?>
                        </a>
                     </li>
                     <?php
                     foreach ($season_data[0] as $index => $val) {
                        foreach ($val['episodes'] as $epdata) {
                           $_featured = get_post_meta($epdata, '__featured', true);
                           if ($_featured == 'yes') {
                              $episode_featured = $_featured;
                           }
                        }
                     }
                     if ($episode_featured) { ?>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="pill" href="#featured" role="tab" aria-selected="false">
                              <?php echo esc_html__('Featured Clips', 'streamit'); ?>
                           </a>
                        </li>
                     <?php }
                     ?>

                  </ul>
                  <div class="tab-content tv-show-bottom-space">
                     <div id="episodes" class="tab-pane fade active show" role="tabpanel">
                        <div class="block-space">
                           <div class="row">
                              <?php
                              foreach ($season_data[0] as $index => $val) {
                                 foreach ($val['episodes'] as $epdata) {
                                    $ep_obj = get_post($epdata);
                                    $episode_number = '';
                                    $episode_run_time = '';
                                    $episode_release_date = '';

                                    $url = '';
                                    $_episode_number = get_post_meta($epdata, '_episode_number');
                                    $_episode_run_time = get_post_meta($epdata, '_episode_run_time');
                                    $_thumbnail_id = get_post_meta($epdata, '_thumbnail_id');
                                    $_featured = get_post_meta($epdata, '__featured');
                                    $_episode_release_date = get_post_meta($epdata, '_episode_release_date');

                                    if (isset($_thumbnail_id[0])) {
                                       $url = wp_get_attachment_url($_thumbnail_id[0]);
                                    }

                                    if (isset($_episode_number[0])) {
                                       $episode_number = $_episode_number[0];
                                    }
                                    if (isset($_episode_run_time[0])) {
                                       $episode_run_time = $_episode_run_time[0];
                                    }

                                    if (isset($_episode_release_date[0])) {
                                       $episode_release_date = date_i18n(get_option('date_format'), $_episode_release_date[0]);
                                    }


                                    if ($index == 0) {
                                       $class = ' active show';
                                    } else {
                                       $class = '';
                                    }
                              ?>
                                    <div class="col-lg-3 col-md-6 col-sm-6 iq-mb-30 single-season-data animated fadeInUp <?php echo esc_attr($class); ?>" data-display="<?php echo esc_attr($index); ?>">
                                       <div class="epi-box">
                                          <div class="epi-img position-relative">
                                             <img src="<?php echo esc_url($url); ?>" class="img-fluid img-zoom" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                             <div class="episode-number"><?php echo esc_html($episode_number, 'streamit'); ?></div>
                                             <div class="episode-play-info">
                                                <div class="episode-play">
                                                   <a href="<?php the_permalink($ep_obj->ID); ?>">
                                                      <i class="ri-play-fill"></i>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="epi-desc p-3">
                                             <div class="d-flex align-items-center justify-content-between mb-3">
                                                <span class="text-white rel-date"><?php echo esc_html($episode_release_date, 'streamit'); ?></span>
                                                <span class="text-primary run-time"><?php echo esc_html($episode_run_time, 'streamit'); ?></span>
                                             </div>
                                             <a href="<?php the_permalink($ep_obj->ID); ?>">
                                                <h5 class="epi-name text-white mb-0">
                                                   <?php echo esc_html($ep_obj->post_title, 'streamit'); ?>
                                                </h5>
                                             </a>
                                          </div>
                                       </div>
                                    </div>
                              <?php }
                              } ?>

                           </div>
                        </div>
                     </div>
                     <div id="featured" class="tab-pane fade" role="tabpanel">
                        <div class="block-space">
                           <div class="row">
                              <?php
                              foreach ($season_data[0] as $index => $val) {
                                 foreach ($val['episodes'] as $epdata) {
                                    $ep_obj = get_post($epdata);
                                    $episode_number = '';
                                    $episode_run_time = '';
                                    $episode_release_date = '';

                                    $url = '';
                                    $_episode_number = get_post_meta($epdata, '_episode_number');
                                    $_episode_run_time = get_post_meta($epdata, '_episode_run_time');
                                    $_thumbnail_id = get_post_meta($epdata, '_thumbnail_id');
                                    $_featured = get_post_meta($epdata, '__featured');

                                    $_episode_release_date = get_post_meta($epdata, '_episode_release_date');

                                    if (isset($_thumbnail_id[0])) {
                                       $url = wp_get_attachment_url($_thumbnail_id[0]);
                                    }

                                    if (isset($_episode_number[0])) {
                                       $episode_number = $_episode_number[0];
                                    }
                                    if (isset($_episode_run_time[0])) {
                                       $episode_run_time = $_episode_run_time[0];
                                    }

                                    if (isset($_episode_release_date[0])) {
                                       $episode_release_date = date_i18n(get_option('date_format'), $_episode_release_date[0]);
                                    }


                                    if (isset($_featured['0']) && $_featured['0'] == 'yes') {
                                       if ($index == 0) {
                                          $class = ' active show';
                                       } else {
                                          $class = '';
                                       }

                              ?>
                                       <div class="col-lg-3 col-md-6 iq-mb-30 single-season-data animated fadeInUp <?php echo esc_attr($class); ?>" data-display="<?php echo esc_attr($index); ?>">
                                          <div class="epi-box">
                                             <div class="epi-img position-relative">
                                                <img src="<?php echo esc_url($url); ?>" class="img-fluid img-zoom" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                                <div class="episode-number"><?php echo esc_html($episode_number, 'streamit'); ?></div>
                                                <div class="episode-play-info">
                                                   <div class="episode-play">
                                                      <a href="<?php the_permalink($ep_obj->ID); ?>">
                                                         <i class="ri-play-fill"></i>
                                                      </a>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="epi-desc p-3">
                                                <div class="d-flex align-items-center justify-content-between mb-3">
                                                   <span class="text-white rel-date"><?php echo esc_html($episode_release_date, 'streamit'); ?></span>
                                                   <span class="text-primary run-time"><?php echo esc_html($episode_run_time, 'streamit'); ?></span>
                                                </div>
                                                <a href="<?php the_permalink($ep_obj->ID); ?>">
                                                   <h5 class="epi-name text-white mb-0">
                                                      <?php echo esc_html($ep_obj->post_title); ?>
                                                   </h5>
                                                </a>
                                             </div>
                                          </div>
                                       </div>

                              <?php }
                                 }
                              } ?>

                           </div>
                        </div>
                     </div>
                  </div>
               <?php } ?>
               </div>
         </div>
         <?php
         if (isset($streamit_options['streamit_display_cast'])) {
            if ($streamit_options['streamit_display_cast'] == 'yes') {
               if (!empty($recommended_person_cast_ids)) { ?>
                  <div id="iq-favorites" class="s-margin detail-cast-list iq-rtl-direction">
                     <div class="row m-0">
                        <div class="col-sm-12 overflow-hidden p-0">
                           <div class="iq-main-header d-flex align-items-center justify-content-between">
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
                                 <?php foreach ($recommended_person_cast_ids as $cast) {
                                    $person = masvideos_get_person($cast['id']);
                                    if ($person && is_a($person, 'MasVideos_Person')) {
                                 ?>
                                       <li class="slide-item">
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
                                 <?php
                                    }
                                 } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
            <?php }
            }
         }
         if (!is_page_template('streamit-full-width.php')) { ?>
         </div>
      <?php } ?>
      <?php if (isset($streamit_options['streamit_tvshow_display_rating'])) {
         if ($streamit_options['streamit_tvshow_display_rating'] == 'yes') {
      ?>
            <div class="iq_comment_block streamit-content-details">
               <?php if (!is_page_template('streamit-full-width.php')) { ?>
                  <div class="container-fluid">
                  <?php } ?>
                  <div class="row">
                     <div class="col-12">
                        <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                           <h4 class="main-title"> <?php echo __('Rate & Review', 'streamit'); ?></h4>
                        </div>
                        <?php
                        if (comments_open() || get_comments_number()) :
                           comments_template();
                        endif;
                        ?>
                     </div>
                  </div>
                  <?php if (!is_page_template('streamit-full-width.php')) { ?>
                  </div>
               <?php } ?>
            </div>
      <?php }
      } ?>
   </main>
</div>
<?php
get_footer();
