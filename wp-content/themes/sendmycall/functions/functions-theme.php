<?php
/**
 * Custom image size
 */

add_image_size( 'tabs_img', 612, 428 );
add_image_size( 'video_img', 685, 380 );
add_image_size( 'full_bg_img', 1920, 900 );
add_image_size( 'logo_img', 203, 46 );
add_image_size( 'icon_img', 20, 20 );
add_image_size( 'bg_img', 1920, 238 );
add_image_size( 'icon_title', 124, 124 );
add_image_size( 'sidebar_img', 250, 250 );

/**
 * Disable gutenberg
 */

add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 *  Archive page rewrite rule
 */

add_action('init', function () {
    add_rewrite_rule('toll-free/?$','index.php?pagename=toll-free', 'top');
    add_rewrite_rule('virtual-number/?$','index.php?pagename=virtual-number', 'top');
}, 1000);

/**
 *  Changed images url acf-flexible-content-preview plugin
 */

add_filter( 'acf-flexible-content-preview.images', function( $layouts_images ) {
    $layouts_images_new = [];
    foreach ($layouts_images as $key => $val ) {
        $layouts_images_new[$key] = get_stylesheet_directory_uri() . '/modules/' . $key . '/preview.jpg';
    }
    return $layouts_images_new;
} );

/**
 *  Register forwarding_rates post type
 */

add_action( 'init', 'register_forwarding_rates_post_type' );
function register_forwarding_rates_post_type() {

    $args = array(
        'labels' => array(
            'menu_name'     => __( 'Forwarding rates' ),
            'singular_name' => __( 'Forwarding rates' )
        ),
        'rewrite'   => array('slug' => 'forwarding-rates'),
        'public'    => true,
        'menu_icon' => 'dashicons-smartphone',
        'taxonomies' => array('country'),
    );
    register_post_type( 'forwarding_rates', $args );
}

/**
 *  Register taxonomy for forwarding_rates
 */

add_action( 'init', 'register_taxonomy_for_forwarding_rates' );
function register_taxonomy_for_forwarding_rates(){
    $args = array(
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'labels' => array(
            'name'                     => 'Countries',
            'singular_name'            => 'Country',
            'menu_name'                => 'Country',
            'all_items'                => 'All Countries',
            'edit_item'                => 'Edit country',
            'view_item'                => 'View country',
            'update_item'              => 'Update country',
            'add_new_item'             => 'Add new country',
            'new_item_name'            => 'New name country',
            'parent_item'              => 'Parent country',
            'parent_item_colon'        => 'Parent item colon country:',
            'search_items'             => 'Search country',
            'popular_items'            => 'Popular country',
            'add_or_remove_items'      => 'Add or remove country',
            'choose_from_most_used'    => 'Choose from most used country',
            'not_found'                => 'Not found',
            'back_to_items'            => '← Back to country',
        ),
        );
    register_taxonomy( 'country', 'forwarding_rates', $args);
    register_taxonomy_for_object_type( 'country', 'forwarding_rates');
}

/**
 *  Generate title for forwarding_rates post type
 */

add_action('save_post', 'save_forwarding_rates');
function save_forwarding_rates($post_id) {
    $data = get_post($post_id);
    if($data->post_type == 'forwarding_rates') {
        $forwarding_rates_options = get_field('forwarding_rates_options', $post_id);

        remove_action('save_post', 'save_forwarding_rates');

        $categories = get_the_terms($post_id, 'country');
        $post_title = '';
        $post_slug = '';
        $prefix = '';
        $network = '';
        if ( !empty($categories) ) {
            foreach ($categories as $value) {
                $post_slug .= $value->slug;
                $post_title .= $value->name;
            }
        }
        if (!empty($forwarding_rates_options['prefix'])) {
            $prefix .= $forwarding_rates_options['prefix'];
        }

        if (!empty($forwarding_rates_options['network'])) {
            $network .= $forwarding_rates_options['network'];
        }

        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $post_title .' '. $network .' '. $prefix,
            'post_name' => $post_slug .'-'. $network .'-'. $prefix
        ));

        add_action('save_post', 'save_forwarding_rates');
    }
}

/**
 *  Registering custom query_var
 */

add_filter('query_vars', 'registering_custom_query_var');
function registering_custom_query_var($query_vars)
{
    $query_vars[] = 'country';
    return $query_vars;
}

/**
 *  Register Google API key
 */
add_filter('acf/fields/google_map/api', 'acf_google_map_api');
function acf_google_map_api( $api ){
    $google_api_key  = get_field( 'google_api_key', 'options' );
    $api['key'] = $google_api_key;
    return $api;
}