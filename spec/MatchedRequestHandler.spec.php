<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\MatchedRequestHandler;
use Ellipse\Router\Exceptions\RequestHandlerTypeException;

describe('MatchedRequestHandler', function () {

    it('should be an instance of RequestHandlerInterface', function () {

        $test = new MatchedRequestHandler('handler', []);

        expect($test)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->handle()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class)->get();
            $this->response = mock(ResponseInterface::class)->get();

        });

        context('when the delegate is an instance of RequestHandlerInterface', function () {

            it('should proxy the handler ->handle() method using a request with the matched attributes', function () {

                $delegate = mock(RequestHandlerInterface::class);
                $request1 = mock(ServerRequestInterface::class);
                $request2 = mock(ServerRequestInterface::class);
                $request3 = mock(ServerRequestInterface::class);
                $response = mock(ResponseInterface::class);

                $request1->withAttribute->with('k1', 'v1')->returns($request2);
                $request2->withAttribute->with('k2', 'v2')->returns($request3);

                $delegate->handle->with($request3)->returns($response);

                $handler = new MatchedRequestHandler($delegate->get(), [
                    'k1' => 'v1',
                    'k2' => 'v2',
                ]);

                $test = $handler->handle($request1->get());

                expect($test)->toBe($response->get());

            });

        });

        context('when the delegate is not an instance of RequestHandlerInterface', function () {

            it('should throw a RequestHandlerTypeException', function () {

                $delegate = new class {};

                $handler = new MatchedRequestHandler($delegate, []);

                $test = function () use ($handler) {

                    $handler->handle($this->request);

                };

                $exception = new RequestHandlerTypeException($delegate);

                expect($test)->toThrow($exception);

            });

        });

    });

});
