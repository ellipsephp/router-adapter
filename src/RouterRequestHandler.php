<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterRequestHandler implements RequestHandlerInterface
{
    /**
     * The input name of the value overriding the request method.
     *
     * @var string
     */
    const METHOD_INPUT_KEY = '_method';

    /**
     * The router adapter factory.
     *
     * @var \Ellipse\Router\RouterAdapterFactoryInterface
     */
    private $factory;

    /**
     * Set up a router request handler with the given router adapter factory.
     *
     * @param \Ellipse\Router\RouterAdapterFactoryInterface $factory
     */
    public function __construct(RouterAdapterFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Update the request method then use the factory to get a router adapter
     * and this adapter to match a request handler. Finally proxy this matched
     * request handler ->handle() method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $method = strtoupper($body[self::METHOD_INPUT_KEY] ?? $request->getMethod());

        $request = $request->withMethod($method);

        return ($this->factory)()->match($request)->handle($request);
    }
}
