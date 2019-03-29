<?php

declare(strict_types=1);

namespace SentryDelegator;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class ListenerDelegator implements DelegatorFactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        ?array $options = null
    ) : ErrorHandler {
        $listener = $container->get(ErrorListener::class);

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();

        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
