<?php

use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Router\RouterRequestHandler;
use Ellipse\Router\RouterAdapterFactoryInterface;
use Ellipse\Router\RouterAdapterInterface;
use Ellipse\Router\MatchedRequestHandler;

describe('RouterRequestHandler', function () {

    beforeEach(function () {

        $this->factory = mock(RouterAdapterFactoryInterface::class);

        $this->router = new RouterRequestHandler($this->factory->get());

    });

    it('should implement RequestHandlerInterface', function () {

        expect($this->router)->toBeAnInstanceOf(RequestHandlerInterface::class);

    });

    describe('->handle()', function () {

        beforeEach(function () {

            $this->request1 = mock(ServerRequestInterface::class);
            $this->response = mock(ResponseInterface::class);

            $this->request2 = mock(ServerRequestInterface::class);

            $this->request1->getMethod->returns('get');
            $this->request1->withMethod->returns($this->request2);

            $this->adapter = mock(RouterAdapterInterface::class);

            $this->factory->__invoke->returns($this->adapter);

            $this->handler = mock(MatchedRequestHandler::class);

            $this->adapter->match->returns($this->handler);

        });

        it('should proxy the matched handler ->handle() method with the new request', function () {

            $this->handler->handle->with($this->request2)->returns($this->response);

            $test = $this->router->handle($this->request1->get());

            expect($test)->toBe($this->response->get());

        });

        context('when the request body does not contain an input overriding the method', function () {

            it('should create a new request with the uppercased request method', function () {

                $this->request1->getParsedBody->returns([]);

                $test = $this->router->handle($this->request1->get());

                $this->request1->withMethod->calledWith('GET');

            });

        });

        context('when the request body contains an input overriding the method', function () {

            it('should create a new request with the uppercased method value', function () {

                $this->request1->getParsedBody->returns([
                    RouterRequestHandler::METHOD_INPUT_KEY => 'post',
                ]);

                $test = $this->router->handle($this->request1->get());

                $this->request1->withMethod->calledWith('POST');

            });

        });

    });

});
