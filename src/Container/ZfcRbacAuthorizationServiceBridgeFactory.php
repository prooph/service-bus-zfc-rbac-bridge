<?php
/*
 * This file is part of the prooph/service-bus-zfc-rbac-bridge.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 20:00
 */

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacV3AuthorizationServiceBridge;
use Zend\Authentication\AuthenticationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface;
/**
 * Class ZfcRbacAuthorizationServiceBridgeFactory
 * @package Prooph\ServiceBusZfcRbacBridge\Container
 */
final class ZfcRbacAuthorizationServiceBridgeFactory
{
    /**
     * @param ContainerInterface $container
     * @return ZfcRbacAuthorizationServiceBridge
     */
    public function __invoke(ContainerInterface $container)
    {
        $method = new \ReflectionMethod(AuthorizationServiceInterface::class, 'isGranted');
        $num    = $method->getNumberOfParameters();

        if (3 === $num) {
            return new ZfcRbacV3AuthorizationServiceBridge(
                $container->get(AuthenticationServiceInterface::class),
                $container->get(AuthorizationServiceInterface::class)
            );
        } else {
            return new ZfcRbacAuthorizationServiceBridge(
                $container->get('ZfcRbac\Service\AuthorizationService')
            );
        }
    }
}
