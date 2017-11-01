<?php

namespace Redscript\Google;
use Redscript\Google\Factory;

class Base 
{
	/* Constants
    -------------------------------*/
	const GOOGLE_OAUTH_URL   = 'https://accounts.google.com/o/oauth2';
	const RESPONSE_TYPE      = 'code';
    const ACCESS_TYPE        = 'online';
    const SCOPE              = urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me');
    const GOOGLE_PROFILE_URL = 'https://www.googleapis.com/plus/v1/people/me';

	/* Public Properties
    -------------------------------*/
    /* Protected Properties
    -------------------------------*/
    protected $client_id;
	protected $client_secret;
	protected $redirect_uri;
	
    /* Private Properties
    -------------------------------*/
    /* Get
    -------------------------------*/
    /* Magic
    -------------------------------*/
    /* Public Methods
    -------------------------------*/
    /* Protected Methods
    -------------------------------*/
}