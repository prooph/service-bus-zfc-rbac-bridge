<?php

declare(strict_types=1);

/**
 * This file is part of the prooph/pdo-snapshot-store.
 * (c) 2016-2017 prooph software GmbH <contact@prooph.de>
 * (c) 2016-2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 * (c) 2016-2017 Bas Kamer <baskamer@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacV3AuthorizationServiceBridge;
use Psr\Container\ContainerInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface;

final class ZfcRbacAuthorizationServiceBridgeFactory
{
    /**
     * @param ContainerInterface $container
     * @return ZfcRbacAuthorizationServiceBridge
     */
    public function __invoke(ContainerInterface $container)
    {
        $method = new \ReflectionMethod(AuthorizationServiceInterface::class, 'isGranted');
        $num = $method->getNumberOfParameters();

        if (3 === $num) {
            return new ZfcRbacV3AuthorizationServiceBridge(
                $container->get(AuthenticationServiceInterface::class),
                $container->get(AuthorizationServiceInterface::class)
            );
        }

        return new ZfcRbacAuthorizationServiceBridge(
                $container->get('ZfcRbac\Service\AuthorizationService')
            );
    }
}
