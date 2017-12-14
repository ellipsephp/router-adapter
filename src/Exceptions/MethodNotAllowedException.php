<?php declare(strict_types=1);

namespace Ellipse\Router\Exceptions;

use RuntimeException;

class MethodNotAllowedException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct(string $uri, array $allowed_methods)
    {
        $msg = "The methods allowed for this path %s are [%s].";

        parent::__construct(sprintf($msg, $uri, implode(', ', $allowed_methods)));
    }
}
