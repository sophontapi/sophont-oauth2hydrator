<?php

namespace Sophont\OAuth2hydrator\Service;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Sophont\OAuth2hydrator\Entity\FacebookSocialAccount;

class TestDataOAuth2ProviderService extends AbstractOAuth2ProviderService
{
    const TEST_SOCIAL_PROVIDER = AbstractSocialAccount::PROVIDER_FACEBOOK;

    /**
     * @return string
     */
    public function authorizationUrl()
    {
        return sprintf(
            "http://meets-hub.com/oauth2/%s/access-token?code=123",
            self::TEST_SOCIAL_PROVIDER
        );
    }

    /**
     * @param $code
     * @return string
     */
    public function fetchAccessToken($code)
    {
        return 'as665dasd5asd45';
    }

    /**
     * @param $accessToken
     * @return mixed
     */
    public function fetchUserData($accessToken)
    {
        return $this->config['debug_data'];
    }

    /**
     * Use facebook as a test provider
     * @return string
     */
    public function getProviderName()
    {
        return self::TEST_SOCIAL_PROVIDER;
    }

    /**
     * @return FacebookSocialAccount
     */
    public function getEntity()
    {
        return new FacebookSocialAccount();
    }
}