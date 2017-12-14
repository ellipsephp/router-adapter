<?php

namespace Ellipse\Router\Exceptions;

use RuntimeException;

use Interop\Http\Server\RequestHandlerInterface;

class HandlerIsNotARequestHandlerException extends RuntimeException implements RouterAdapterExceptionInterface
{
    public function __construct($handler)
    {
        $template = "The handler matched by the router must be an implementsation of '%s'. Matched: '%s'";

        $msg = sprintf($template, RequestHandlerInterface::class, print_r($handler, true));

        parent::__construct($msg);
    }
}
