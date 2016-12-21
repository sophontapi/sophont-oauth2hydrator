<?php

namespace Sophont\OAuth2hydrator;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Zend\EventManager\Event;

/**
 * Class SocialAccountEvent
 * @package Sophont\OAuth2hydrator
 */
class SocialAccountEvent extends Event
{
    const EVENT_SOCIAL_ACCOUNT_READY = "onSocialAccountReady";

    const EVENT_SOCIAL_CODE_READY = "onCodeReady";

    /** @var AbstractSocialAccount $socialAccount */
    protected $socialAccount;

    /** @var string $code */
    protected $code;

    /** @var string $provider */
    protected $provider;

    /**
     * @param AbstractSocialAccount $socialAccount
     * @return $this
     */
    public function setSocialAccount(AbstractSocialAccount $socialAccount)
    {
        $this->socialAccount = $socialAccount;

        return $this;
    }

    /**
     * @return AbstractSocialAccount
     */
    public function getSocialAccount()
    {
        return $this->socialAccount;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param $provider
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }
}