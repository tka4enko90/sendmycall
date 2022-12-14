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
