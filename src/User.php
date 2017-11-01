<?php

namespace Redscript\Google;

class User extends Base
{
	/**
     * Get User's Basic info
     *
     *
     * @return json
     */
    public function _getUserInfo($access_token)
    {       
        $settings = array(
            'url'=> self::GOOGLE_PROFILE_URL,
            'http_header' => array('Authorization: Bearer '. $access_token)
        );

        $response = Factory::sendRequest($settings);

        return $response;
    }
}