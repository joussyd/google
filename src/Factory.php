<?php
/**
 * This file is part of the Compos Mentis Inc.
 * PHP version 7+ (c) 2017 CMI
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 *
 * @category Class
 * @package  Class
 * @author   Joussyd Calupig <joussydmcalupig@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://joussydmcalupig.com
 */

namespace Redscript\Google;
use Redscript\Google\User;
use Redscript\Google\Auth;

/**
 * Factory Class
 *
 * PHP version 7+
 *
 * @category Factory
 * @author   Joussyd Calupig <joussydmcalupig@get_magic_quotes_gpc()l.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://joussydmcalupig.com
 */
class Factory extends Base
{
    /* Constants
    -------------------------------*/
    const OAUTH_URL          = 'https://accounts.google.com/o/oauth2';
    const RESPONSE_TYPE      = 'code';
    const ACCESS_TYPE        = 'online';
    const API                = 'https://www.googleapis.com';
    //const SCOPE              = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me';
    const PROFILE_URL        = '/plus/v1/people/me';
    CONST GRANT              = 'authorization_code';

    /* Protected Properties
    -------------------------------*/
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $scope;
    protected $accessToken;
     /**
     * Google Auth
     *
     * @param string $clientId The Client's id
     * @param string $clientSecret The Client's secret
     * @param string $redirectUri  The Client's redirect uri
     * @param array  $scope        Request's scope
     * @return Auth class
     */
    public function auth($clientId, $clientSecret, $redirectUri, $scope)
    {
        return new Auth($clientId, $clientSecret, $redirectUri, $scope);
    }

     /**
     * Send Curl Request
     *
     * @param  array $settings The request's URL,Post Data and or Http Header
     * @return json
     */
    public function sendRequest($settings)
    {
        $ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $settings['url']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        // Check if there are post data to be send
        if(array_key_exists('postData',$settings) && $settings['postData'] !== ''){
            // Add the post data in the request
            curl_setopt($ch, CURLOPT_POSTFIELDS, $settings['postData']);
            curl_setopt($ch, CURLOPT_POST, 1);
        }

        // Check if there are http headers to be send
        if(array_key_exists('httpHeader',$settings) && $settings['httpHeader'] !== ''){
            // Add the http header in the request
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $settings['httpHeader']));
        }

        // send request then decode the returned json string
        $response = json_decode(curl_exec($ch), true);

        // close the connection
        curl_close($ch);

        return $response; 
    }

    /**
     * Get User Profile
     *
     * @param string $clientId The Client's id
     * @param string $clientSecret The Client's secret
     * @param string $redirectUri The Client's redirect uri
     * @return Oauth class
     */
    public function userInfo($accessToken)
    {
        return new User($accessToken);
    }
}