<?php

declare(strict_types=1);

namespace SentryDelegator;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Laminas\Stratigility\Middleware\ErrorHandler;
use SentryDelegator\Listener\ErrorListenerInterface;

class ListenerDelegator implements DelegatorFactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        ?array $options = null
    ) : ErrorHandler {
        $listener = $container->get(ErrorListenerInterface::class);

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();

        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
