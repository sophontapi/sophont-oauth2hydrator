<?php

namespace Sophont\OAuth2hydrator\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

/**
 * Class FacebookOAuth2ProviderServiceFactory
 * @package Sophont\OAuth2hydrator\Service
 */
class FacebookOAuth2ProviderServiceFactory extends OAuth2ProviderServiceFactory
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $this->setServiceName('Sophont\\OAuth2hydrator\\Service\\FacebookOAuth2ProviderService');

        return parent::__invoke($container, $requestedName, $options);
    }
}