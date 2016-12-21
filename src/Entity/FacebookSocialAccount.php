<?php

namespace Sophont\OAuth2hydrator\Entity;

/**
 * Class FacebookSocialAccount
 * @package Sophont\OAuth2hydrator\Entity
 */
class FacebookSocialAccount extends AbstractSocialAccount
{
    public function __construct()
    {
        $this->setSocial(self::PROVIDER_FACEBOOK);
    }
}