<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\HandlerIsNotARequestHandlerException;

describe('HandlerIsNotARequestHandlerException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new HandlerIsNotARequestHandlerException('handler');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
