<?php

declare(strict_types=1);

namespace SentryDelegator;

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
                ErrorListener::class => ErrorListener::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    ListenerDelegator::class,
                ],
            ],
        ];
    }
}
