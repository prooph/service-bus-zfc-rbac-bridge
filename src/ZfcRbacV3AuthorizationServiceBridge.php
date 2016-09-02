<?php
/*
 * This file is part of the prooph/service-bus-zfc-rbac-bridge.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 19:57
 */

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\ServiceBus\Plugin\Guard\AuthorizationService;
use Zend\Authentication\AuthenticationServiceInterface;
use ZfcRbac\Identity\IdentityInterface;
use ZfcRbac\Service\AuthorizationServiceInterface;

/**
 * Class ZfcRbacAuthorizationServiceBridge
 *
 * @package Prooph\ServiceBusZfcRbacBridge
 */
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

    /**
     * ZfcRbacAuthorizationServiceBridge constructor.
     *
     * @param AuthenticationServiceInterface $authenticationService
     * @param AuthorizationServiceInterface  $authorizationService
     */
    public function __construct(
        AuthenticationServiceInterface $authenticationService,
        AuthorizationServiceInterface $authorizationService
    ) {
        $this->authenticationService = $authenticationService;
        $this->authorizationService  = $authorizationService;
    }

    /**
     * Check if the permission is granted to the current identity
     *
     * @param string $messageName
     * @param mixed  $context
     * @return bool
     */
    public function isGranted($messageName, $context = null)
    {
        $identity = null;

        if ($this->authenticationService->hasIdentity()) {
            /** @var IdentityInterface $identity */
            $identity = $this->authenticationService->getIdentity();
        }

        return $this->authorizationService->isGranted($identity, $messageName, $context);
    }
}
