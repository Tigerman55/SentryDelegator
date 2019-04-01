<?php

declare(strict_types=1);

namespace SentryDelegator;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function Sentry\init;

class SentryMiddleware implements MiddlewareInterface
{
    private $options;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        init($this->options);

        return $handler->handle($request);
    }
}
