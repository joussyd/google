<?php

namespace Redscript\Google;
use Redscript\Google\Util;
use Redscript\Google\User;
use Redscript\Google\Oauth;

class Factory extends Base
{
     /**
     * Google Auth
     *
     *
     * @return Oauth class
     */
	public function auth($client_id, $client_secret, $redirect_uri, $state, $scope)
	{
		return new Oauth($client_id, $client_secret, $redirect_uri);
	}

     /**
     * Send Curl Request
     *
     *
     * @return json
     */
	public function sendRequest($settings)
	{
        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $settings['url']);        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        
        curl_setopt($ch, CURLOPT_POST, 1);      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Check if there are post data to be send
        if($settings['post_data']){
            // Add the post data in the request     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $settings['post_data']);
        }

        // Check if there are http headers to be send
        if($settings['http_header']){
            // Add the http header in the request
            curl_setopt($ch, CURLOPT_HTTPHEADER, $settings['http_header']);
        }

        // send request then decode the returned json string    
        $response = json_decode(curl_exec($ch), true);

        // get the request's return code
        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);  	

        // check if the return code is OK	
        if($http_code != 200) {
            die('Error : Failed to receieve response from: ' . $url);	
        }

        // close the connection
        curl_close($curl);

        return $response; 
	}

}