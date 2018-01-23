<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Exceptions\NotFoundException;

class RouterMiddleware implements MiddlewareInterface
{
    /**
     * The router request handler.
     *
     * @var \Ellipse\Router\RouterRequestHandler
     */
    private $router;

    /**
     * Set up a router middleware with the given router request handler.
     *
     * @param \Ellipse\Router\RouterRequestHandler $router
     */
    public function __construct(RouterRequestHandler $router)
    {
        $this->router = $router;
    }

    /**
     * Try to proxy the router ->handle() method. Proxy the given request
     * handler when the router throws a not found exception.
     *
     * @param \Psr\Http\Message\ServerRequestInterface  $request
     * @param \Psr\Http\Server\RequestHandlerInterface  $handler
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {

            return $this->router->handle($request);

        }

        catch (NotFoundException $e) {

            return $handler->handle($request);

        }
    }
}
