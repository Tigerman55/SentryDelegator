<?php

declare(strict_types=1);

namespace SentryDelegator;

use SentryDelegator\Exception\InvalidConfigException;

use function Sentry\init;

final class ConfigureSentry
{
    public function __invoke(array $config) : void
    {
        $sentry = $config['sentry'] ?? null;

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

        init($options);
    }
}
