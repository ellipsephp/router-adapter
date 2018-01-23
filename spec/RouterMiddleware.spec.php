<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Router\RouterMiddleware;
use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\Exceptions\NotFoundException;

describe('RouterMiddleware', function () {

    beforeEach(function () {

        $this->router = mock(RouterRequestHandler::class);

        $this->middleware = new RouterMiddleware($this->router->get());

    });

    it('should implement MiddlewareInterface', function () {

        expect($this->middleware)->toBeAnInstanceOf(MiddlewareInterface::class);

    });

    describe('->process()', function () {

        beforeEach(function () {

            $this->request = mock(ServerRequestInterface::class);
            $this->response = mock(ResponseInterface::class);
            $this->handler = mock(RequestHandlerInterface::class);

        });

        context('when the router does not throw a NotFoundException', function () {

            it('should proxy the router ->handle() method', function () {

                $this->router->handle->with($this->request)->returns($this->response);

                $test = $this->middleware->process($this->request->get(), $this->handler->get());

                expect($test)->toBe($this->response->get());

            });

        });

        context('when the router throws a NotFoundException', function () {

            it('should proxy the given handler ->handle() method', function () {

                $exception = mock(NotFoundException::class)->get();

                $this->router->handle->with($this->request)->throws($exception);

                $this->handler->handle->with($this->request)->returns($this->response);

                $test = $this->middleware->process($this->request->get(), $this->handler->get());

                expect($test)->toBe($this->response->get());

            });

        });

    });

});
