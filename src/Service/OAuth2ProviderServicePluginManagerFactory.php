<?php

namespace Sophont\OAuth2hydrator\Service;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

/**
 * Class OAuth2ProviderServicePluginManagerFactory
 * @package Sophont\OAuth2hydrator\Service
 */
class OAuth2ProviderServicePluginManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = "Sophont\\OAuth2hydrator\\Service\\OAuth2ProviderServicePluginManager";
}