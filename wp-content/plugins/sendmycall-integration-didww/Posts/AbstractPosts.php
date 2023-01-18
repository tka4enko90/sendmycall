<?php
namespace SendMyCall\Posts;

use SendMyCall\API\DidwwAPI;

abstract class AbstractPosts {
    public $DidwwAPI;

    public function __construct()
    {
        $this-> DidwwAPI = new DidwwAPI();
    }

    protected function generateSlug($post,  $country = false, $child = false) {
        $slug = str_replace(" ", "-", $post->attributes->name);

        if ($child && $country) {

            $slug .=  $post->attributes->area_name.'_(' . $country->attributes->prefix . '-' . $post->attributes->prefix . ')';

        }

        return $slug;
    }
    protected function insertPost($args, $params) {

        $post_obj = array(
            'post_title' => '',
            'post_name' => '',
            'post_status' => 'publish',
            'post_author' => 1,
            'post_type' => 'virtual_number'
        );
        $post_obj = array_merge($post_obj, $args);

        $postID = wp_insert_post($post_obj);

        if (isset($params->id)) {
            update_field('country_id', $params->id, $postID);
        }
        if (isset($params->attributes->iso)) {
            update_field('iso', $params->attributes->iso, $postID);
        }
        if (isset($params->attributes->prefix)) {
            update_field('prefix', $params->attributes->prefix, $postID);
        }
        return $postID;
    }

    function getPageBySlug($page_slug,  $post_type = 'virtual_number' ) {
        global $wpdb;
        $page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type ) );
        if ( $page )
            return get_post($page);
        return false;
    }

    abstract public function createChildPost($parent_ID, $country);
    abstract public function setPosts();
}