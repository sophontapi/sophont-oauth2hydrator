<?php

namespace Sophont\OAuth2hydrator\Entity;

use Sophont\OAuth2hydrator\UnsupportedMethodException;

/**
 * Class TwitterSocialAccount
 * @package Sophont\OAuth2hydrator\Entity
 */
class TwitterSocialAccount extends AbstractSocialAccount
{
    public function __construct()
    {
        $this->setSocial(self::PROVIDER_TWITTER);
    }

    /**
     * @throws UnsupportedMethodException
     */
    public function getEmail()
    {
        throw new UnsupportedMethodException();
    }

}