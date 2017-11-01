<?php namespace cmi\googlesso;

/**
 * GoogleSignIn class for Sign In on Google using cURL
 *
 * 
 */
class GoogleSignIn
{
	/**
     * Generate the Google Login Url
     *
     *
     * @return string
     */
	public function GenerateLoginUrl($client_id, $client_redirect_url)
	{		
		// append scope in the Google's login url
		$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?scope=' 
		. urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') 
		. '&redirect_uri=' 
		. urlencode($client_redirect_url) . '&response_type=code&client_id=' 
		. $client_id . '&access_type=online';

		// return login url
		return $login_url;
	}

	/**
     * Get User's access token
     *
     * @param string $code     					The Google authorization code
     * @param string $client_id    			 	The App's Client ID
     * @param string $client_redirect_url     	The App's Client Redirect Url
     * @param string $client_secret		     	The App's Client Secret
     * @return string
     */
	public function GetAccessToken($code, $client_id, $client_redirect_url,$client_secret) {	

		$url = 'https://accounts.google.com/o/oauth2/token';			
		
		// request for access token
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $client_redirect_url . '&client_secret=' .$client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);		
		curl_setopt($ch, CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);

		// send request then decode the returned json string	
		$data = json_decode(curl_exec($ch), true);

		// get the request's return code
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);	

		// check if the return code is OK	
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');	

		// return access token
		return $data['access_token'];
	}

	/**
     * Get User's Basic Profile iInformation
     *
     * @param string $access_token     The User's access token
     * @return array
     */
	public function GetUserProfileInfo($access_token) {	

		$url = 'https://www.googleapis.com/plus/v1/people/me';			
		
		// request for user's basic profile info using the provided access tokene
		$ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));

		//send request then decode the returned json string
		$data = json_decode(curl_exec($ch), true);

		//get request's return code
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);	

		// check if the return code is OK	
		if( $http_code != 200 ) 
			throw new Exception('Error : Failed to get user information');
		
		//return user info
		return $data;
	}
}