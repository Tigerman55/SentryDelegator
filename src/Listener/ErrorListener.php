<?php

declare(strict_types=1);

namespace SentryDelegator\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

use function Sentry\captureException;

class ErrorListener implements ErrorListenerInterface
{
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void
    {
        captureException($error);
    }
}
