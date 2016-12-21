<?php

namespace Sophont\OAuth2hydrator\Service;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Class OAuth2ProviderServicePluginManager
 * @package Sophont\OAuth2hydrator\Service
 */
class OAuth2ProviderServicePluginManager extends AbstractPluginManager
{
    protected $factories = array(
        AbstractSocialAccount::PROVIDER_FACEBOOK => FacebookOAuth2ProviderServiceFactory::class
    );

    protected $invokableClasses = array();

    protected $aliases = array();

    /**
     * @param $plugin
     */
    public function validatePlugin($plugin)
    {
        $this->validate($plugin);
    }

    public function validate($plugin)
    {
        if ($plugin instanceof OAuth2ProviderServiceInterface) {
            // we're okay
            return;
        }

        throw new \InvalidArgumentException(sprintf(
            'Plugin of type %s is invalid; must implement %s\OAuth2ProviderServiceInterface',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}