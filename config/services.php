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

return [
    'factories' => [
        \Prooph\ServiceBus\Plugin\Guard\AuthorizationService::class => Container\ZfcRbacAuthorizationServiceBridgeFactory::class,
    ],
];
