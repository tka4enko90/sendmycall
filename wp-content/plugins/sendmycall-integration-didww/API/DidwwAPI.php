<?php
namespace SendMyCall\API;

class DidwwAPI {
    const CONVERSION_DATA_API = 'https://api.didww.com/v3';
    public $groups = [];

    public function __construct()
    {
        $this->getDIDGroupTypes();
    }
    public function getCountries() {
        $url = self::CONVERSION_DATA_API.'/countries';
        $query = add_query_arg( array(
            'filter[is_available]' => true,
        ), $url );

        return $this->fetchRequest($query)->data;
    }

    public function getDIDGroupsByParams($params) {
        $url = self::CONVERSION_DATA_API.'/did_groups';
        $query = add_query_arg($params, $url );
        $result = $this->fetchRequest($query);
        $this->groups = array_merge($this->groups, $result->data);
        if (property_exists($result->links, 'next')) {
            $params['page[number]'] += 1;
            return $this->getDIDGroupsByParams($params);
        }
        $groups = $this->groups;
        $this->groups = [];
        return $groups;
    }

    public function getDIDGroupTypes($name = false) {
        $url = self::CONVERSION_DATA_API.'/did_group_types';
        $query = add_query_arg( array(
            'filter[name]' => $name,
        ), $url );
        return $this->fetchRequest($query)->data;
    }

    protected function getDIDGroupByCountryIDGroupID($countryID, $groupID) {
        $url = self::CONVERSION_DATA_API.'/did_groups';
        $query = add_query_arg( array(
            'filter[name]' => $name,
        ), $url );
        return $this->fetchRequest($query)->data;
    }

    private function fetchRequest($additional) {
        $headers =  array(
            'timeout' => "600",
            'headers' => array(
                'Accept' => 'application/vnd.api+json',
                'Api-Key' => 'ddx7u1tv9a96yz1tem1dk26pru15pjze',
            )
        );
        $response = wp_remote_get( $additional, $headers );
        if (isset($response['response']['code']) && $response['response']['code'] == '200') {
            return json_decode($response['body'], false);
        }
        return [];
    }
}
