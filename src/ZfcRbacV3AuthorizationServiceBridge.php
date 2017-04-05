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

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\ServiceBus\Plugin\Guard\AuthorizationService;
use Zend\Authentication\AuthenticationServiceInterface;
use ZfcRbac\Identity\IdentityInterface;
use ZfcRbac\Service\AuthorizationServiceInterface;

final class ZfcRbacV3AuthorizationServiceBridge implements AuthorizationService
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * @var AuthorizationServiceInterface
     */
    private $authorizationService;

    public function __construct(
        AuthenticationServiceInterface $authenticationService,
        AuthorizationServiceInterface $authorizationService
    ) {
        $this->authenticationService = $authenticationService;
        $this->authorizationService = $authorizationService;
    }

    public function isGranted(string $messageName, $context = null): bool
    {
        $identity = null;

        if ($this->authenticationService->hasIdentity()) {
            /** @var IdentityInterface $identity */
            $identity = $this->authenticationService->getIdentity();
        }

        return $this->authorizationService->isGranted($identity, $messageName, $context);
    }
}
