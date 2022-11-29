<?php
/**
 * Custom image size
 */

add_image_size( 'tabs_img', 612, 428 );
add_image_size( 'video_img', 685, 380 );
add_image_size( 'full_bg_img', 1920, 900 );

/**
 * Disable gutenberg
 */

add_filter('use_block_editor_for_post', '__return_false', 10);

