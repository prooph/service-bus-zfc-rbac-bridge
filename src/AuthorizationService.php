<?php

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\ServiceBus\Plugin\Guard\AuthorizationService as AuthorizationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationServiceInterface;

/**
 * Class AuthorizationService
 * @package Prooph\ServiceBusZfcRbacBridge
 */
final class AuthorizationService implements AuthorizationServiceInterface
{
    /**
     * @var ZfcRbacAuthorizationServiceInterface
     */
    private $zfcRbacAuthorizationService;

    /**
     * @param ZfcRbacAuthorizationServiceInterface $zfcRbacAuthorizationService
     */
    public function __construct(ZfcRbacAuthorizationServiceInterface $zfcRbacAuthorizationService)
    {
        $this->zfcRbacAuthorizationService = $zfcRbacAuthorizationService;
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
        return $this->zfcRbacAuthorizationService->isGranted($messageName, $context);
    }
}
