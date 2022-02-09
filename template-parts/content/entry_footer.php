<?php

/**
 * Template part for displaying a post's footer
 *
 * @package streamit
 */

namespace Streamit\Utility;

?>
<div class="blog-button">
    <?php
    if (!is_single()) {
        get_template_part('template-parts/content/entry_actions', get_post_type());
    }
    ?>
</div>
<?php
if (!is_single()) {
    get_template_part('template-parts/content/entry_taxonomies', get_post_type());
    echo "</div><!-- .entry-footer -->";
}
