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

global $episode;

if (!$episode || !($episode->has_sources())) {
    return;
}

$sources = $episode->get_sources();

?>
<div class="source-list-content">
<table class="episode-sources sources-table">
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
            if (empty($source['embed_content'])) {
                continue;
            }
            ?>
            <tr>
                <td>
                    <?php masvideos_template_single_episode_play_source_link($source); ?>
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
                    <?php if (!empty($source['player'])) {
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