<?php

namespace Prooph\ServiceBusZfcRbacBridge\Container;

use Interop\Container\ContainerInterface;
use PHPUnit_Framework_TestCase as TestCase;
use Prooph\ServiceBusZfcRbacBridge\AuthorizationService;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationService;

/**
 * Class AuthorizationServiceFactoryTest
 * @package Prooph\ServiceBusZfcRbacBridge\Container
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

        $factory = new AuthorizationServiceFactory();

        $authorizationService = $factory($container->reveal());

        $this->assertInstanceOf(AuthorizationService::class, $authorizationService);
    }
}
