<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Container\ContainerInterface;
use Sentry\ClientBuilder;
use Sentry\ClientInterface;
use Sentry\State\Hub;
use SentryDelegator\Exception\InvalidConfigException;

final class ClientFactory
{
    public function __invoke(ContainerInterface $container) : ClientInterface
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

        $builder = ClientBuilder::create($options);
        Hub::getCurrent()->bindClient($builder->getClient());

        return Hub::getCurrent()->getClient();
    }
}
