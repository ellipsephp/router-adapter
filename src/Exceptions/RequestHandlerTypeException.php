<?php

namespace Ellipse\Router\Exceptions;

use RuntimeException;

use Psr\Http\Server\RequestHandlerInterface;

class RequestHandlerTypeException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct($handler)
    {
        $template = "The router matched a value of type %s - object implementing %s expected";

        $type = is_object($handler) ? get_class($handler) : gettype($handler);

        $msg = sprintf($template, $type, RequestHandlerInterface::class);

        parent::__construct($msg);
    }
}
