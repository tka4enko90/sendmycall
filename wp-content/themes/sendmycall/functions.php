<?php
$include_folders = array(
    'functions/',
    'functions/post_types/',
    'functions/acf/',
);

foreach ( $include_folders as $inc_folder ) {
    $include_folder = get_stylesheet_directory() . '/' . $inc_folder;
    foreach ( glob( $include_folder . '*.php' ) as $file ) {
        include_once $file;
    }
}
