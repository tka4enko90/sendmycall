<?php
wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/dist/js/main.js', array( 'jquery' ), '', true );
wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/dist/css/main.css', array(), '', 'all' );