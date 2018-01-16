<?php declare(strict_types=1);

namespace Ellipse\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use Interop\Http\Server\RequestHandlerInterface;

use Ellipse\Router\Exceptions\RequestHandlerTypeException;

class MatchedRequestHandler implements RequestHandlerInterface
{
    /**
     * The delegate.
     *
     * @var mixed
     */
    private $delegate;

    /**
     * The matched attributes.
     *
     * @var array
     */
    private $attributes;

    /**
     * Set up a matched request handler with the given delegate and attributes.
     *
     * @param mixed $delegate
     * @param array $attributes
     */
    public function __construct($delegate, array $attributes)
    {
        $this->delegate = $delegate;
        $this->attributes = $attributes;
    }

    /**
     * Proxy the delegate ->handle() method when it is an implementation of
     * request handler interface or fail otherwise.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Ellipse\Router\Exceptions\RequestHandlerTypeException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->delegate instanceof RequestHandlerInterface) {

            $keys = array_keys($this->attributes);

            return $this->delegate->handle(array_reduce($keys, function ($request, $key) {

                return $request->withAttribute($key, $this->attributes[$key]);

            }, $request));

        }

        throw new RequestHandlerTypeException($this->delegate);
    }
}
