<?php

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use Prooph\ServiceBusZfcRbacBridge\RouteGuard;

/**
 * Class RouteGuardFactory
 * @package Prooph\ServiceBusZfcRbacBridge\Container
 */
final class RouteGuardFactory
{
    /**
     * @param ContainerInterface $container
     * @return RouteGuard
     */
    public function __invoke(ContainerInterface $container)
    {
        /* @var \ZfcRbac\Service\AuthorizationService $authorizationService */
        $authorizationService = $container->get('ZfcRbac\Service\AuthorizationService');

        return new RouteGuard($authorizationService);
    }

    /**
     * Returns the vendor name
     *
     * @return string
     */
    public function vendorName()
    {
        return 'zfc_rbac';
    }

    /**
     * Returns the component name
     *
     * @return string
     */
    public function componentName()
    {
        return 'protection_policy';
    }
}
