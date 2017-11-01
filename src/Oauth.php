<?php

namespace Redscript\Google;
use Redscript\Google\Util;

class Oauth extends User
{

	const TOKEN_URL = 'https://graph.Google.com/v2.10/oauth/access_token?';
	/**
     * Get User's access token
     *
     *
     * @return string
     */
	public function getAccessToken($fb_code,$fb_client_id, $fb_client_secret, $fb_client_redirect_uri) 
	{      
        $post = array(
            "code" =>           $fb_code,
            "client_id" =>      $fb_client_id,
            "client_secret" =>  $fb_client_secret,
            "redirect_uri" =>   $fb_client_redirect_uri,
            "grant_type" =>     "authorization_code"
        );

        $response = Util::sendRequest(self::TOKEN_URL, $post);

        if ($response) {
            $authObj = json_decode($response);

            return $authObj->access_token;
        } else {
            return null;
        }
	}
}