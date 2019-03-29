<?php

declare(strict_types=1);

namespace SentryDelegator;

use Sentry\ClientInterface;
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
            'factories'  => [
                ClientInterface::class => ClientFactory::class,
                ErrorListener::class   => ErrorListenerFactory::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    ListenerDelegator::class,
                ],
            ],
        ];
    }
}
