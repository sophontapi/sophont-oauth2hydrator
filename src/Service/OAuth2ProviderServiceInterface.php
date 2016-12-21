<?php

namespace Sophont\OAuth2hydrator\Service;

/**
 * Interface OAuth2ProviderServiceInterface
 * @package Sophont\OAuth2hydrator\Service
 */
interface OAuth2ProviderServiceInterface
{
    public function authorizationUrl();

    public function fetchAccessToken($code);

    public function fetchUserData($accessToken);
}