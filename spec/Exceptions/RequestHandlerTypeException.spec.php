<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\RequestHandlerTypeException;

describe('RequestHandlerTypeException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new RequestHandlerTypeException('handler');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
