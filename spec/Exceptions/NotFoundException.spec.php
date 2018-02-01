<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\NotFoundException;

describe('NotFoundException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new NotFoundException('/path');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
