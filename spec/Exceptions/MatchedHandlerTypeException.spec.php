<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\MatchedHandlerTypeException;

describe('MatchedHandlerTypeException', function () {

    it('should implement RouterAdapterExceptionInterface', function () {

        $test = new MatchedHandlerTypeException('handler');

        expect($test)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
