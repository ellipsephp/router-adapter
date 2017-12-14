<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\MethodNotAllowedException;

describe('MethodNotAllowedException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new MethodNotAllowedException('/path', ['GET', 'POST']);

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
