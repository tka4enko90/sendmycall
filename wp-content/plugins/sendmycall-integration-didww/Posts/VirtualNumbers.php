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
        $cities = $this->get_cities([], $query);

        foreach ($cities as $city) {

            $slug = $this->generateSlug($city, $country, true, 'virtual_number');
            if ( !$slug ) continue;
            $args = array(
                'post_title' => $city->attributes->area_name,
                'post_name' => $slug,
                'post_parent' => $parent_ID
            );

            $this->insertPost($args, $city);
        }
    }

    public function get_cities( $cities, $query ) {
        $result = $this->DidwwAPI->getDIDGroupsByParams($query, false);
        $cities = array_merge($cities, (array)$result->data);

        if (property_exists($result->links, 'next')) {
            $query['page[number]']++;
            return $this->get_cities($cities, $query);
        }

        return $cities;
    }

    public function setPosts() {
        $countries = $this->DidwwAPI->getCountries();

        foreach ($countries as $country) {
            $slug = $this->generateSlug($country, false, false, 'virtual_number');

            if ( !$slug ) continue;

            $arguments = array(
                'post_title' => $country->attributes->name,
                'post_name' => $slug
            );


            $postID = $this->insertPost($arguments, $country);

            $this->createChildPost($postID, $country);
        }
    }
}