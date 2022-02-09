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

get_header();
$streamit_options = get_option('streamit_options');
$options_streamit_load = $streamit_options['streamit_display_buttons'];
$recommended_person_cast_ids = [];
$recommended_movie_cast_ids = [];
$recommended_tv_show_cast_ids = [];
$recommended_movie_cast_ids = get_post_meta(get_the_ID(), '_movie_cast', true);
if (is_array($recommended_movie_cast_ids) && !empty($recommended_movie_cast_ids)) {
   $recommended_person_cast_ids = array_merge($recommended_person_cast_ids, $recommended_movie_cast_ids);
}
$recommended_tv_show_cast_ids = get_post_meta(get_the_ID(), '_tv_show_cast', true);
if (is_array($recommended_tv_show_cast_ids) && !empty($recommended_tv_show_cast_ids)) {
   $recommended_person_cast_ids = array_merge($recommended_person_cast_ids, $recommended_tv_show_cast_ids);
}
$cast_id = get_the_ID();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
?>
<div id="primary" class="content-area">
   <main id="main" class="site-main">

      <div class="main-content movi pt-md-0 pt-3">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <div class="video-container iq-main-slider">
                     <?php
                     while (have_posts()) : the_post();

                        masvideos_get_template_part('content', 'single-person');

                     endwhile; // end of the loop.
                     ?>
                  </div>
                  <div class="cast-detail-main-content">
                     <div class="row">
                        <div class="col-md-3 col-12">
                           <?php if (has_post_thumbnail()) : ?>
                              <?php the_post_thumbnail(); ?>
                           <?php endif; ?>
                           <div class="align-items-center trending-list flex-wrap">
                              <h3 class="trending-text text-capitalize mt-5 mb-3"><?php echo esc_html_e('Personal Info', 'streamit'); ?></h3>
                              <div class="list-inline p-0 mb-4 share-icons music-play-lists profile-social-lists">
                                 <?php if (isset($streamit_options['streamit_display_social_icons'])) {
                                    if ($streamit_options['streamit_display_social_icons'] == 'yes') {
                                 ?>
                                       <a href="https://www.facebook.com/sharer?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico mr-2"><i class="ri-facebook-fill"></i></a>
                                       <a href="http://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo get_the_permalink(); ?>" target="_blank" rel="noopener noreferrer" class="share-ico mr-2"><i class="ri-twitter-fill"></i></a>
                                       <a href="#" data-link='<?php the_permalink(); ?>' class="share-ico iq-copy-link mr-2"><i class="ri-links-fill"></i></a>
                              </div>
                        <?php }
                                 } ?>
                           </div>
                           <div class="person-details">
                              <?php
                              do_action('masvideos_template_single_person_content_sidebar', 'masvideos_template_single_person_creditss', 10);
                              ?>
                           </div>
                        </div>
                        <div class="col-md-9 col-12 mb-auto">
                           <h3 class="trending-text big-title text-uppercase mt-0"><?php the_title(); ?></h3>
                           <div class="trending-dec w-100 movie-top-space trending-info g-border">
                              <?php
                              if (!empty(get_the_content())) {
                                 the_content();
                              }
                              ?>
                           </div>
                           <?php if ($streamit_options['streamit_show_cast_most_viewer'] == 'yes') { ?>
                              <div id="iq-favorites" class="s-margin iq-rtl-direction">
                                 <div class="row m-0">
                                    <div class="col-sm-12 overflow-hidden p-0">
                                       <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                                          <h4 class="main-title">
                                             <?php if (!empty($streamit_options['streamit_cast_most_viewer'])) {
                                                echo esc_attr($streamit_options['streamit_cast_most_viewer'], 'streamit');
                                             } else {
                                                echo __('Most Viewer', 'streamit');
                                             } ?>
                                          </h4>
                                       </div>
                                       <div class="favorites-contens iq-smovie-slider">
                                          <ul class="inner-slider list-inline row p-0 mb-0">
                                             <?php
                                             $args = array(
                                                'post_type' => array('movie', 'tv_show'),
                                                'post_status' => 'publish',
                                                'post__in' => $recommended_person_cast_ids,
                                                'orderby'           => 'meta_value_num',
                                                'order'             => 'DESC',
                                                'posts_per_page'    => 10,
                                                'meta_query' => array(
                                                   'relation' => 'AND',
                                                   array(
                                                      'relation' => 'OR',
                                                      array(
                                                         'key' => 'post_views_count',
                                                      ),
                                                      array(
                                                         'key' => 'tv_show_views_count',
                                                      )
                                                   ),
                                                )
                                             );
                                             $wp_query_ = new \WP_Query($args);
                                             if ($wp_query_->have_posts()) {
                                                while ($wp_query_->have_posts()) {
                                                   $wp_query_->the_post();
                                                   $attachement_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')[0];
                                                   if (isset($attachement_url) && !empty($attachement_url))
                                                      $attachement_url = $attachement_url;
                                                   else
                                                      $attachement_url = '';
                                             ?>
                                                   <li class="slide-item">
                                                      <div class="block-images position-relative">
                                                         <div class="img-box">
                                                            <img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>">
                                                         </div>
                                                         <div class="block-description">
                                                            <h6 class="iq-title">
                                                               <a href="<?php the_permalink(); ?>">
                                                                  <?php the_title(); ?>
                                                               </a>
                                                            </h6>
                                                         </div>
                                                      </div>

                                                   </li>
                                             <?php
                                                }
                                             }
                                             wp_reset_postdata();
                                             ?>

                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           <?php } ?>
                           <div class="cast-details">
                              <div class="iq-main-header d-flex align-items-center justify-content-between iq-ltr-direction">
                                 <h4>
                                    <?php if (!empty($streamit_options['streamit_cast_related_post_title'])) {
                                       echo esc_attr($streamit_options['streamit_cast_related_post_title'], 'streamit');
                                    } else {
                                       echo __('Acting', 'streamit');
                                    } ?>  
                                 </h4>
                              </div>
                              <ul class="trending-pills treading-heading-tab d-flex nav nav-pills align-items-center text-center s-margin mb-3" role="tablist">
                                 <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="pill" href="#all" role="tab" aria-selected="true"><?php echo esc_html('All', 'streamit'); ?></a>
                                 </li>
                                 <?php if (isset($recommended_movie_cast_ids[0]) && !empty($recommended_movie_cast_ids[0])) { ?>
                                    <li class="nav-item">
                                       <a class="nav-link" data-toggle="pill" href="#movie" role="tab" aria-selected="false"><?php echo esc_html('Movies', 'streamit'); ?></a>
                                    </li>
                                 <?php }
                                 if (isset($recommended_tv_show_cast_ids[0]) && !empty($recommended_tv_show_cast_ids[0])) { ?>
                                    <li class="nav-item">
                                       <a class="nav-link" data-toggle="pill" href="#tv_show" role="tab" aria-selected="false"><?php echo esc_html('Tv Shows', 'streamit'); ?></a>
                                    </li>
                                 <?php } ?>
                              </ul>
                              <div class="tab-content cast-person-list" id="cast-person-list">
                                 <div id="all" class="tab-pane fade active show streamit_cast_list" role="tabpanel" data-current-page="1" data-attibute="all" data-options="<?php echo esc_attr($streamit_options['streamit_cast_use_infinite_scroll']); ?>">
                                    <table class="credit_group animated fadeInUp">
                                       <tbody class="cast-related-list">
                                          <?php
                                          if (!empty($recommended_person_cast_ids)) {
                                             $counter = 1;
                                             $args_all = array(
                                                'post_type' => array('movie', 'tv_show'),
                                                'post_status' => 'publish',
                                                'post__in' => $recommended_person_cast_ids,
                                                'order'             => 'ASC',
                                                'posts_per_page'     => 10,
                                                'paged' => $paged,
                                                'suppress_filters'  => 0
                                             );
                                             $wp_query = new \WP_Query($args_all);
                                             if ($wp_query->have_posts()) {
                                                while ($wp_query->have_posts()) {
                                                   $wp_query->the_post();
                                                   $r_movie_obj = get_the_ID();
                                                   $meta = get_post_meta($r_movie_obj);
                                                   $movie_cast = get_post_meta($r_movie_obj, '_cast');
                                                   $m_cast = $movie_cast[0];
                                                   $found_key = array_search($cast_id, array_column($m_cast, 'id'));
                                                   if ('tv_show' == get_post_type()) {
                                                      $season_data = unserialize($meta['_seasons'][0]);
                                                      if (!empty($season_data)) {
                                                         $season_years = array_column($season_data, 'year');
                                                         $start = count($season_years) ? min($season_years) : '';
                                                         $end = count($season_years) ? max($season_years) : '';
                                                         $season_count = count($season_data);
                                                         if ($season_count == '1') {
                                                            $release_year = $start;
                                                         } else {
                                                            if (!empty($start) && !empty($end)) {
                                                               $release_year = $start . ' - ' . $end;
                                                            }
                                                         }
                                                         if (is_array($season_data)) {
                                                            $censor_rating = ' (' . count($season_data) . ' Seasons) ';
                                                         }
                                                      }
                                                   } else {
                                                      $release_year = get_post_meta($r_movie_obj, '_movie_release_date');
                                                      if (isset($release_year[0])) {
                                                         $release_year = date('Y', $release_year[0]);
                                                      }
                                                   }
                                                   $attachement_url = wp_get_attachment_image_src(get_post_thumbnail_id($r_movie_obj), 'thumbnail')[0];
                                                   if (isset($attachement_url) && !empty($attachement_url))
                                                      $attachement_url = $attachement_url;
                                                   else
                                                      $attachement_url = '';

                                          ?>
                                                   <tr class="trending-pills">
                                                      <td class="image"><img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>"></td>
                                                      <td class="seperator"><?php echo esc_html($counter); ?></td>
                                                      <td class="content">
                                                         <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                         </a>
                                                         <span class="ml-2 group"> <?php esc_html_e('as', 'streamit'); ?> <span class="character">
                                                               <?php echo esc_html($m_cast[$found_key]['character']);
                                                               if ('tv_show' == get_post_type()) {
                                                                  echo esc_html($censor_rating);
                                                               } ?></span></span>
                                                      </td>
                                                      <td class="year">
                                                         <?php if (!empty($release_year)) {
                                                            echo esc_html($release_year);
                                                         } ?>
                                                      </td>
                                                   </tr>
                                          <?php
                                                   $counter++;
                                                }
                                             }
                                          }
                                          wp_reset_postdata(); ?>

                                       </tbody>
                                    </table>
                                 </div>
                                 <div id="movie" class="tab-pane fade streamit_cast_list" role="tabpanel" data-attibute="movie" data-current-page="1" data-options="<?php echo esc_attr($streamit_options['streamit_cast_use_infinite_scroll']); ?>">
                                    <table class="credit_group animated fadeInUp">
                                       <?php
                                       $counter = 1;
                                       $args_all = array(
                                          'post_type' => 'movie',
                                          'post_status' => 'publish',
                                          'post__in' => $recommended_movie_cast_ids,
                                          'order'             => 'ASc',
                                          'posts_per_page'     => 10,
                                          'paged' => $paged,
                                          'suppress_filters'  => 0
                                       );
                                       $wp_query = new \WP_Query($args_all);
                                       ?>
                                       <tbody class="cast-related-list">
                                          <?php
                                          if ($wp_query->have_posts()) {
                                             while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $r_movie_obj = get_the_ID();
                                                $movie_cast = get_post_meta($r_movie_obj, '_cast');
                                                $m_cast = $movie_cast[0];
                                                $found_key = array_search($cast_id, array_column($m_cast, 'id'));
                                                $attachement_url = wp_get_attachment_image_src(get_post_thumbnail_id($r_movie_obj), 'thumbnail')[0];
                                                if (isset($attachement_url) && !empty($attachement_url))
                                                   $attachement_url = $attachement_url;
                                                else
                                                   $attachement_url = '';
                                                $url_link  = get_post_permalink($r_movie_obj);
                                                $year = get_post_meta($r_movie_obj, '_movie_release_date');
                                                if (isset($year[0])) {
                                                   $year = date('Y', $year[0]);
                                                }
                                          ?>
                                                <tr class="trending-pills">
                                                   <td class="image"><img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>"></td>
                                                   <td class="seperator"><?php echo esc_html($counter); ?></td>
                                                   <td class="content">
                                                      <a href="<?php the_permalink(); ?>">
                                                         <?php the_title(); ?>
                                                      </a>
                                                      <span class="ml-2 group"> <?php esc_html_e('as', 'streamit'); ?>
                                                         <span class="character">
                                                            <?php echo esc_html($m_cast[$found_key]['character']); ?></span>
                                                      </span>
                                                   </td>
                                                   <td class="year"><?php echo esc_html($year, 'streamit'); ?></td>
                                                </tr>
                                          <?php
                                                $counter++;
                                             }
                                          }
                                          wp_reset_postdata(); ?>
                                       </tbody>
                                    </table>
                                    <?php
                                    if ($streamit_options['streamit_cast_use_infinite_scroll'] == 'infinite_scroll') {
                                       if ($wp_query->max_num_pages > 1) {
                                          echo '<div class="loader-wheel-container"></div>';
                                       }
                                    }
                                    ?>
                                 </div>
                                 <div id="tv_show" class="tab-pane fade streamit_cast_list" role="tabpanel" data-attibute="tv_show" data-current-page="1" data-options="<?php echo esc_attr($streamit_options['streamit_cast_use_infinite_scroll']); ?>">
                                    <table class="credit_group animated fadeInUp">
                                       <tbody class="cast-related-list">
                                          <?php
                                          $counter = 1;
                                          $args_all = array(
                                             'post_type' => 'tv_show',
                                             'post_status' => 'publish',
                                             'post__in' => $recommended_tv_show_cast_ids,
                                             'order'             => 'ASc',
                                             'posts_per_page'     => 10,
                                             'paged' => $paged,
                                             'suppress_filters'  => 0
                                          );
                                          $wp_query = new \WP_Query($args_all);
                                          if ($wp_query->have_posts()) {
                                             while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $r_movie_obj = get_the_ID();
                                                $meta = get_post_meta($r_movie_obj);
                                                $season_data = unserialize($meta['_seasons'][0]);
                                                $movie_cast = get_post_meta($r_movie_obj, '_cast');
                                                $m_cast = $movie_cast[0];
                                                $found_key = array_search($cast_id, array_column($m_cast, 'id'));
                                                if (!empty($season_data)) {
                                                   $season_years = array_column($season_data, 'year');
                                                   $start = count($season_years) ? min($season_years) : '';
                                                   $end = count($season_years) ? max($season_years) : '';
                                                   $season_count = count($season_data);
                                                   if ($season_count == '1') {
                                                      $year = $start;
                                                   } else {
                                                      if (!empty($start) && !empty($end)) {
                                                         $year = $start . ' - ' . $end;
                                                      }
                                                   }
                                                   if (is_array($season_data)) {
                                                      $censor_rating = ' (' . count($season_data) . ' Seasons) ';
                                                   }
                                                }
                                                $attachement_url = wp_get_attachment_image_src(get_post_thumbnail_id($r_movie_obj), 'thumbnail')[0];
                                                if (isset($attachement_url) && !empty($attachement_url))
                                                   $attachement_url = $attachement_url;
                                                else
                                                   $attachement_url = '';

                                          ?>

                                                <tr class="trending-pills">
                                                   <td class="image"><img src="<?php echo esc_url($attachement_url); ?>" class="img-fluid" alt="<?php esc_attr_e('streamit', 'streamit'); ?>"></td>
                                                   <td class="seperator"><?php echo esc_html($counter); ?></td>
                                                   <td class="content">
                                                      <a href="<?php the_permalink(); ?>">
                                                         <?php the_title(); ?>
                                                      </a>
                                                      <span class="ml-2 group"> <?php esc_html_e('as', 'streamit'); ?> <span class="character"><?php echo esc_html($m_cast[$found_key]['character']);
                                                                                                                                                echo esc_html($censor_rating); ?></span></span>
                                                   </td>
                                                   <td class="year"><?php echo esc_html($year); ?></td>
                                                </tr>
                                          <?php
                                                $counter++;
                                             }
                                          }
                                          wp_reset_postdata(); ?>
                                       </tbody>
                                    </table>
                                    <?php
                                    if ($streamit_options['streamit_cast_use_infinite_scroll'] == 'infinite_scroll') {
                                       if ($wp_query->max_num_pages > 1) {
                                          echo '<div class="loader-wheel-container"></div>';
                                       }
                                    }
                                    ?>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>


   </main>
   <!-- #main -->
</div>
<!-- .container -->

<?php get_footer();
