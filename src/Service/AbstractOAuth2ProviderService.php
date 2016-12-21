<?php

namespace Sophont\OAuth2hydrator\Service;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Sophont\OAuth2hydrator\InvalidProviderException;
use Zend\Http\Client;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\HydratorInterface;
use Zend\Session\Container;

/**
 * Class AbstractOAuth2ProviderService
 * @package Sophont\OAuth2hydrator\Service
 */
abstract class AbstractOAuth2ProviderService implements OAuth2ProviderServiceInterface
{
    /** @var Container $container */
    protected $container;

    /** @var Client $httpClient */
    protected $httpClient;

    /** @var HydratorInterface $hydrator */
    protected $hydrator;

    /** @var array $configs */
    protected $config;

    /**
     * AbstractOAuth2ProviderService constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->container = new Container('OAuth2Hydrator');
    }

    /**
     * @return mixed
     * @throws InvalidProviderException
     */
    public function getProviderConfig()
    {
        if (!$providerName = $this->getProviderName() || !isset($this->config[$this->getProviderName()])) {
            throw new InvalidProviderException(
                sprintf(
                    'No configuration provided for %s',
                    get_class($this)
                )
            );
        }
        return $this->config[$this->getProviderName()];
    }

    /**
     * @param null $providerName
     * @return bool
     */
    public function hasAuthentication($providerName = null)
    {
        $providerName = $providerName ? $providerName : $this->getProviderName();
        return isset($this->container[$providerName]);
    }

    /**
     * @param null $providerName
     */
    public function clearAuthentication($providerName = null)
    {
        $providerName = $providerName ? $providerName : $this->getProviderName();
        unset($this->container[$providerName]);
    }

    /**
     * @param array $data
     * @return object
     */
    public function getSocialAccount(array $data)
    {
        return $this->getHydrator()->hydrate($data, $this->getEntity());
    }

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Client $client
     * @return $this
     */
    public function setHttpClient(Client $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HydratorInterface $hydrator
     * @return $this
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;

        return $this;
    }

    /**
     * @return ClassMethods|HydratorInterface
     */
    public function getHydrator()
    {
        if ($this->hydrator) {
            return $this->hydrator;
        }

        return new ClassMethods();
    }

    abstract public function getProviderName();

    abstract public function getEntity();
}