<?php

declare(strict_types=1);

namespace SentryDelegator;

use SentryDelegator\Listener\ErrorListener;
use SentryDelegator\Listener\ErrorListenerInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'invokables' => [
                ErrorListenerInterface::class => ErrorListener::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    ListenerDelegator::class,
                ],
            ],
        ];
    }
}
