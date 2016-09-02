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
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacV3AuthorizationServiceBridge;
use ZfcRbac\Service\AuthorizationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationService;

/**
 * Class AuthorizationServiceFactoryTest
 * @package ProophTest\ServiceBusZfcRbacBridge\Container
 */
final class AuthorizationServiceFactoryTest extends TestCase
{
    public function setUp()
    {
        $method     = new \ReflectionMethod(AuthorizationServiceInterface::class, 'isGranted');
        $num        = $method->getNumberOfParameters();
        $this->isV2 = 2 === $num;
        $this->isV3 = 3 === $num;
    }

    /**
     * @test
     */
    public function it_creates_authorization_service()
    {
        if (!$this->isV2) {
            $this->markTestSkipped();
        }

        $zfcRbacAuthorizationService = $this->prophesize(ZfcRbacAuthorizationService::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(\ZfcRbac\Service\AuthorizationService::class)->willReturn($zfcRbacAuthorizationService->reveal());

        $factory = new ZfcRbacAuthorizationServiceBridgeFactory();

        $authorizationService = $factory($container->reveal());

        $this->assertInstanceOf(ZfcRbacAuthorizationServiceBridge::class, $authorizationService);
    }

    /**
     * @test
     */
    public function it_creates_authorization_serviceV3()
    {
        if (!$this->isV3) {
            $this->markTestSkipped();
        }

        $zfcRbacAuthorizationService = $this->prophesize(ZfcRbacAuthorizationService::class);
        $authenticationService = $this->prophesize(\Zend\Authentication\AuthenticationServiceInterface::class);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get(\Zend\Authentication\AuthenticationServiceInterface::class)->willReturn($authenticationService->reveal());
        $container->get(ZfcRbacAuthorizationService::class)->willReturn($zfcRbacAuthorizationService->reveal());

        $factory = new ZfcRbacAuthorizationServiceBridgeFactory();

        $authorizationService = $factory($container->reveal());

        $this->assertInstanceOf(ZfcRbacV3AuthorizationServiceBridge::class, $authorizationService);
    }
}
