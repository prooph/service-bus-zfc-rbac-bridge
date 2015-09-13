<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 19:57
 */

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\ServiceBus\Plugin\Guard\AuthorizationService as AuthorizationServiceInterface;
use ZfcRbac\Service\AuthorizationServiceInterface as ZfcRbacAuthorizationServiceInterface;

/**
 * Class ZfcRbacAuthorizationServiceBridge
 * @package Prooph\ServiceBusZfcRbacBridge
 */
final class ZfcRbacAuthorizationServiceBridge implements AuthorizationServiceInterface
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
