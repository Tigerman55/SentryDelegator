<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

use function Sentry\captureException;

class ErrorListener
{
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void
    {
        captureException($error);
    }
}
