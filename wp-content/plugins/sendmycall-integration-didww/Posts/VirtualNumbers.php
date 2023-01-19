<?php
namespace SendMyCall\Posts;

use SendMyCall\Posts\AbstractPosts;

class VirtualNumbers extends AbstractPosts {

    public function createChildPost($parent_ID, $country)
    {
        $query = array(
            'filter[country.id]' => $country->id,
            'page[number]' => 1
        );
        $cities = $this->DidwwAPI->getDIDGroupsByParams($query);
        foreach ($cities as $city) {
            $slug = $this->generateSlug($city, $country, true);
            $post_exists = $this -> getPageBySlug( $slug , 'virtual_number' );

            if (!empty($post_exists)) continue;

            $args = array(
                'post_title' => $city->attributes->area_name,
                'post_name' => $slug,
                'post_parent' => $parent_ID
            );

            $this->insertPost($args, $city);
        }
    }

    public function setPosts() {
        $countries = $this->DidwwAPI->getCountries();

        foreach ($countries as $country) {
            $slug = $this->generateSlug($country, false, false);

            $post_exists = $this -> getPageBySlug( $slug , 'virtual_number' );
            if ($post_exists) {
                $this->createChildPost($post_exists->ID, $country);
                continue;
            }

            $arguments = array(
                'post_title' => $country->attributes->name,
                'post_name' => $slug
            );


            $postID = $this->insertPost($arguments, $country);

            $this->createChildPost($postID, $country);
        }
    }
}