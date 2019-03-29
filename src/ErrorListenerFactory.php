<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Container\ContainerInterface;
use Sentry\ClientInterface;

class ErrorListenerFactory
{
    public function __invoke(ContainerInterface $container) : ErrorListener
    {
        $client = $container->get(ClientInterface::class);

        return new ErrorListener($client);
    }
}
