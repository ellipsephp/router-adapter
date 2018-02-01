<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\MethodNotAllowedException;

describe('MethodNotAllowedException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new MethodNotAllowedException('GET', '/path', ['POST', 'PUT']);

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
