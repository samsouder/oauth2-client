<?php

namespace League\OAuth2\Client\Token;

use InvalidArgumentException;
use League\OAuth2\Client\Token\AbstractToken;

class AccessToken extends AbstractToken
{
    /**
     * @var  string  uid
     */
    public $uid;

    /**
     * Sets the token, expiry, etc values.
     *
     * @param  array $options token options
     * @return void
     */
    public function __construct(array $options = null)
    {
        parent::__construct($options);

        // Some providers (not many) give the uid here, so lets take it
        isset($options['uid']) and $this->uid = $options['uid'];

        // Vkontakte uses user_id instead of uid
        isset($options['user_id']) and $this->uid = $options['user_id'];

        // Mailru uses x_mailru_vid instead of uid
        isset($options['x_mailru_vid']) and $this->uid = $options['x_mailru_vid'];
    }
}
