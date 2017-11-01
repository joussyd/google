<?php

namespace Redscript\Google;
use Redscript\Google\User;

class Oauth extends Base
{
    /* Public Properties
    -------------------------------*/
    /* Protected Properties
    -------------------------------*/
    /* Private Properties
    -------------------------------*/
    /* Get
    -------------------------------*/
    /* Magic
    -------------------------------*/
    /* Public Methods
    -------------------------------*/
    public function __construct($client_id, $client_secret, $redirect_uri)
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
    }

    /**
     * Generate the Google Login Url
     *
     *
     * @return string
     */
    public function getLoginURL()
    {
        // append scope in the Google's login url
        $login_url = self::GOOGLE_OAUTH_URL . '/v2/auth?scope=' 
            . self::SCOPE
            . '&redirect_uri=' 
            . urlencode($this->redirect_url) 
            . '&response_type=' . self::RESPONSE_TYPE
            .'&client_id=' . $client_id 
            . '&access_type=' . self::ACCESS_TYPE;

        // return login url
        return $login_url;
    }

    /**
     * Get User's access token
     *
     * @param string $code                      The Google authorization code
     * @param string $client_id                 The App's Client ID
     * @param string $client_redirect_url       The App's Client Redirect Url
     * @param string $client_secret             The App's Client Secret
     * @return string
     */
    public function GetAccessToken($code)
    {    

        $url = self::GOOGLE_OAUTH_URL . '/token';            
        
        // request for access token
        $post_data = 'client_id=' . $this->client_id 
            . '&redirect_uri=' . $this->redirect_url 
            . '&client_secret=' .$this->client_secret 
            . '&code='. $code 
            . '&grant_type=authorization_code';

        $settings = array(
            'url'=> $url,
            'post_data' => $post_data
        );

        $response = Factory::sendRequest($url, $post_data);
    }

     /**
     * Get the User's Info
     *
     *
     * @return array
     */
    public function getUserInfo($access_token)
    {
        return User::_getUserInfo($access_token);
    }
}