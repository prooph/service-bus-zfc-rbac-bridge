<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 20:00
 */

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
