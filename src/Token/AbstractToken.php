<?php

namespace League\OAuth2\Client\Token;

use League\OAuth2\Client\Token\TokenInterface;

abstract class AbstractToken implements TokenInterface
{
    /**
     * @var string accessToken
     */
    public $accessToken;

    /**
     * @var int expires
     */
    public $expires;

    /**
     * @var string refreshToken
     */
    public $refreshToken;

    /**
     * Sets the token, expiry, etc values.
     *
     * @param array $options token options
     * @return void
     */
    public function __construct(array $options = null)
    {
        if (! isset($options['access_token'])) {
            throw new \InvalidArgumentException(
                'Required option not passed: access_token'. PHP_EOL
                . print_r($options, true)
            );
        }

        $this->accessToken = $options['access_token'];

        // We need to know when the token expires. Show preference to 
        // 'expires_in' since it is defined in RFC6749 Section 5.1.
        // Defer to 'expires' if it is provided instead.
        if (!empty($options['expires_in'])) {
            $this->expires = time() + ((int) $options['expires_in']);
        } elseif (!empty($options['expires'])) {
            // Some providers supply the seconds until expiration rather than
            // the exact timestamp. Take a best guess at which we received.
            $this->expires = ($options['expires'] > time()) ? $options['expires'] : time() + ((int) $options['expires']);
        }

        // Grab a refresh token so we can update access tokens when they expire
        isset($options['refresh_token']) and $this->refreshToken = $options['refresh_token'];
    }

    /**
     * Returns the token key.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->accessToken;
    }
}
