<?php

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use Prooph\ServiceBusZfcRbacBridge\AuthorizationService;

/**
 * Class AuthorizationServiceFactory
 * @package Prooph\ServiceBusZfcRbacBridge\Container
 */
final class AuthorizationServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuthorizationService
     */
    public function __invoke(ContainerInterface $container)
    {
        $zfcRbacAuthorizationService = $container->get('ZfcRbac\Service\AuthorizationService');

        return new AuthorizationService($zfcRbacAuthorizationService);
    }
}
