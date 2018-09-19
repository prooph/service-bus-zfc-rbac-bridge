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

namespace ProophTest\ServiceBusZfcRbacBridge\Container;

use PHPUnit\Framework\TestCase;
use Prooph\ServiceBusZfcRbacBridge\Container\ZfcRbacAuthorizationServiceBridgeFactory;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacV3AuthorizationServiceBridge;
use Psr\Container\ContainerInterface;
use ZfcRbac\Service\AuthorizationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationService;

final class AuthorizationServiceFactoryTest extends TestCase
{
    public function setUp()
    {
        $method = new \ReflectionMethod(AuthorizationServiceInterface::class, 'isGranted');
        $num = $method->getNumberOfParameters();
        $this->isV2 = 2 === $num;
        $this->isV3 = 3 === $num;
    }

    /**
     * @test
     */
    public function it_creates_authorization_service()
    {
        if (! $this->isV2) {
            $this->markTestSkipped('Testing V3');
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
        if (! $this->isV3) {
            $this->markTestSkipped('Testing V2');
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
