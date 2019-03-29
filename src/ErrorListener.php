<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sentry\ClientInterface;
use Throwable;

class ErrorListener
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response) : void
    {
        $this->client->captureException($error);
    }
}
