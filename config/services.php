<?php

namespace Prooph\ServiceBusZfcRbacBridge;

return [
    'factories' => [
        RouteGuard::class => Container\RouteGuardFactory::class,
        FinalizeGuard::class => Container\FinalizeGuardFactory::class,
    ]
];
