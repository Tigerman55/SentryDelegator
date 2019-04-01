<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Container\ContainerInterface;
use SentryDelegator\Exception\InvalidConfigException;

class SentryMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $sentry = $container->get('config')['sentry'] ?? null;

        if (null === $sentry) {
            throw new InvalidConfigException(
                'Sentry key is missing in local config'
            );
        }
        if (!isset($sentry['dsn'])) {
            throw new InvalidConfigException(
                'The Sentry DSN value is missing in the configuration'
            );
        }

        $options = ['dsn' => $sentry['dsn']];

        if (isset($sentry['environment'])) {
            $options['environment'] = $sentry['environment'];
        }

        return new SentryMiddleware($options);
    }
}
