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

add_filter( 'acf-flexible-content-preview.images_path', 'assets/img' );

