<?php

declare(strict_types=1);

namespace SentryDelegator\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

interface ErrorListenerInterface
{
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void;
}
