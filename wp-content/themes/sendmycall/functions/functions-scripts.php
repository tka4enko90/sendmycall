<?php
add_action( 'wp_enqueue_scripts', 'main_script_and_style' );
function main_script_and_style(){
    wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/dist/js/main.js', array('jquery'), '', true);
    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/dist/css/main.css', array(), '', 'all');
}
