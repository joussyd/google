<?php
/**
 * This file is part of the Compos Mentis Inc.
 * PHP version 7+ (c) 2017 CMI
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 *
 * @category Class
 * @package  Auth
 * @author   Joussyd Calupig <joussydmcalupig@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://joussydmcalupig.com
 */
namespace Redscript\Google;
use Redscript\Google\User;

/**
 * Factory Class
 *
 * PHP version 7+
 *
 * @category Class
 * @author   Joussyd Calupig <joussydmcalupig@get_magic_quotes_gpc()l.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://joussydmcalupig.com
 */
class Auth extends Factory
{
    /* Public Methods
    -------------------------------*/
    /**
     * 
     * @param string $clientId      The Client id
     * @param string $clientSecret  The Client secret
     * @param string $redirectUri   The Client redirect Uri
     * @param array  $scope         Request's Scope
     * @return string
     */
    public function __construct($clientId, $clientSecret, $redirectUri, $scope)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
        $this->scope = $scope;
    }

    /**
     * Generate the Google Login Url
     *
     *
     * @return string
     */
    public function getLoginURL()
    {
        //  build request url
        $url = self::OAUTH_URL . '/v2/auth?';

        //get scope 
        $scope = $this->scope;

        // append google api url to scopes
        array_walk($scope, function(&$value, $key) { 
                $value = self::API . $value; 
        });

        // convert array to string delimited by space
        $scopeList = implode(' ', $scope);

        // build query parameters
        $params = array(
            'scope'=> $scopeList,
            'redirect_uri'=> $this->redirectUri,
            'response_type' => self::RESPONSE_TYPE,
            'client_id' => $this->clientId,
            'access_type' => self::ACCESS_TYPE
        );

        // append parameters to the url
        $loginUrl = $url . http_build_query($params);

        // return login url
        return $loginUrl;
    }

    /**
     * Get User's access token
     *
     * @param string $code  The Google authorization code
     * @return string
     */
    public function getAccessToken($code)
    {    
        // google oauth url
        $url = self::OAUTH_URL . '/token';

        // build params array
        $params = array(
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirectUri,
            'client_secret' => $this->clientSecret,
            'code'          => $code,
            'grant_type'    => self::GRANT
        );

        // build query
        $postData = http_build_query($params);

        // crete settings
        $settings = array(
            'url'         => $url,
            'postData'   => $postData,
            'httpHeader' => ''
        );
        // send request
        $response = $this->sendRequest($settings);

        // return access token
        return $response['access_token'];
    }
}