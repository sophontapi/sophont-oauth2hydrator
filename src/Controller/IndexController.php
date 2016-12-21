<?php

namespace Sophont\OAuth2hydrator\Controller;

use Sophont\OAuth2hydrator\Entity\AbstractSocialAccount;
use Sophont\OAuth2hydrator\Service\AbstractOAuth2ProviderService;
use Sophont\OAuth2hydrator\Service\OAuth2ProviderServiceInterface;
use Sophont\OAuth2hydrator\Service\OAuth2ProviderServicePluginManager;

use Sophont\OAuth2hydrator\SocialAccountEvent;
use Zend\Http\Response;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\EventManagerAwareInterface;

/**
 * Class IndexController
 * @package Sophont\OAuth2hydrator
 */
class IndexController extends AbstractActionController implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /** @var OAuth2ProviderServicePluginManager $oAuth2ProviderService */
    protected $oauthPluginManager;

    /**
     * IndexController constructor.
     * @param OAuth2ProviderServicePluginManager $pluginManager
     */
    public function __construct(OAuth2ProviderServicePluginManager $pluginManager)
    {
        $this->oauthPluginManager = $pluginManager;
    }

    /**
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function authenticateAction()
    {
        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();

        $provider = $this->params()->fromRoute('provider');

        /** @var OAuth2ProviderServiceInterface $service */
        if (!$this->oauthPluginManager->has($provider)) {
            $response->setStatusCode(Response::STATUS_CODE_403);
            return $this->response;
        }

        $service = $this->oauthPluginManager->get($provider);
        return $this->redirect()->toUrl($service->authorizationUrl());
    }

    /**
     * @return \Zend\Stdlib\ResponseInterface|ViewModel
     */
    public function accessTokenAction()
    {
        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();

        $provider = $this->params()->fromRoute('provider');

        /** @var AbstractOAuth2ProviderService $service */
        if (!$this->oauthPluginManager->has($provider)) {
            $response->setStatusCode(Response::STATUS_CODE_403);
            return $this->response;
        }

        $service = $this->oauthPluginManager->get($provider);
        $accessToken = $service->fetchAccessToken(
            $this->params()->fromQuery('code')
        );

        $socialAccountEvent = new SocialAccountEvent(
            SocialAccountEvent::EVENT_SOCIAL_CODE_READY
        );
        $socialAccountEvent->setCode($this->params()->fromQuery('code'))->setProvider($provider);
        $this->getEventManager()->trigger($socialAccountEvent);

        /** @var AbstractSocialAccount $socialAccount */
        $socialAccount = $service->getSocialAccount(
            $service->fetchUserData(
                $accessToken
            )
        );

        $socialAccountEvent = new SocialAccountEvent(
            SocialAccountEvent::EVENT_SOCIAL_ACCOUNT_READY
        );
        $socialAccountEvent->setSocialAccount($socialAccount)->setProvider($provider);
        $this->getEventManager()->trigger($socialAccountEvent);

        return $response;
    }
}