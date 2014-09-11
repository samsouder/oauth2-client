<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Token\AbstractToken;

interface ProviderInterface
{
    public function urlAuthorize();

    public function urlAccessToken();

    public function urlUserDetails(AbstractToken $token);

    public function userDetails($response, AbstractToken $token);

    public function getScopes();

    public function setScopes(array $scopes);

    public function getAuthorizationUrl($options = array());

    public function authorize($options = array());

    public function getAccessToken($grant = 'authorization_code', $params = array());

    public function getUserDetails(AbstractToken $token);

    public function getUserUid(AbstractToken $token);

    public function getUserEmail(AbstractToken $token);

    public function getUserScreenName(AbstractToken $token);
}
