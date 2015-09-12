<?php

namespace Prooph\ServiceBusZfcRbacBridge;

use Prooph\Common\Event\ActionEvent;
use Prooph\Common\Event\ActionEventEmitter;
use Prooph\ServiceBus\MessageBus;
use ZfcRbac\Exception\UnauthorizedException;

/**
 * Class RouteGuard
 * @package Prooph\ServiceBusZfcRbacBridge
 */
final class RouteGuard extends AbstractGuard
{
    /**
     * @param ActionEvent $actionEvent
     */
    public function onRoute(ActionEvent $actionEvent)
    {
        if ($this->authorizationService->isGranted($actionEvent->getParam(MessageBus::EVENT_PARAM_MESSAGE_NAME))) {
            return;
        }

        $actionEvent->stopPropagation(true);

        throw new UnauthorizedException();
    }

    /**
     * @param ActionEventEmitter $events
     *
     * @return void
     */
    public function attach(ActionEventEmitter $events)
    {
        $this->trackHandler($events->attachListener(MessageBus::EVENT_ROUTE, [$this, "onRoute"], 1000));
    }
}
