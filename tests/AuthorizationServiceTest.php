<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 20:16
 */

namespace Prooph\ServiceBusZfcRbacBridgeTest;

use PHPUnit_Framework_TestCase as TestCase;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
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

        $authorizationService = new ZfcRbacAuthorizationServiceBridge($zfcRbacAuthorizationService->reveal());

        $this->assertTrue($authorizationService->isGranted('foo', 'bar'));
    }
}
