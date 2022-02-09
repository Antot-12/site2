<?php

/**
 * Template part for displaying the Breadcrumb 
 *
 * @package streamit
 */

namespace Streamit\Utility;

if (is_front_page()) {
    if (is_home()) { ?>
        <div class="iq-breadcrumb-one">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-sm-12">
                        <h1 class="title"><?php esc_html_e('Home', 'streamit'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
<?php }
}
streamit()->streamit_inner_breadcrumb();
?>