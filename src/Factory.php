<?php

namespace Redscript\Google;
use Redscript\Google\Util;
use Redscript\Google\User;
use Redscript\Google\Oauth;

class Factory 
{

	const FB_URL = 'https://www.Google.com/v2.10/dialog/oauth?';

	protected $client_id;
	protected $redirect_uri;
	protected $state;
	protected $scope;

	public function __construct($client_id, $client_secret, $redirect_uri, $state, $scope)
	{
		if (!empty($client_id)) {
			$this->client_id = $client_id;
		}else{
			die('Error: Client id cannot be empty');
		}

		if (!empty($client_secret)) {
			$this->client_secret = $client_secret;
		}else{
			die('Error: Client secret cannot be empty');
		}

		if (!empty($redirect_uri)) {
			$this->redirect_uri = $redirect_uri;	
		}else{
			die('Error: Redirect Uri cannot be empty');
		}

		if (!empty($state)) {
			$this->state = $state;	
		}else{
			die('Error: tate cannot be empty');
		}

		if (!empty($scope)) {
			$this->scope = $scope;	
		}else{
			die('Error: Scope cannot be empty');
		}
	}


	/**
     * Get Access token
     *
     *
     * @return string
     */
    public function getAccessToken($code)
    {
    	return Oauth::getAccessToken( 
    		$code, 
    		$this->client_id, 
    		$this->client_secret, 
    		$this->redirect_uri
    	);
    }



	/**
     * Generate the Faceboook Login Url
     *
     *
     * @return string
     */
	public function getLoginURL()
    {
		$loginUrl = Util::generateLoginURL(self::FB_URL, $this->client_id, $this->redirect_uri, 
			$this->state, $this->scope);

		return $loginUrl;
    }

    /**
     * Get the User's Info
     *
     *
     * @return array
     */
    public function getUserInfo($access_token)
    {
    	return User::getUserInfo($access_token);
    }


}