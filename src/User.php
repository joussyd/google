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
        // Check if the access token is not empty
        if(! empty($access_token)){

            // If not empty, build settings
            $settings = array(
                'url'         => self::GOOGLE_PROFILE_URL,
                'http_header' => $access_token,
                'post_data'   => ''
            );

            //send request
            $response = Factory::sendRequest($settings);

            // return response
            return $response;
        }else{
            return null;
        }
    }
}