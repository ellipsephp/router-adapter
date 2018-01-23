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
     * The router adapter.
     *
     * @var \Ellipse\Router\RouterAdapterInterface
     */
    private $adapter;

    /**
     * Set up a router request handler with the given router adapter.
     *
     * @param \Ellipse\Router\RouterAdapterInterface $adapter
     */
    public function __construct(RouterAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Update the request mathod, use the adapter to get a match, then proxy the
     * match handler ->handle() method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $method = strtoupper($body[self::METHOD_INPUT_KEY] ?? $request->getMethod());

        $request = $request->withMethod($method);

        return $this->adapter->match($request)->handle($request);
    }
}
