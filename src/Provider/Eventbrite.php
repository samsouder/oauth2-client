<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Entity\User;

class Eventbrite extends AbstractProvider
{

    public function __construct($options)
    {
        parent::__construct($options);
        $this->headers = array(
            'Authorization' => 'Bearer'
        );
    }

    public function urlAuthorize()
    {
        return 'https://www.eventbrite.com/oauth/authorize';
    }

    public function urlAccessToken()
    {
        return 'https://www.eventbrite.com/oauth/token';
    }

    public function urlUserDetails(\League\OAuth2\Client\Token\AbstractToken $token)
    {
        return 'https://www.eventbrite.com/json/user_get?access_token='.$token;
    }

    public function userDetails($response, \League\OAuth2\Client\Token\AbstractToken $token)
    {
        $user = new User;
        $user->exchangeArray(array(
            'uid' => $response->user->user_id,
            'email' => $response->user->email,
        ));

        return $user;
    }

    public function userUid($response, \League\OAuth2\Client\Token\AbstractToken $token)
    {
        return $response->user->user_id;
    }

    public function userEmail($response, \League\OAuth2\Client\Token\AbstractToken $token)
    {
        return isset($response->user->email) && $response->user->email ? $response->user->email : null;
    }

    public function userScreenName($response, \League\OAuth2\Client\Token\AbstractToken $token)
    {
        return $response->user->user_id;
    }
}
