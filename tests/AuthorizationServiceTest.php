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

namespace ProophTest\ServiceBusZfcRbacBridge;

use PHPUnit\Framework\TestCase;
use Prooph\ServiceBusZfcRbacBridge\ZfcRbacAuthorizationServiceBridge;
use ZfcRbac\Service\AuthorizationServiceInterface;

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
