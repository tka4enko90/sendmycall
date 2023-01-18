<?php
namespace SendMyCall\Posts;

use SendMyCall\Posts\AbstractPosts;

class TollFree extends AbstractPosts {
    public function createChildPost($parent_ID, $country, $response = [])
    {
        if ($response) {
            foreach ($response as $toll_free) {
                $slug = $this->generateSlug($toll_free, $country, true);
                $post_exists = $this -> getPageBySlug( $slug , 'toll_free' );
                if ($post_exists) continue;
                $args = array(
                    'post_title' => $toll_free->attributes->area_name,
                    'post_name' => $slug,
                    'post_parent' => $parent_ID,
                    'post_type' => 'toll_free'
                );

                $this->insertPost($args, $toll_free);
            }
        }
    }

    public function setPosts() {
        if (!empty($this->DidwwAPI->getDIDGroupTypes('Toll-free'))) {
            $tollFreeID = $this->DidwwAPI->getDIDGroupTypes('Toll-free')[0]->id;
            $countries = $this->DidwwAPI->getCountries();
            foreach ($countries as $country) {
                $query = array(
                    'filter[country.id]' => $country->id,
                    'filter[did_group_type.id]' => $tollFreeID
                );
                $response = $this->DidwwAPI->getDIDGroupsByParams($query);

                if ($response) {
                    $slug = $this->generateSlug($country, false,false);
                    $post_exists = $this -> getPageBySlug( $slug , 'toll_free' );
                    if ($post_exists) {
//                        $this->createChildPost($post_exists->ID, $country, $response);
                        continue;
                    }
                    $args = array(
                        'post_title' => $country->attributes->area_name,
                        'post_name' => $slug,
                        'post_type' => 'toll_free'
                    );
                    $postID = $this->insertPost($args, $country);
//                    $this->createChildPost($postID, $country, $response);
                }
            }
        }
    }
}