<?php

namespace Ellipse\Router\Exceptions;

use TypeError;

use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Exceptions\Type;
use Ellipse\Exceptions\Value;

class MatchedHandlerTypeException extends TypeError implements RouterAdapterExceptionInterface
{
    public function __construct($value)
    {
        $template = "The handler matched by the router has type %s - %s expected";

        $value = new Value($value);
        $type = new Type(RequestHandlerInterface::class);

        $msg = sprintf($template, $value->type(), $type);

        parent::__construct($msg);
    }
}
