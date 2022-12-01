<?php
/**
 * Custom image size
 */

add_image_size( 'tabs_img', 612, 428 );
add_image_size( 'video_img', 685, 380 );
add_image_size( 'full_bg_img', 1920, 900 );
add_image_size( 'logo_img', 203, 46 );
add_image_size( 'icon_img', 20, 20 );

/**
 * Disable gutenberg
 */

add_filter('use_block_editor_for_post', '__return_false', 10);

