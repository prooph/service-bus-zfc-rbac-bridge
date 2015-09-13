<?php

namespace Prooph\ServiceBusZfcRbacBridgeTest;

use PHPUnit_Framework_TestCase as TestCase;
use Prooph\ServiceBusZfcRbacBridge\AuthorizationService;
use ZfcRbac\Service\AuthorizationServiceInterface;

/**
 * Class AuthorizationServiceTest
 * @package Prooph\ServiceBusZfcRbacBridgeTest
 */
final class AuthorizationServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_delegates_to_zfc_rbac_authorization_service()
    {
        $zfcRbacAuthorizationService = $this->prophesize(AuthorizationServiceInterface::class);
        $zfcRbacAuthorizationService->isGranted('foo', 'bar')->willReturn(true);

        $authorizationService = new AuthorizationService($zfcRbacAuthorizationService->reveal());

        $this->assertTrue($authorizationService->isGranted('foo', 'bar'));
    }
}
