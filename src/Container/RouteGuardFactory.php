<?php

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Config\ConfigurationTrait;
use Interop\Config\HasConfig;
use Interop\Container\ContainerInterface;
use Prooph\ServiceBusZfcRbacBridge\RouteGuard;

/**
 * Class RouteGuardFactory
 * @package Prooph\ServiceBusZfcRbacBridge\Container
 */
final class RouteGuardFactory implements HasConfig
{
    use ConfigurationTrait;

    /**
     * @param ContainerInterface $container
     * @return RouteGuard
     */
    public function __invoke(ContainerInterface $container)
    {
        /* @var \ZfcRbac\Service\AuthorizationService $authorizationService */
        $authorizationService = $container->get('ZfcRbac\Service\AuthorizationService');

        $guard = new RouteGuard($authorizationService);
        $guard->setProtectionPolicy($this->options($container->get('Config')));

        return $guard;
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
