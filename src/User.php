<?php

namespace Redscript\Google;
use Redscript\Google\Util;

class User 
{

	const USER_INFO_URL = 'https://graph.Google.com/me?fields=&fields=id,email,cover,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified&access_token=';


	/**
     * Get User's Basic info
     *
     *
     * @return json
     */
    public function getUserInfo($access_token)
    {
        $url = self::USER_INFO_URL . $access_token;
        $post = '';

        return Util::sendRequest($url,$post);
    }
}