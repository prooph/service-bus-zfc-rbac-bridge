<?php
/*
 * This file is part of the prooph/service-bus-zfc-rbac-bridge.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 20:14
 */

namespace ProophTest\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase as TestCase;
use Prooph\ServiceBusZfcRbacBridge\Container\ZfcRbacAuthorizationServiceBridgeFactory;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationService;

/**
 * Class AuthorizationServiceFactoryTest
 * @package ProophTest\ServiceBusZfcRbacBridge\Container
 */
final class AuthorizationServiceFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_authorization_service()
    {
        $zfcRbacAuthorizationService = $this->prophesize(ZfcRbacAuthorizationService::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get('ZfcRbac\Service\AuthorizationService')->willReturn($zfcRbacAuthorizationService->reveal());

        $factory = new ZfcRbacAuthorizationServiceBridgeFactory();

        $authorizationService = $factory($container->reveal());

        $this->assertInstanceOf(ZfcRbacAuthorizationServiceBridge::class, $authorizationService);
    }
}
