<?php

namespace Sophont\OAuth2hydrator\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;

use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class OAuth2ProviderServiceFactory
 * @package Sophont\OAuth2hydrator\Service
 */
class OAuth2ProviderServiceFactory implements FactoryInterface
{
    /** @var OAuth2ProviderServiceInterface $service */
    protected $serviceName;

    /**
     * @param $name
     * @return $this
     */
    public function setServiceName($name)
    {
        $this->serviceName = $name;

        return $this;
    }

    /**
     * @return OAuth2ProviderServiceInterface
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var array $config */
        $config = $serviceLocator->getServiceLocator()->get('config')['oAuth2Hydrator'];

        if ($config['debug']) {
            return new TestDataOAuth2ProviderService($config);
        }

        return new $this->serviceName(
            $config
        );
    }

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
        $config = $container->get('config')['oAuth2Hydrator'];

        if ($config['debug']) {
            return new TestDataOAuth2ProviderService($config);
        }

        return new $this->serviceName(
            $config
        );
    }
}