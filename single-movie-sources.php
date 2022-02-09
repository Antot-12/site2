<?php

/**
 * Sources Template
 *
 * @package WordPress
 * @subpackage streamit
 * @since 1.0
 * @version 1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $movie;

if (!$movie || !($movie->has_sources())) {
    return;
}

$sources = $movie->get_sources();

?>
<div class="source-list-content">
<table class="movie-sources sources-table">
    <thead class="trending-pills">
        <tr>
            <th><?php echo esc_html__('Links', 'streamit') ?></th>
            <th><?php echo esc_html__('Quality', 'streamit') ?></th>
            <th><?php echo esc_html__('Language', 'streamit') ?></th>
            <th><?php echo esc_html__('Player', 'streamit') ?></th>
            <th><?php echo esc_html__('Date Added', 'streamit') ?></th>
        </tr>
    </thead>
    <tbody class="trending-pills">
        <?php foreach ($sources as $key => $source) : ?>
            <?php
            if (empty($source['embed_content']) && empty($source['link'])) {
                continue;
            }
            ?>
            <tr>
                <td>
                    <?php
                    $source_content = ($source['choice'] == 'movie_url') ? $source['link'] : $source['embed_content'];

                    if (isset($source['is_affiliate']) && $source['is_affiliate'] && !empty($source_content)) {
                    ?>
                        <a href="<?php echo esc_url($source_content); ?>" class="play-source movie-affiliate-play-source btn-hover iq-button" target="_blank"><i class="fas fa-play mr-2" aria-hidden="true"></i>
                            <?php echo apply_filters('masvideos_movie_play_source_text', esc_html__('Play Now', 'streamit')); ?>
                        </a>
                    <?php
                    } else {
                        $source_content = apply_filters('the_content', $source_content);
                    ?>
                        <a href="#" class="play-source movie-play-source btn-hover iq-button" data-content="<?php echo esc_attr(htmlspecialchars($source_content)); ?>"><i class="fas fa-play mr-2" aria-hidden="true"></i>
                            <?php echo apply_filters('masvideos_movie_play_source_text', esc_html__('Play Now', 'streamit')); ?>
                        </a>
                    <?php
                    } ?>
                </td>
                <td>
                    <?php if (!empty($source['quality'])) {
                        echo wp_kses_post($source['quality']);
                    } ?>
                </td>
                <td>
                    <?php if (!empty($source['language'])) {
                        echo wp_kses_post($source['language']);
                    } ?>
                </td>
                <td>

                    <?php
                    if (!empty($source['player'])) {
                        echo wp_kses_post($source['player']);
                    } ?>
                </td>
                <td>
                    <?php if (!empty($source['date_added'])) {
                        echo wp_kses_post($source['date_added']);
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>