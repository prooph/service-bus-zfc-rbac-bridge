<?php

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\Common\Event\ActionEventListenerAggregate;
use Prooph\Common\Event\DetachAggregateHandlers;
use ZfcRbac\Guard\ProtectionPolicyTrait;
use ZfcRbac\Service\AuthorizationServiceInterface;

/**
 * Class AbstractGuard
 * @package Prooph\ServiceBusZfcRbacBridge
 */
abstract class AbstractGuard implements ActionEventListenerAggregate
{
    use DetachAggregateHandlers;
    use ProtectionPolicyTrait;

    /**
     * Protection policy constants
     */
    const POLICY_DENY  = 'deny';
    const POLICY_ALLOW = 'allow';

    /**
     * @var AuthorizationServiceInterface
     */
    protected $authorizationService;

    /**
     * @param AuthorizationServiceInterface $authorizationService
     * @param array $rules
     */
    public function __construct(AuthorizationServiceInterface $authorizationService)
    {
        $this->authorizationService = $authorizationService;
    }
}
