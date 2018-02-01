<?php declare(strict_types=1);

namespace Ellipse\Router\Exceptions;

use RuntimeException;

class MethodNotAllowedException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct(string $method, string $uri, array $allowed)
    {
        $msg = "No route matching [%s, %s] - only [%s] allowed";

        parent::__construct(sprintf($msg, $method, $uri, implode(', ', $allowed)));
    }
}
