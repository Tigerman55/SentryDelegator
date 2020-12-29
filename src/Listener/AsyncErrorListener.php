<?php

declare(strict_types=1);

namespace SentryDelegator\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sentry\SentrySdk;
use Throwable;

use function Sentry\captureException;

class AsyncErrorListener implements ErrorListenerInterface
{
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void
    {
        captureException($error);

        $client = SentrySdk::getCurrentHub()->getClient();
        $client->flush();
    }
}
