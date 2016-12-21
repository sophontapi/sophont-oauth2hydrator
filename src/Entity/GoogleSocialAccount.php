<?php

namespace Sophont\OAuth2hydrator\Entity;

/**
 * Class GoogleSocialAccount
 * @package Sophont\OAuth2hydrator\Entity
 */
class GoogleSocialAccount extends AbstractSocialAccount
{
    public function __construct()
    {
        $this->setSocial(self::PROVIDER_GOOGLE);
    }
}