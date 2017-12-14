<?php

namespace Ellipse\Router\Exceptions;

use RuntimeException;

class NotFoundException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct(string $method, string $uri)
    {
        $msg = "No route was found matching this http request [%s, %s].";

        parent::__construct(sprintf($msg, $method, $uri));
    }
}
