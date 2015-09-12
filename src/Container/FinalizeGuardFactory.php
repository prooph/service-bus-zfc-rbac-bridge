<?php

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use Prooph\ServiceBusZfcRbacBridge\FinalizeGuard;

/**
 * Class FinalizeGuardFactory
 * @package Prooph\ServiceBusZfcRbacBridge\Container
 */
final class FinalizeGuardFactory
{
    /**
     * @param ContainerInterface $container
     * @return FinalizeGuard
     */
    public function __invoke(ContainerInterface $container)
    {
        /* @var \ZfcRbac\Service\AuthorizationService $authorizationService */
        $authorizationService = $container->get('ZfcRbac\Service\AuthorizationService');

        return new FinalizeGuard($authorizationService);
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
