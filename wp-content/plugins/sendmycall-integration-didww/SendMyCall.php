<?php
/**
 * Plugin Name:       SendMyCall : Integration with DIDWW
 * Version:           1.0
 * Author:            Markupus
 */
require "vendor/autoload.php";

use SendMyCall\RegisterFields;
use SendMyCall\Posts\TollFree;
use SendMyCall\Posts\VirtualNumbers;

if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

}


class SendMyCall {

    public static function getInstance() {
        return new static();
    }

    private function __construct()
    {

        new RegisterFields();
        add_action( 'init', array($this, 'createPostTypes'));
        add_action( 'send_my_call_cron_hook', array($this,'runPostsUpdate'));
        if ( is_admin() && ! wp_next_scheduled( 'send_my_call_cron_hook' ) ) {
            wp_schedule_event( time(), 'weekly', 'send_my_call_cron_hook' );
        }
    }

    public function runPostsUpdate() {
//        $TollFree = new TollFree();
        $VirtualNumbers = new VirtualNumbers();
//        $TollFree->setPosts();
        $VirtualNumbers->setPosts();
    }
    /**
     * Deactivation hook.
     */
    public static function pluginSendMyCallDeactivate() {

        wp_clear_scheduled_hook( 'send_my_call_cron_hook' );
        unregister_post_type( 'virtual_number' );
        unregister_post_type( 'toll_free' );
        flush_rewrite_rules();
    }
    /**
     * Activate the plugin.
     */
    public function pluginSendMyCallActivate() {

        $this->runPostsUpdate();
    }

    public function createPostTypes() {

        if (function_exists('register_post_type')) {
            register_post_type( 'virtual_number',
                array(
                    'labels' => array(
                        'name'          => __( 'Virtual numbers' ),
                        'singular_name' => __( 'Virtual number' )
                    ),
                    'public'            => true,
                    'hierarchical'      => true,
                    'has_archive'       => true,
                    'rewrite'           => array('slug' => 'virtual-number'),
                    'show_in_rest'      => true,
                    'menu_icon'         => 'dashicons-smartphone',
                    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
                )
            );
            register_post_type( 'toll_free',
                array(
                    'labels' => array(
                        'name'              => __( 'Toll free' ),
                        'singular_name'     => __( 'Toll free' )
                    ),
                    'public'                => true,
                    'hierarchical'          => true,
                    'has_archive'           => true,
                    'rewrite'               => array('slug' => 'toll-free'),
                    'show_in_rest'          => true,
                    'menu_icon'             => 'dashicons-book',
                    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes' ),
                )
            );
        }


    }
}
if ( ! is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    add_action('admin_notices', 'require_acf_network_plugin');
    deactivate_plugins('sendmycall/SendMyCall.php');
    return;
}
function require_acf_network_plugin(){?>
    <div class="notice notice-error" >
        <p> Please Enable ACF Plugin before using SendMyCall Plugin.</p>
    </div><?php
    @trigger_error(__('Please Enable ACF Network Options Plugin before using SendMyCall Plugin.', 'SendMyCall'), E_USER_ERROR);
}


$SendMyCall = SendMyCall::getInstance();

register_deactivation_hook(
    __FILE__,
    array(
        $SendMyCall,
        'pluginSendMyCallDeactivate'
    )
);

register_activation_hook(
    __FILE__,
    array(
        $SendMyCall,
        'pluginSendMyCallActivate'
    )
);


