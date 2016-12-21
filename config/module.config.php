<?php

namespace Sophont\OAuth2hydrator;

return array(
    'oAuth2Hydrator' => array(
        'debug' => true,
        'debug_data' => [
            'social_id' => 'social_id_123',
            'first_name' => 'test_1',
            'last_name' => 'test_2',
            'email' => 'test@gmail.com'
        ],
    ),

    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Service\IndexControllerFactory::class
        ],
    ],

    'service_manager' => [
        'factories' => [
            Service\OAuth2ProviderServicePluginManager::class => Service\OAuth2ProviderServicePluginManagerFactory::class
        ]
    ],

    'router' => array(
        'routes' => array(
            'oauth2-auth' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/oauth2/:provider/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Sophont\OAuth2hydrator',
                        'controller' => Controller\IndexController::class,
                        'action' => 'authenticate',
                    ),
                )
            ),
            'oauth2-auth-access-token' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/oauth2/:provider/access-token',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Sophont\OAuth2hydrator',
                        'controller' => Controller\IndexController::class,
                        'action' => 'access-token',
                    ),
                )
            )
        )
    ),
);