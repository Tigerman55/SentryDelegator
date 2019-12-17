<?php

declare(strict_types=1);

namespace SentryDelegator\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sentry\FlushableClientInterface;
use Sentry\State\Hub;
use Throwable;

use function Sentry\captureException;

class AsyncErrorListener implements ErrorListenerInterface
{
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void
    {
        captureException($error);

        $client = Hub::getCurrent()->getClient();
        if ($client instanceof FlushableClientInterface) {
            $client->flush();
        }
    }
}
