<?php

namespace Ellipse\Router\Exceptions;

use TypeError;

use Psr\Http\Server\RequestHandlerInterface;

class MatchedHandlerTypeException extends TypeError implements RouterAdapterExceptionInterface
{
    public function __construct($value)
    {
        $template = "The handler matched by the router has type %s - object implementing %s expected";

        $type = is_object($value) ? get_class($value) : gettype($value);

        $msg = sprintf($template, $type, RequestHandlerInterface::class);

        parent::__construct($msg);
    }
}
