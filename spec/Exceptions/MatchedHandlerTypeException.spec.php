<?php

use Ellipse\Router\Exceptions\RouterAdapterExceptionInterface;
use Ellipse\Router\Exceptions\MatchedHandlerTypeException;

describe('MatchedHandlerTypeException', function () {

    beforeEach(function () {

        $this->exception = new MatchedHandlerTypeException('handler');

    });

    it('should extend TypeError', function () {

        expect($this->exception)->toBeAnInstanceOf(TypeError::class);

    });

    it('should implement RouterAdapterExceptionInterface', function () {

        expect($this->exception)->toBeAnInstanceOf(RouterAdapterExceptionInterface::class);

    });

});
