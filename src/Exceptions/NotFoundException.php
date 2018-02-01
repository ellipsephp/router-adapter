<?php

namespace Ellipse\Router\Exceptions;

use RuntimeException;

class NotFoundException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct(string $uri)
    {
        $msg = "No route matching %s";

        parent::__construct(sprintf($msg, $uri));
    }
}
