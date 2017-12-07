<?php
/**
 * This file is part of the Compos Mentis Inc.
 * PHP version 7+ (c) 2017 CMI
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 *
 * @category Class
 * @package  User
 * @author   Joussyd Calupig <joussydmcalupig@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://joussydmcalupig.com
 */
namespace Lethia\Google;
use Exception;

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
class User extends Factory
{
    /* Constants
    -------------------------------*/
    /* Public Methods
    -------------------------------*/
    /**
    * User constructor
    *
    * @param  string $access  Token Access Token
    */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Get User's Profile info
     *
     *
     * @return json
     */
    public function getProfile()
    {       
        // Check if the access token is not empty
        if(! empty($this->accessToken)){
            // If not empty, build settings
            $settings = array(
                'url'         => self::API . self::PROFILE_URL,
                'httpHeader' => $this->accessToken,
                'postData'   => ''
            );
            // send request
            $response = $this->sendRequest($settings);
            // return response
            return $response;
        }else{
            throw new Exception('No access token provided');
        }
    }
}