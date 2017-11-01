<?php

namespace Redscript\Google;

class Util
{

    /**
     * Send Curl Request
     *
     *
     * @return json
     */
	public function sendRequest($url, $post)
	{
		$curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $json_response = curl_exec($curl);

        curl_close($curl);

        return $json_response;
	}



    /**
     * Generate the Faceboook Login Url
     *
     *
     * @return string
     */
    public function generateLoginURL($client_id, $client_redirect_url)
    {
        $login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' 
        . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') 
        . '&redirect_uri=' 
        . urlencode($client_redirect_url) . '&response_type=code&client_id=' 
        . $client_id . '&access_type=online';

        // return login url
        return $login_url;
    }
}
