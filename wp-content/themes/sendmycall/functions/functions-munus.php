<?php
function nav_menus() {
    register_nav_menu( 'main-menu', __( 'Main Menu', 'sendmycall' ) );
    register_nav_menu( 'top-bar-menu', __( 'Top bar Menu', 'sendmycall' ) );
    register_nav_menu( 'header-mobile-menu', __( 'Header Mobile Menu', 'sendmycall' ) );
    register_nav_menu( 'footer-company', __( 'Footer Company', 'sendmycall' ) );
    register_nav_menu( 'footer-legal', __( 'Footer Legal', 'sendmycall' ) );
    register_nav_menu( 'footer-resources', __( 'Footer Resources', 'sendmycall' ) );
    register_nav_menu( 'footer-contact-us', __( 'Contact us', 'sendmycall' ) );
}
add_action( 'init', 'nav_menus' );