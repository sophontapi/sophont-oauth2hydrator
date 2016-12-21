<?php

namespace Sophont\OAuth2hydrator\Service;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Sophont\OAuth2hydrator\Entity\FacebookSocialAccount;
use Zend\Json\Json;

/**
 * Class FacebookOAuth2ProviderService
 * @package Sophont\OAuth2hydrator\Service
 */
class FacebookOAuth2ProviderService extends AbstractOAuth2ProviderService
{
    /**
     * @return string
     */
    public function getProviderName()
    {
        return AbstractSocialAccount::PROVIDER_FACEBOOK;
    }

    /** @var string */
    protected $accessToken;

    /** Auth dialog */
    const AUTH_URL = 'https://www.facebook.com/dialog/oauth?client_id=%d&redirect_uri=%s&response_type=code';

    /** Access token url */
    const ACCESS_TOKEN_URL = 'https://graph.facebook.com/oauth/access_token?client_id=%d&redirect_uri=%s&client_secret=%s&code=%s';

    /** @var string fields to be fetched */
    private $fields = 'fields=id,first_name,last_name,email';

    /**
     * Get url to authorize application for an access to user's facebook account
     *
     * @return string
     * @throws \Sophont\OAuth2hydrator\InvalidProviderException
     */
    public function authorizationUrl()
    {
        $credentials = $this->getProviderConfig();
        return $uri = sprintf(self::AUTH_URL, $credentials['app_id'], $this->getRedirectUri());
    }

    /**
     * @param $code
     * @return mixed
     * @throws \Sophont\OAuth2hydrator\InvalidProviderException
     */
    public function accessToken($code)
    {
        // Social network credentials
        $credentials = $this->getProviderConfig();
        // Access token requesting url
        $accessTokenUrl = sprintf(self::ACCESS_TOKEN_URL,
            $credentials['app_id'],
            $this->getRedirectUri(),
            $credentials['app_secret'],
            $code
        );
        // Ask for access token
        $response = $this->getHttpClient()->setUri($accessTokenUrl)->send();
        $response = Json::decode($response);
        return $this->accessToken = $response->access_token;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        /** @var \Zend\Http\Request $request */
        $request = $this->getServiceLocator()->get('Request');
        $uri = $request->getUri();
        return $redirect_uri = sprintf(
            '%s://%s/oauth/%s/accessToken',
            $uri->getScheme(),
            $uri->getHost(),
            $this->getProviderName()
        );
    }

    /**
     * @return FacebookSocialAccount
     */
    public function getEntity()
    {
        return new FacebookSocialAccount();
    }
}