<?php
add_filter('pt-ocdi/import_files', 'streamit_import_files');
add_action('pt-ocdi/after_import', 'streamit_after_import_setup');

function streamit_import_files()
{
    return array(
        array(
            'import_file_name'             => esc_html__('All Content', 'streamit'),
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit(get_template_directory()) . 'inc/Import/Demo/streamit_redux.json',
                    'option_name' => 'streamit_options',
                ),
            ),
            'local_import_file'            => trailingslashit(get_template_directory()) . 'inc/Import/Demo/streamit-content.xml',
            'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'inc/Import/Demo/streamit-widget.wie',
            'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'inc/Import/Demo/streamit-export.dat',

            'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
            'import_notice' => esc_html__('DEMO IMPORT REQUIREMENTS: Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds. ', 'streamit') . '</br></br>' . esc_html__('Based on your INTERNET SPEED it could take 5 to 25 minutes. ', 'streamit'),
            'preview_url'                  => 'https://wordpress.iqonic.design/product/wp/streamit',
        ),
    );
}

function streamit_after_import_setup($selected_import)
{

    // Assign menus to their locations.
    $locations = get_theme_mod('nav_menu_locations'); // registered menu locations in theme
    $menus = wp_get_nav_menus(); // registered menus

    if ($menus) {
        foreach ($menus as $menu) { // assign menus to theme locations

            if ($menu->name == 'Main Menu') {
                $locations['top'] = $menu->term_id;
            }
        }
    }
    set_theme_mod('nav_menu_locations', $locations); // set menus to locations 

    if ('All Content' === $selected_import['import_file_name']) {

        $front_page_id = get_page_by_title('Streamit');
        $blog_page_id  = get_page_by_title('Blog');


        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);
    }

    // remove default post
    wp_delete_post(1, true);
    global $query_posts;
    $query_posts = new WP_Query(array(
        'nopaging' => true,
        'post_type' => array('movie', 'tv_show', 'video', 'post', 'person')
    ));
    while ($query_posts->have_posts()) :
        $query_posts->the_post();
        wp_update_post(array(
            'ID' => get_the_ID(),
            'post_content' => get_the_content(),
        ));
    endwhile;
}
