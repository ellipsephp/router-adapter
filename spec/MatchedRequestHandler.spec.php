<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\MatchedRequestHandler;
use Ellipse\Router\Exceptions\HandlerIsNotARequestHandlerException;

describe('MatchedRequestHandler', function () {

    it('should be an instance of RequestHandlerInterface', function () {

        $test = new MatchedRequestHandler('handler');

        expect($test)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->handle()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class)->get();
            $this->response = mock(ResponseInterface::class)->get();

        });

        context('when the delegate is an instance of RequestHandlerInterface', function () {

            it('should proxy the handler ->handle() method', function () {

                $delegate = mock(RequestHandlerInterface::class);

                $delegate->handle->with($this->request)->returns($this->response);

                $handler = new MatchedRequestHandler($delegate->get());

                $test = $handler->handle($this->request);

                expect($test)->toBe($this->response);

            });

        });

        context('when the delegate is not an instance of RequestHandlerInterface', function () {

            it('should throw a HandlerIsNotARequestHandlerException', function () {

                $delegate = new class {};

                $handler = new MatchedRequestHandler($delegate);

                $test = function () use ($handler) {

                    $handler->handle($this->request);

                };

                $exception = new HandlerIsNotARequestHandlerException($delegate);

                expect($test)->toThrow($exception);

            });

        });

    });

});
