<?php
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page(
        array(
            'page_title' => 'Site Settings',
            'menu_title' => 'Site Settings',
            'menu_slug'  => 'site-settings',
            'capability' => 'edit_posts',
            'position'   => 2,
            'redirect'   => false,
            'autoload'   => true,
        )
    );
}