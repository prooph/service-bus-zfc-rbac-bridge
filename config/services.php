<?php
/*
 * This file is part of the prooph/service-bus.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 09/13/15 - 20:18
 */

namespace Prooph\ServiceBusZfcRbacBridge;

return [
    'factories' => [
        '\Prooph\ServiceBus\Plugin\Guard\AuthorizationService' => Container\AuthorizationServiceFactory::class
    ]
];
